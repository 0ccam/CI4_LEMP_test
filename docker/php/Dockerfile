# PHP-FPM

FROM php:8.3-fpm

RUN apt-get update && apt-get upgrade -y
#RUN apt-get install -y curl
#RUN apt-get install -y git
RUN apt-get install -y libicu-dev # Нужно для intl
RUN apt-get install -y libzip-dev # Нужно для zip
RUN apt-get install -y libonig-dev # Нужно для mbstring
RUN apt-get install -y libxml2-dev # Нужно для dom
RUN apt-get install -y libpng-dev # Нужно для gd
RUN rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install dom
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/public
ENTRYPOINT [ "php-fpm" ]