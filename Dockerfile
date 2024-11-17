FROM php:8.1-apache

RUN apt update -y && apt upgrade -y
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

CMD ["apache2-foreground"]