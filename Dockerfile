FROM php:7.2.2-apache 
RUN apt update -y && apt install apt-utils curl -y && docker-php-ext-install mysqli
RUN a2enmod rewrite