FROM php:8.2-apache
COPY ./ /var/www/html/

RUN apt-get update && apt-get install -y \
        && docker-php-ext-install mysqli pdo pdo_mysql\
        && a2enmod rewrite