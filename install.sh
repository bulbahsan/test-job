#!/bin/bash

#Подготовка к запуску

docker-compose stop
docker-compose build
docker-compose run --rm app composer install
#docker-compose run --rm app npm install
docker-compose up -d
docker-compose exec app php artisan migrate
docker-compose exec app php artisan test