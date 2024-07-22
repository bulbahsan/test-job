#!/bin/bash

#Очистка проекта

docker-compose stop
docker-compose down

containers=$(docker-compose ps -a -q)
if [ -n "$containers" ]; then
    echo "Остановка всех контейнеров..."
    docker stop $containers
fi

if [ -n "$containers" ]; then
    echo "Удаление всех контейнеров..."
    docker rm $containers
fi

rm -rf ./db/*
rm -rf ./redis/*
rm -rf ./logs/supervisor/*
echo "" > ./project/cron.log
cd ./project && rm -rf node_modules vendor composer.lock package-lock.json .idea .git