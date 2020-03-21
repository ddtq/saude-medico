FROM php:7.4.4-fpm

RUN apt-get update -y \
    && apt-get install -y --no-install-recommends git libpq-dev  libzip-dev zip unzip \
    && docker-php-ext-install zip pdo pdo_pgsql \
    && apt-get autoremove -y && apt-get clean 
