# PHP-FPM

FROM	php:8.3-fpm
RUN	apt-get update && apt-get upgrade -y \
	&& apt-get install curl git libicu-dev -y \
	&& docker-php-ext-install intl pdo pdo_mysql \
	&& rm -rf /var/lib/apt/lists/*
WORKDIR	/var/www/public
ENTRYPOINT [ "php-fpm" ]