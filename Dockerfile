# Ndrysho nga php:8.2-... në php:8.4-...
FROM php:8.4-fpm

# Instalo varësitë e sistemit dhe shtesat e nevojshme për PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nginx \
    supervisor

# Pastro cache-in
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalo shtesat e PHP për Postgres dhe mbështetje të tjera
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Merr Composer nga imazhi zyrtar
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Vendos direktorinë e punës
WORKDIR /var/www

# Kopjo skedarët e projektit
COPY . .

# Instalo varësitë e Composer për prodhim
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Jep lejet e duhura për direktoritë e storage dhe bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Kopjo konfigurimin e Nginx
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Kopjo konfigurimin e Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Skriptë startuese për të konfiguruar portën dinamike të Render dhe migrimet
RUN echo '#!/bin/sh\n\
sed -i "s/listen 8080;/listen ${PORT:-10000};/g" /etc/nginx/sites-available/default\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan migrate --force\n\
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf' > /usr/bin/entrypoint.sh \
    && chmod +x /usr/bin/entrypoint.sh

# Ekspzo portën
EXPOSE 10000

# Komanda kryesore
CMD ["/usr/bin/entrypoint.sh"]
# Kopjo skriptin e hyrjes në kontejner
COPY entrypoint.sh /usr/bin/entrypoint.sh
RUN chmod +x /usr/bin/entrypoint.sh

# Vendos entrypoint për të nisur shërbimet
ENTRYPOINT ["entrypoint.sh"]