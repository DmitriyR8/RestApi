#!/usr/bin/env bash

cp ./.env.example ./.env
cp ./.env.example.testing ./.env.testing

docker exec -ti restApi composer install

docker exec -ti restApi php artisan jwt:secret
docker exec -ti restApi php artisan migrate
docker exec -ti restApi php artisan password:generate

# Optional
#docker exec -ti restApi php artisan db:seed

