FROM php:8.4-cli

RUN apt-get update && apt-get install -y libpq-dev git unzip \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --optimize-autoloader --no-dev

EXPOSE 10000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
