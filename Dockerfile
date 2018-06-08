FROM ubuntu:rolling
LABEL MAINTAINER="Sebastian Elisa Pfeifer <sebastian.pfeifer@unicorncloud.org>"

RUN apt-get update && apt-get install -y software-properties-common
RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/nginx-mainline

RUN apt-get update && apt-get dist-upgrade -y
RUN apt-get -y install \
  nginx \
  php7.1-pdo \
  php7.1-mysqlnd \
  php7.1-cli \
  php7.1-mbstring \
  php7.1-fpm \
  php7.1-gd \
  php7.1-mbstring \
  php7.1-xml \
  php7.1-apcu \
  php7.1-ctype \
  php7.1-json \
  php7.1-zip \
  php7.1-curl \
  php7.1-dom \
  php7.1-phar \
  php7.1-pdo \
  curl

RUN rm -rf /var/apt/*
RUN apt-get purge software-properties-common -y
RUN apt-get autoremove -y
RUN apt-get clean

RUN adduser --system www
RUN addgroup --system www
RUN adduser www www

ADD .nginx.conf /etc/nginx/nginx.conf
ADD .php.ini /etc/php/7.1/php.ini
ADD .www.conf /etc/php/7.1/fpm/pool.d/www.conf

RUN mkdir /run/php
RUN chown -R www:www /run/php

COPY . /var/www
COPY .env-sample /var/www/.env
COPY .start.sh /start.sh

RUN mkdir /var/pdfStorage
RUN chmod -R 755 /var/pdfStorage

RUN chmod +x start.sh

RUN chown -R www:www /var/lib/nginx
RUN chown -R www:www /var/www/
RUN chmod -R 755 /var/www

RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer
RUN chmod +x /usr/bin/composer
RUN composer install -d /var/www

EXPOSE 80

ENTRYPOINT ["bash", "/start.sh"]

