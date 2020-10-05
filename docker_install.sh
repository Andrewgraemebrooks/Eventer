#!/bin/bash
# Build the docker images.
docker-compose -f "docker-compose.yml" up -d --build
# Run the database migrations.
docker-compose exec php-fpm bash install_dependencies_migrations.sh
# Installation finished message.
echo 'Installation Finished!'
echo 'Ensure that all three docker containers are running!'
echo 'If there is an issue with the database, ensure the SQL container is running and re-execute this script.'
echo 'Use the URL http://localhost:8000/ to access the website.'