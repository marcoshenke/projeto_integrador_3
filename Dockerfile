FROM php:8.1-apache

# Instala a extensão mysqli
RUN docker-php-ext-install mysqli
