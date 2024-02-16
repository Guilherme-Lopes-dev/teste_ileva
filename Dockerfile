# Use uma imagem base com PHP e Apache
FROM php:7.4-apache

# Defina o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Instalação do MySQL Server e do cliente MySQL
RUN apt-get update && apt-get install -y mariadb-server mariadb-client

# Copie os arquivos da aplicação para o contêiner
COPY . .

# Copie o script SQL de inicialização do banco de dados
COPY init.sql /docker-entrypoint-initdb.d/

# Instalação das extensões necessárias do PHP
RUN docker-php-ext-install pdo_mysql

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalação das dependências do Composer
RUN composer install

# Exposição das portas 80 (Apache) e 3306 (MySQL)
EXPOSE 80
EXPOSE 3306

# Comando a ser executado quando o contêiner for iniciado
CMD ["apache2-foreground"]
