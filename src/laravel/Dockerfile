FROM php:8-alpine

WORKDIR /app

COPY . .

RUN ./install.sh

CMD php artisan serve --host=0.0.0.0
