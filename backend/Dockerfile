# Use an official PHP runtime as a parent image
FROM php:8.2-apache

WORKDIR /var/www/html
COPY . .

# Install PDO extension and PostgreSQL driver
#RUN docker-php-ext-install pdo pdo_pgsql
RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
