#!/bin/bash

echo "Running composer"
composer install
echo "Starting application"
cp .env.example .env
./vendor/bin/sail down
./vendor/bin/sail up -d
echo "Install application"
./vendor/bin/sail artisan migrate:refresh --seed
echo "Done"
echo "Access http://localhost:8084"
