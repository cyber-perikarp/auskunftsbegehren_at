#!/usr/bin/env bash
sed -i.bak 's/'%mailpass%'/'"$MAILPASSWORD"'/' /var/www/.env
sed -i.bak 's/'%dbpass%'/'"$PASSWORD"'/' /var/www/.env
sed -i.bak 's/'%salt%'/'"$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 64 | head -n 1)"'/' /var/www/.env

cat /var/www/.env

./var/www/yii migrate --interactive=0 > /dev/stdout 2>&1
php-fpm7.1 -D && nginx
