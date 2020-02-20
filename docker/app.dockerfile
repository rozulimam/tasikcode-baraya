FROM php:7.2-fpm

RUN apt-get update 
RUN apt-get install -y zip 
RUN apt-get install -y nano

RUN docker-php-ext-install mysqli 
RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-install zip xml xsl mbstring

RUN docker-php-ext-enable mysqli

RUN docker-php-ext-configure zip --with-libzip 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN export COMPOSER_ALLOW_SUPERUSER=1

ENV TZ=Asia/Jakarta
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www