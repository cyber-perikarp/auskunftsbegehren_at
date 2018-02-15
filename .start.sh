#!/usr/bin/env bash
./var/www/yii migrate --interactive=0 > /dev/stdout 2>&1
php-fpm -D && nginx
