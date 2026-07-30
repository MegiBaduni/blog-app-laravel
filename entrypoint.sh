#!/bin/sh

# Zëvendëson portin që Nginx dëgjon me portin e përcaktuar nga Render ($PORT)
sed -i "s/listen 8080;/listen ${PORT:-10000};/g" /etc/nginx/sites-available/default

# Pastro dhe rifresko cache-in e Laravel
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache

# Bëj migrimin e databazës
php artisan migrate --force

# Nis Supervisor për të mbajtur Nginx dhe PHP-FPM gjallë
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
