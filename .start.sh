#!/usr/bin/env bash
awk '{sub(/%mailpass%/,"$PASSWORD")}1' /var/www/.env
awk '{sub(/%dbpass%/,"$MAILPASSWORD")}1' /var/www/.env

./var/www/yii migrate --interactive=0 > /dev/stdout 2>&1
php-fpm7.1 -D && nginx
