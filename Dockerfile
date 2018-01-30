FROM alpine:latest
LABEL MAINTAINER Sebastian Elisa Pfeifer <sebastian.pfeifer@unicorncloud.org>

ADD https://php.codecasts.rocks/php-alpine.rsa.pub /etc/apk/keys/php-alpine.rsa.pub
RUN apk --update add ca-certificates
RUN echo "@php https://php.codecasts.rocks/v3.7/php-7.2" >> /etc/apk/repositories

RUN apk --update add \
  nginx \
  php7-pdo_mysql@php \
  php7-mysqlnd@php \
  php7@php \
  php7-mbstring@php \
  php7-fpm@php \
  php7-gd@php \
  php7-mbstring@php \
  php7-xml@php \
  php7-apcu@php \
  php7-ctype@php \
  php7-json@php \
  php7-session@php \
  php7-zip@php \
  php7-openssl@php \
  php7-curl@php \
  php7-dom@php \
  php7-phar@php \
  php7-pdo@php \
  curl

RUN rm -rf /var/cache/apk/*
RUN adduser -D -g 'www' www

ADD .nginx.conf /etc/nginx/nginx.conf
ADD .php.ini /etc/php7/php.ini
ADD .www.conf /etc/php7/php-fpm.d/www.conf

COPY . /var/www
COPY ./.env-docker /var/www/.env
COPY .start.sh /start.sh

RUN mkdir /var/pdfStorage
RUN chmod -R 777 /var/pdfStorage

RUN chmod +x start.sh

RUN chown -R www:www /var/lib/nginx
RUN chown -R www:www /var/www/
RUN chmod -R 755 /var/www

RUN ln -s /usr/bin/php7 /usr/bin/php

RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer
RUN chmod +x /usr/bin/composer
RUN composer install -d=/var/www


EXPOSE 80

ENTRYPOINT ["ash", "/start.sh"]

