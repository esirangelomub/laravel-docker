<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x)

Alternative installation is possible without local dependencies relying on [Docker](#docker).

Clone the repository

    git clone git@github.com:esirangelomub/laravel-docker.git

Switch to the repo folder

    cd laravel-docker

## Running with docker

Install application

    chmod +x install.sh
    ./install.sh

Docker build

    ./vendor/bin/sail build

Docker up

    chmod +x up.sh
    ./up.sh

or

    ./vendor/bin/sail up -d

Docker down

    chmod +x down.sh
    ./down.sh

or

    ./vendor/bin/sail down

Sail guide https://laravel.com/docs/8.x/sail

## Running without docker

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Configure database

    DB_CONNECTION=<YOUR_DB_CONNECTION> // e.g.: mysql 
    DB_HOST=<YOUR_DB_HOST> // e.g.: mysql
    DB_PORT=<YOUR_BP_PORT> // e.g.: 3306
    DB_DATABASE=<YOUR_DB_DATABASE> // e.g.: laravel
    DB_USERNAME=<YOUR_DB_USERNAME> // e.g.: root
    DB_PASSWORD=<YOUR_DB_PASSWORD> // e.g.: password

Running seeders and migrations

    php artisan migrate --seed

Start application

    php artisan serve --host=localhost --port=8084

