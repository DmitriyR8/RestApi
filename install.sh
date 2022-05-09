#!/usr/bin/env bash

cp ./.env.example ./.env

docker exec -ti api-test composer install

docker exec -ti api-test php artisan jwt:secret
docker exec -ti api-test php artisan migrate
docker exec -ti api-test php artisan password:generate

# Optional
#docker exec -ti api-test php artisan db:seed

