FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN docker-php-ext-install pdo pdo_mysql

ARG UID
ARG GID

WORKDIR /var/www/html

RUN usermod -s /bin/bash www-data \
    && groupmod --non-unique --gid $GID www-data \
    && usermod --non-unique --uid $UID --gid $GID www-data

RUN chown -R www-data:www-data /var/www/html