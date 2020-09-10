Generating a new CERT
---

Make sure you have the following environment variables set:

- SSH_HOST
- SSH_USER
- CERT_EMAIL

Also, make sure you have `certbot` installed.

*Follow these steps to generate your new certificates:*

1. Set the environment variables

```
$ export SSH_HOST='your ssh hostname'
$ export SSH_USER='your ssh username'
$ export CERT_EMAIL='the email that should be associated with the certificate'
```

2. Generate the certificate (will ask for ssh password)

```
$ ./generate.sh
```

3. SSH into your server and remove the directory `./www/{projectname}/.well-known/acme-challenge/`

4. Log In into your cpanel and upload the `cert.pem` and `privatekey.pem` files available
in `./var/config/live/`.

5. *Remove the `./var` directory here.* I mean it, do not forget to delete this folder!!

# DELETE THE `./var` FOLDER AND NEVER COMMIT IT!

