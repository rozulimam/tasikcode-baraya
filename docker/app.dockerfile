FROM php:7.2-fpm

RUN apt-get update 
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libxml2-dev libpng-dev 
RUN apt-get install -y libzip-dev zip 

RUN docker-php-ext-configure zip --with-libzip 

RUN docker-php-ext-install mysqli 
RUN docker-php-ext-install zip 
RUN docker-php-ext-install gd 
RUN docker-php-ext-install mbstring 
RUN docker-php-ext-install xml

RUN docker-php-ext-enable mysqli 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN export COMPOSER_ALLOW_SUPERUSER=1

RUN mkdir -m777 /var/cpanel
RUN mkdir -m777 /var/cpanel/php
RUN mkdir -m777 /var/cpanel/php/sessions
RUN mkdir -m777 /var/cpanel/php/sessions/ea-php71

WORKDIR /var/www