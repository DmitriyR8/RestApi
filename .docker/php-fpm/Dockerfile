FROM php:7.4-fpm

WORKDIR /var/www

# Allow container to write on host
RUN usermod -u 1000 www-data

# Install git
RUN apt-get update && apt-get install -y git;

# Install packages
RUN apt-get -yqq update \
    && apt-get install -y --no-install-recommends \
        build-essential \
        apt-utils \
        libzip-dev \
        libpng-dev \
        libfreetype6-dev \
        libjpeg-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libpq-dev \
        autoconf \
        g++ \
        make \
        openssl \
        libssl-dev \
        libcurl4-openssl-dev \
        pkg-config \
        libsasl2-dev \
        libpcre3-dev \
        unzip \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*;

RUN apt-get update && apt-get install -y libxml2-dev;

# Install php extensions
RUN pecl install mcrypt-1.0.3 \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install zip \
    && docker-php-ext-install xml \
    && docker-php-ext-install soap \
    && docker-php-ext-install sockets;

# Install project
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install xdebug
RUN pecl install xdebug-3.0.4; \
    docker-php-ext-enable xdebug;

ADD ./.docker/php-fpm/21-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
