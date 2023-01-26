#!/bin/sh

./bin/init-cert-chain.sh

npm install
npm run prod

composer install

php artisan storage:link
php artisan optimize:clear
php artisan migrate

chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache

# start apache service
apache2ctl -D FOREGROUND