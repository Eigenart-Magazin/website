#!/bin/bash

echo $CERTBOT_VALIDATION > $CERTBOT_TOKEN

rsync ./$CERTBOT_TOKEN $SSH_USER@$SSH_HOST:./www/eigenart/.well-known/acme-challenge

