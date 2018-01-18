FROM webdevops/php-nginx:7.1
LABEL maintainer="Sebastian Elisa Pfeifer <sebastian.pfeifer@unicorncloud.org>"

WORKDIR /app

COPY . /app
COPY ./.env-docker /app/.env
#RUN chown -R www-data:www-data /app
RUN chmod -R 777 /app

RUN apt-get update && \
  apt-get -y dist-upgrade && \
  rm -rf /var/lib/apt/lists/* && \
  apt-get clean

ADD "https://getcomposer.org/composer.phar" /app
RUN chmod +x /app/composer.phar
RUN /app/composer.phar install

ENV WEB_DOCUMENT_ROOT "/app/web"
ENV PHP_DISPLAY_ERRORS "1"

EXPOSE 80
