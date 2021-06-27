#!/bin/bash
# Install dependencies
composer install
# Migrate the database migrations.
yes | php bin/console doctrine:migrations:migrate