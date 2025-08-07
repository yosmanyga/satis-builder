#!/bin/bash

# Get the directory where the script is located
SCRIPT_DIR=$(dirname "$0")

# Export UID and GID of the current user
DOCKER_USER="$(id -u):$(id -g)" export DOCKER_USER

# Create the network if it does not exist
docker network inspect development >/dev/null 2>&1 || \
  docker network create development

# Start all services
docker-compose \
  -f "${SCRIPT_DIR}"/../docker/all.yml \
  -p satis_builder \
  up -d \
  --remove-orphans \
  --force-recreate