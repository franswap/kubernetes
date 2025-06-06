# app/php_pg/Dockerfile

FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql

RUN a2enmod rewrite

COPY ./www /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
