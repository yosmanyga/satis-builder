#!/bin/bash

# Get the directory where the script is located
SCRIPT_DIR=$(dirname "$0")

# Stop all services
docker-compose \
  -f "${SCRIPT_DIR}"/../docker/all.yml \
  -p satis_builder \
  stop