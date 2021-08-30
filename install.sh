#!/bin/bash

cd docker && docker-compose up -d && cd ../
docker exec -it iq_devs_auth_fpm composer install
