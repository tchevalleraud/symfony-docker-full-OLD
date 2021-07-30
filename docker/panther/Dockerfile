FROM php:7.4-fpm-alpine

RUN apk update && apk add --no-cache bash build-base shadow vim nano curl

ENV PANTHER_NO_SANDBOX 1
ENV PANTHER_CHROME_ARGUMENTS='--disable-dev-shm-usage'
RUN apk add --no-cache chromium chromium-chromedriver

ARG GECKODRIVER_VERSION=0.28.0
RUN apk add --no-cache firefox libzip-dev; \
    docker-php-ext-install zip
RUN wget -q https://github.com/mozilla/geckodriver/releases/download/v$GECKODRIVER_VERSION/geckodriver-v$GECKODRIVER_VERSION-linux64.tar.gz; \
    tar -zxf geckodriver-v$GECKODRIVER_VERSION-linux64.tar.gz -C /usr/bin; \
    rm geckodriver-v$GECKODRIVER_VERSION-linux64.tar.gz

RUN docker-php-ext-install pdo
RUN docker-php-ext-install mysqli pdo_mysql

RUN apk --update --no-cache add autoconf g++ make && \
    pecl install -f xdebug && \
    docker-php-ext-enable xdebug && \
    apk del --purge autoconf g++ make

ADD ./xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
ADD ./error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini

ARG USER_ID
ARG GROUP_ID

RUN groupadd -f --gid $GROUP_ID user
RUN useradd -u $USER_ID -ms /bin/bash -g user user
USER user

WORKDIR /var/www