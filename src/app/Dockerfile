FROM php:7

WORKDIR /app

COPY . .

RUN ./install.sh

CMD php artisan serve --host=0.0.0.0
