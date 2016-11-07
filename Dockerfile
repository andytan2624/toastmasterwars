FROM php:7-cli

RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
    && docker-php-ext-install mcrypt pdo_mysql

WORKDIR /code

EXPOSE 80

CMD ["php", "artisan", "serve", "--port=80", "--host=0.0.0.0"]