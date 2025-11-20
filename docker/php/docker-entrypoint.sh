#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
  set -- php-fpm "$@"
fi

cp .env.example .env

mkdir -p /var/www/storage
mkdir -p /var/www/storage/logs
mkdir -p /var/www/storage/debugbar
mkdir -p /var/www/bootstrap/cache

chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache
chmod -R 777 /var/www/storage/logs

composer install
php /var/www/artisan key:generate #For dev/local only
php /var/www/artisan optimize >/dev/null 2>&1 || true
php /var/www/artisan migrate
php /var/www/artisan db:seed

exec docker-php-entrypoint "$@"
