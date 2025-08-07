#!/bin/bash

# Get the directory where the script is located
SCRIPT_DIR=$(dirname "$0")

# Check if container is up
if [ ! "$(docker ps -q -f name=satis_builder_php)" ]; then
    # Start the container
    source "$SCRIPT_DIR"/docker-start.sh
fi

docker exec -it satis_builder_php bash