## Развертывание

- Создать файл .env из .env.example
- перейти в папку docker
- запустить команды: ```docker-compose build && docker-compose up -d```
- запустить команды: ```docker exec -it iq_devs_auth_fpm composer install```
- в результате сервис должен подняться на порте: 7082



