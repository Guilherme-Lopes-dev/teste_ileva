FROM php:7.4-apache

WORKDIR /var/www/html

COPY . .

RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

EXPOSE 80

CMD ["apache2-foreground"]
