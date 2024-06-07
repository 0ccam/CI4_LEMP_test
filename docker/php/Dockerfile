# PHP-FPM

FROM dockerhub.timeweb.cloud/library/php:8.3-fpm

RUN apt-get update && apt-get install -y \
	unzip \
	# Нужно для intl
	libicu-dev \ 
	# Нужно для zip
	libzip-dev \
	# Нужно для mbstring
	libonig-dev \
	# Нужно для dom
	libxml2-dev \
	# Нужно для gd
	libpng-dev \
	&& rm -rf /var/lib/apt/lists/* \
	&& docker-php-ext-install \
	zip \
	#unzip \
	intl \
	mbstring \
	dom \
	gd \
	pdo \
	pdo_mysql \
	mysqli

WORKDIR /var/www/public
ENTRYPOINT [ "php-fpm" ]