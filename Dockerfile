FROM php:7.4-apache

WORKDIR /var/www/html

# Instalação do MySQL Server
RUN apt-get update && apt-get install -y mariadb-server

# Cópia dos arquivos da aplicação
COPY . .

# Instalação das extensões necessárias do PHP
RUN docker-php-ext-install pdo_mysql

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalação das dependências do Composer
RUN composer install

# Exposição da porta 80 (Apache)
EXPOSE 80

# Comando a ser executado quando o contêiner for iniciado
CMD ["apache2-foreground"]
