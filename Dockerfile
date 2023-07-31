FROM php:8.0-fpm-alpine

RUN apk --update add --no-cache \
        php-phpdbg \
        tzdata \
        curl \
        gnupg \
        freetype \
        libpng \
        libjpeg-turbo \
        freetype-dev \
        libzip-dev \
        icu \
        icu-dev \
        supervisor \
        nginx \
        zip \
        bash \
        unixodbc \
        unixodbc-dev \
        linux-headers \
    && rm -rf /var/cache/apk/*

RUN docker-php-ext-install intl zip mysqli pdo pdo_mysql gd \
    && rm -rf /tmp/pear

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.5.5 \
    && composer --version

WORKDIR /app

COPY . /app

COPY docker/config/ /

COPY docker/scripts/ /

RUN if [ -z "`getent group 1000`" ]; then \
    addgroup -g 1000 -S www ; \
fi

RUN if [ -z "`getent passwd 1000`" ]; then \
    adduser -u 1000 -D -S -G www -h /app -g www www ; \
fi

RUN chmod +x /docker-entrypoint.sh
RUN chown -Rf www:www /app && chown -Rf www:www /var/lib/nginx/

RUN chown -Rf www-data:www-data /app && chown -Rf www-data:www-data /var/lib/nginx/

ENTRYPOINT ["sh", "/docker-entrypoint.sh", "api"]
