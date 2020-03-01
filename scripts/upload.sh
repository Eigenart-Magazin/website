#!/usr/bin/env bash

SSH_STRING=
REMOTE_PATH=

while [[ $# -gt 0 ]]
do
  case "$1" in
    --ssh)
      SSH_STRING="$2"
      shift 2
      ;;
    --path)
      REMOTE_PATH="$2"
      shift 2
      ;;
  esac
done

if [[ "$SSH_STRING" == "" || "$REMOTE_PATH" == "" ]]; then
  echo 'Usage: upload.sh --ssh user@ssh-host --path /remote/path'
  exit 1
fi

rsync -rP src/* ${SSH_STRING}:${REMOTE_PATH}

