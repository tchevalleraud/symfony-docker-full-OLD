FROM php:7.4-fpm

ENV PHP_SECURITY_CHECHER_VERSION=1.0.0

RUN apt-get update && apt-get install -y wget git fish

RUN apt-get update && apt-get install -y libzip-dev libicu-dev && docker-php-ext-install pdo zip intl opcache
RUN pecl install apcu && docker-php-ext-enable apcu
RUN pecl install redis && docker-php-ext-enable redis
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install mysqli pdo_mysql
RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && pecl install imagick && docker-php-ext-enable imagick
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony
RUN curl -L https://github.com/fabpot/local-php-security-checker/releases/download/v${PHP_SECURITY_CHECHER_VERSION}/local-php-security-checker_${PHP_SECURITY_CHECHER_VERSION}_linux_$(dpkg --print-architecture) --output /usr/local/bin/local-php-security-checker && chmod +x /usr/local/bin/local-php-security-checker
RUN apt-get update && apt-get install -y ffmpeg

RUN pecl install xdebug && docker-php-ext-enable xdebug

ARG USER_ID
ARG GROUP_ID

RUN groupadd -f --gid $GROUP_ID user
RUN adduser --disabled-password --gecos '' --uid $USER_ID --gid $GROUP_ID user
USER user

WORKDIR /var/www

EXPOSE 9000