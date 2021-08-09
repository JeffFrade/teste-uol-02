#!/bin/bash

echo "##### Inicializa containers do Docker #####"
docker-compose up -d

echo "##### Copia o .env #####"
cp .env.example .env

echo "##### Instala dependências da aplicação #####"
docker exec -it teste-uol-php-fpm composer install

echo "##### Gera chave da aplicação #####"
docker exec -it teste-uol-php-fpm php artisan key:generate

echo "##### Gera as tabelas e as popula com dados de teste #####"
docker exec -it teste-uol-php-fpm php artisan migrate:fresh --seed
