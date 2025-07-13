# Utiliser une image PHP avec Apache
FROM php:8.2-apache

# Installer les dépendances système et les extensions PHP requises
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Copier le code source dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Définir les droits nécessaires
RUN chown -R www-data:www-data storage bootstrap/cache

# Installer Composer (déjà intégré dans l'image Render)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 80
EXPOSE 80
