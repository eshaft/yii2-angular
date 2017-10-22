FROM php:7.1-fpm
MAINTAINER eshaft <eshaft@gmail.com>

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libpq-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt bcmath mbstring mysqli pdo_mysql pdo_pgsql zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd
    
RUN pecl install xdebug-2.5.3 \
    && docker-php-ext-enable xdebug
    
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require "fxp/composer-asset-plugin:^1.2.0"

RUN apt-get -y --allow-unauthenticated install \
    libgearman-dev
RUN cd /tmp \
    && git clone https://github.com/wcgallego/pecl-gearman.git \
    && cd pecl-gearman \
    && git checkout gearman-2.0.3 \
    && phpize \
    && ./configure \
    && make -j$(nproc) \
    && make install \
    && rm -r /tmp/pecl-gearman \
    && docker-php-ext-enable gearman


ADD ./php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www

CMD ["php-fpm"]