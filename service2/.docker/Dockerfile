FROM php:8.2-fpm-alpine

ARG APP_DIR=/var/www/app
ENV APP_DIR=${APP_DIR}

# Required packages to build extensions
# Install system packages and build tools
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    postgresql-dev \
    libzip-dev \
    zlib-dev \
    oniguruma-dev \
    curl-dev \
    imagemagick-dev \
    librdkafka-dev \
    bash \
    libxml2-dev \
    autoconf \
    make \
    g++ \
    pkgconf \
    linux-headers \
    libtool \
    nasm \
    && pecl install imagick rdkafka-6.0.0 \
    && docker-php-ext-enable imagick rdkafka \
    && apk del g++ make autoconf libtool nasm


# Install PECL extensions
RUN pecl install imagick rdkafka-6.0.0 && \
    docker-php-ext-enable imagick rdkafka

# Install opcache
RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install opcache

COPY ./.docker/opcache.ini $PHP_INI_DIR/conf.d/
COPY ./.docker/php.ini $PHP_INI_DIR/conf.d/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Permissions
RUN mkdir -p $APP_DIR/bootstrap/cache && \
    chown -R www-data:www-data $APP_DIR && \
    chmod -R 775 $APP_DIR/bootstrap/cache

# Entrypoint script
COPY .docker/init.sh /usr/bin/startx.sh
RUN chmod +x /usr/bin/startx.sh

ENTRYPOINT ["/usr/bin/startx.sh"]
