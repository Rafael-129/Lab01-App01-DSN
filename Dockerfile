# Imagen base PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones de PHP necesarias para Laravel
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libpng-dev \
        libonig-dev \
        libicu-dev \
        libxml2-dev \
        libpq-dev \
        mariadb-client \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
        intl \
        mbstring \
        exif \
        pcntl \
        bcmath \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de la app
COPY . /var/www/html

# Configuración de Apache: DocumentRoot y permisos
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type f -exec chmod 664 {} \; \
    && find /var/www/html -type d -exec chmod 775 {} \; \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar php.ini personalizado y entrypoint
COPY docker/php.ini /usr/local/etc/php/conf.d/php-custom.ini
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Habilitar VirtualHost a public
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]


