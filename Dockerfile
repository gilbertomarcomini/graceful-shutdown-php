FROM php8.0:fpm-2.1

WORKDIR /app

COPY ./composer.* ./
COPY / /app
RUN apk add --no-cache git
