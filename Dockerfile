FROM php:7.2.2-apache 
RUN apt update && docker-php-ext-install curl && docker-php-ext-install mysqli