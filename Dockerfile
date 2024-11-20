FROM php:8.1-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    zip unzip libicu-dev libzip-dev git curl \
    && docker-php-ext-install intl pdo_mysql zip

# Instalar Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Copiar el código de la aplicación
WORKDIR /var/www/html
COPY . .

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto 80
EXPOSE 80

CMD ["apache2-foreground"]

# Establecer permisos en el directorio writable
RUN chown -R www-data:www-data /var/www/html/writable && chmod -R 0777 /var/www/html/writable
