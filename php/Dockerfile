FROM php:8.4-apache
# Installer les extensions pour MySQL et PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
  && docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql
# Copier les fichiers de l'app vers /var/www/html
COPY ./www /var/www/html
# Donner accès en lecture/écriture au dossier uploads
RUN chmod -R 777 /var/www/html/uploads