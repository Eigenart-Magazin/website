#!/bin/bash

# Create simple ftp client

echo '<?php' > client.php
echo '$h = ftp_connect(getenv("FTP_HOST"));' >> client.php
echo 'ftp_login($h, getenv("FTP_USER"), getenv("FTP_PASS")) or die("Could not log in to FTP.");' >> client.php
echo '@ftp_mkdir($h, ".well-known/");' >> client.php
echo '@ftp_rmdir($h, ".well-known/acme-challenge");' >> client.php
echo '@ftp_mkdir($h, ".well-known/acme-challenge/");' >> client.php
echo '$argv[1] === "-upload" && (@ftp_put($h, ".well-known/acme-challenge/$argv[2]", $argv[2]) or die("Could not upload {$argv[2]}"));' >> client.php
echo '$argv[1] === "-delete" && (@ftp_delete($h, ".well-known/acme-challenge/$argv[2]") or die("Could not delete {$argv[2]}"));' >> client.php
echo 'ftp_close($h);' >> client.php

# Create mail sender

echo '<?php' > send.php
echo '$message = <<<MSG' >> send.php
echo 'Your certificate files are about to expire. You need to manually upload your new certificate files to your HostEuropa management panel.' >> send.php
echo '' >> send.php
echo 'The following link explains how to do it:' >> send.php
echo '' >> send.php
echo 'If you are wondering how these files were generated, you can see the code in this link:' >> send.php
echo '' >> send.php
echo 'Use the attached files or just reproduce the process manually.' >> send.php
echo 'MSG;' >> send.php
echo '' >> send.php

echo '$separator = md5(time()); $eol = "\r\n";' >> send.php

echo '$headers = "From: Eigenart Automation Tool <eigenart@asta-udk-berlin.de>{$eol}";' >> send.php
echo '$headers .= "MIME-Version: 1.0{$eol}";' >> send.php
echo '$headers .= "Content-Type: multipart/mixed; boundary=\"{$separator}\"{$eol}";' >> send.php
echo '$headers .= "Content-Transfer-Encoding: 7bit{$eol}";' >> send.php
echo '$headers .= "This is a MIME encoded message.{$eol}";' >> send.php
echo '' >> send.php

echo '$body = "--{$separator}{$eol}";' >> send.php
echo '$body .= "Content-Type: text/plain; charset=\"iso-8859-1\"{$eol}";' >> send.php
echo '$body .= "Content-Transfer-Encoding: 8bit{$eol}{$message}{$eol}";' >> send.php
echo '' >> send.php

echo '$files = ["./var/cert/cert1.pem", "./var/cert/privkey1.pem"];' >> send.php
echo 'foreach ($files as $filename) {' >> send.php
echo '  $basename = basename($filename);' >> send.php
echo '  $attachmentId = md5($filename);' >> send.php
echo '  $content = file_get_contents($filename);' >> send.php
echo '  $content = chunk_split(base64_encode($content));' >> send.php
echo '' >> send.php

echo '  $body .= "--{$separator}{$eol}";' >> send.php
echo '  $body .= "Content-Type: application/octet-stream; name=\"{$basename}\"{$eol}";' >> send.php
echo '  $body .= "Content-Transfer-Encoding: base64{$eol}";' >> send.php
echo '  $body .= "Content-Disposition: attachment{$eol}";' >> send.php
echo '  $body .= "X-Attachment-Id: {$attachmentId}{$eol}{$eol}";' >> send.php
echo '  $body .= $content . $eol;' >> send.php
echo '}' >> send.php

echo '$body .= "--{$separator}--";' >> send.php

echo 'mail("nawarian@gmail.com", "[Automated Mail] Your HTTPS Certificate is about to expire.", $body, $headers);' >> send.php

# Create authenticator.sh

echo '#!/bin/bash' > authenticator.sh
echo 'echo $CERTBOT_VALIDATION > $CERTBOT_TOKEN' >> authenticator.sh
echo 'php client.php -upload $CERTBOT_TOKEN' >> authenticator.sh
chmod +x authenticator.sh

# Create cleanup.sh

echo '#!/bin/bash' > cleanup.sh
echo 'php client.php -delete $CERTBOT_TOKEN' >> cleanup.sh
chmod +x cleanup.sh

# Generating certificate

mkdir -p ./var/cert

sudo ./certbot.bin certonly \
  --manual \
  --non-interactive \
  --agree-tos \
  --preferred-challenges=http \
  --manual-auth-hook ./authenticator.sh \
  --manual-cleanup-hook ./cleanup.sh \
  --manual-public-ip-logging-ok \
  -d eigenart-magazin.de \
  -m eigenart@asta-udk-berlin.de \
  --config-dir=./var/cert/config \
  --work-dir=./var/cert/workdir \
  --logs-dir=./var/cert/logs

# Send mail

php send.php
