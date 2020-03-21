FROM php:7.4.4-fpm

RUN apt-get update -y \
    && apt-get install -y --no-install-recommends git libpq-dev  libzip-dev zip unzip \
       libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev zlib1g-dev libjpeg62-turbo-dev

RUN docker-php-ext-install zip pdo pdo_pgsql iconv

RUN docker-php-ext-configure gd \
          --with-freetype --with-jpeg --with-webp

RUN docker-php-ext-install zip gd \
    && docker-php-ext-enable gd \
    && apt-get autoremove -y && apt-get clean 
