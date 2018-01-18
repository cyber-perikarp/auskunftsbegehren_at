FROM webdevops/php-nginx:7.1

LABEL maintainer="Sebastian Elisa Pfeifer <sebastian.pfeifer@unicorncloud.org>"

COPY . /app
COPY ./.env-docker /app/.env
#RUN chown -R www-data:www-data /app
RUN chmod -R 777 /app

RUN apt-get update && \
  apt-get dist-upgrade -y && \
  rm -rf /var/lib/apt/lists/* && \
  apt-get clean

ENV WEB_DOCUMENT_ROOT "/app/web"
ENV PHP_DISPLAY_ERRORS "1"

EXPOSE 80