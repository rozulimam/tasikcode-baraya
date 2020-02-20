FROM php:7.2-fpm

RUN apt-get update 
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libxml2-dev 
RUN apt-get install -y libfreetype6-dev 
RUN apt-get install -y libwebp-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libpng-dev 
RUN apt-get install -y libzip-dev 
RUN apt-get install -y libxslt-dev
RUN apt-get install -y zip 
RUN apt-get install -y libmagickwand-dev --no-install-recommends
RUN apt-get install -y nano

RUN pecl install imagick

RUN docker-php-ext-install mysqli 
RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-configure zip --with-libzip 
RUN docker-php-ext-install zip 
RUN docker-php-ext-install -j$(nproc) iconv

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install xml
RUN docker-php-ext-install xsl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pcntl
RUN docker-php-ext-enable imagick
RUN docker-php-ext-enable mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN export COMPOSER_ALLOW_SUPERUSER=1

ENV TZ=Asia/Jakarta
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN touch /usr/local/etc/php/conf.d/uploads.ini && echo "upload_max_filesize = 2000M;" >> /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www