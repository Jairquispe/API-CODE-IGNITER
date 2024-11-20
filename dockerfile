# Usa una imagen base con PHP y Composer
FROM php:8.1-cli

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
    mbstring \
    zip \
    intl

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html
WORKDIR /var/www/html

# Ejecuta Composer para instalar dependencias
RUN composer install --no-dev --optimize-autoloader --verbose

# Exponer el puerto (si aplica)
EXPOSE 8000

# Comando de inicio
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
