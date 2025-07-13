FROM php:8.2-apache

# Installer extensions nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev unzip zip git \
    && docker-php-ext-install pdo pdo_pgsql

# Activer mod_rewrite
RUN a2enmod rewrite

# Copier le code source
COPY . /var/www/html

# Définir le bon répertoire de travail
WORKDIR /var/www/html

# Donner les bons droits
RUN chown -R www-data:www-data storage bootstrap/cache

# Modifier le VirtualHost Apache pour pointer vers le dossier public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Installer les dépendances PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port
EXPOSE 80
