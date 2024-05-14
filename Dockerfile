FROM php:apache

RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

COPY . /var/www/html

EXPOSE 80
