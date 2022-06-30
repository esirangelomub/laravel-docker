#!/bin/bash

echo "Running composer"
composer install
sleep 1s
echo "Starting application"
cp .env.example .env
sleep 1s
./vendor/bin/sail up -d
sleep 10s
echo "Install application"
./vendor/bin/sail artisan migrate --seed
echo "Done"
echo "Access http://localhost:8084"
