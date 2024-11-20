# Usa una imagen base con PHP y Apache
FROM php:8.1-apache

# Instala las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html/

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Ejecuta Composer para instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto en el que PHP servirá la aplicación
EXPOSE 10000

# Inicia Apache en primer plano
CMD ["apache2-foreground"]
