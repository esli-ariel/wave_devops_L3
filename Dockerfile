# Utiliser PHP 8.2 avec Apache
FROM php:8.2-apache

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Nettoyer le cache apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Installer les dépendances Node.js
RUN npm install && npm run build

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Configurer Apache
RUN a2enmod rewrite
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Exposer le port 80
EXPOSE 80

# Script de démarrage
CMD ["apache2-foreground"]