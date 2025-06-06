FROM php:8.2-apache
# Installer les extensions pour PostgreSQL
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Copier les fichiers de l'app vers /var/www/html
COPY ./www /var/www/html
# Donner accès en lecture/écriture au dossier uploads
RUN chmod -R 777 /var/www/html/uploads

