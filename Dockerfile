# Usa una imagen base de PHP
FROM php:8.1-apache

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar archivos del proyecto
COPY . /var/www/html/

# Establecer el directorio de trabajo
WORKDIR /var/www/html/

# Ejecutar composer install
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto 10000
EXPOSE 10000

# Iniciar Apache
CMD ["apache2-foreground"]
