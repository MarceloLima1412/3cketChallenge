FROM php:7.3-fpm

# Instalações básicas
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install zip pdo_mysql

# Instalar a GD Library
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/freetype2 --with-jpeg-dir=/usr/include \
    && docker-php-ext-install gd

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar o Xdebug
RUN pecl install xdebug-2.9.8 && docker-php-ext-enable xdebug

WORKDIR /var/www/html
