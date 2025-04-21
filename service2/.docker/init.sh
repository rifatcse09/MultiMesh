#!/bin/sh
set -e

echo "🎯 ENTRYPOINT SCRIPT STARTED" > /tmp/entrypoint.log
#php-fpm

# chown -R www-data:www-data /var/www/app/storage/
echo "Running entrypoint..."

#php /var/www/core/artisan queue:work

mkdir -p /var/www/app/storage/logs
touch /var/www/app/storage/logs/worker.log
echo "✅ CREATED worker.log" >> /tmp/entrypoint.log

chown -R www-data:www-data /var/www/app/storage

exec php-fpm

