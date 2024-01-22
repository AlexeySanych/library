FROM php:8.1-fpm

WORKDIR /var/www

COPY --chmod=777 ./app /var/www

RUN docker-php-ext-install pdo pdo_mysql