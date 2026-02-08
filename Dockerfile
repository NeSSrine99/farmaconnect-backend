# PHP + Apache
FROM php:8.2-apache


RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql zip


RUN a2enmod rewrite


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html


COPY . .


RUN composer install --no-interaction --optimize-autoloader


RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 755 storage bootstrap/cache


ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

EXPOSE 80
