#!/bin/sh
set -e

export PROGRAM=$1

# cd /app && composer install --no-dev --no-interaction --optimize-autoloader && composer dump-autoload

php -i > /dev/null

sleep 1;

mkdir -p /app/storage/logs
> /app/storage/logs/app.log && echo "." >> /app/storage/logs/app.log

chown -Rf www:www /app && chown -Rf www:www /var/lib/nginx/

supervisord -c /etc/supervisord/supervisord.conf -e error
