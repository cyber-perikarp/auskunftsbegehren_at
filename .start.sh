#!/usr/bin/env ash
./var/www/yii migrate --interactive=0 > /dev/stdout 2>&1
php-fpm7 -D && nginx
