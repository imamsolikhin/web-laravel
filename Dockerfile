FROM php:7.4-fpm

RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql && apt-get install -y ca-certificates curl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer install --no-dev

CMD php -S 0.0.0.0:9002 -t public

EXPOSE 9002
