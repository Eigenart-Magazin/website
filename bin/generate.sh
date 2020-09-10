#!/bin/bash

mkdir -p ./var/cert/{logs,workdir,config}

certbot certonly \
    --config-dir=./var/cert/config \
    --work-dir=./var/cert/workdir \
    --logs-dir=./var/cert/logs \
    -d eigenart-magazin.de \
    -m $CERT_EMAIL \
    --manual-public-ip-logging-ok \
    --manual-cleanup-hook ./cleanup.sh \
    --manual-auth-hook ./authenticator.sh \
    --preferred-challenges=http \
    --agree-tos \
    --non-interactive \
    --manual

