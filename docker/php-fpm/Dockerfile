FROM node:16.8 AS node
FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

WORKDIR /var/www/html
# Set the time environment variable
ENV TZ "America/Sao_Paulo"

# Install the PHP pdo_pgsql extention
RUN docker-php-ext-install pdo_mysql mysqli

#install git
RUN apt-get update && apt-get install -y && apt-get install git wget -y \
&& apt install -y zlib1g-dev \
# Install GD
#&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& apt install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
##&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd\
#install zip php
&& apt-get install -y \
        libzip-dev \
        zip \
&& docker-php-ext-install zip \
 # Clean files
&& cd ../ && rm -rf /var/www/html/tmp\
&& apt-get clean && apt-get autoclean\
#install composer
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# XDebug
RUN pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug

# MemCache
#RUN apt-get install -y libz-dev libmemcached-dev && \
#apt-get install -y memcached libmemcached-tools && \
#pecl install memcached && \
#docker-php-ext-enable memcached

USER www-data
## Instalando prestissimo para installs rápidos
# RUN composer global require "hirak/prestissimo"

ENV PATH="/home/www-data/.composer/vendor/bin:${PATH}"

USER $user
