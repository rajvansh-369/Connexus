FROM php:8.2-fpm

# install system deps
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libicu-dev \
    libxml2-dev zip zlib1g-dev libssl-dev

# install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl sockets

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# copy app
COPY . /var/www/html

# install composer deps (if any)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader || true

# set permissions (adjust as needed)
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000 6001

CMD ["php-fpm"]
