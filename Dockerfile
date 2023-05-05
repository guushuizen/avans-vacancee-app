FROM php:8.2-cli

ENV LOG_CHANNEL=stderr

RUN apt-get update -y && \
    apt-get install -y libxml2-dev libzip-dev libpng-dev

RUN docker-php-ext-install bcmath xml zip pcntl gd pdo pdo_mysql

WORKDIR /app

COPY --chown=www-data:www-data ./ ./

EXPOSE 80

STOPSIGNAL SIGINT

CMD ["php", "-S", "0.0.0.0:80"]
