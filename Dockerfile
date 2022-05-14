FROM php:8.0

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install git

WORKDIR /var/www

CMD tail -f /dev/null