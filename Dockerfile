FROM php:apache

RUN apt-get update \
    && apt-get install -y postgresql-client libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql

COPY . /var/www/html/
COPY api/.env /var/www/html/api/.env

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && a2enmod rewrite

COPY php.ini /usr/local/etc/php/

EXPOSE 80
