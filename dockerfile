# Usa una imagen base con PHP y Composer ya instalados
FROM php:8.1-cli

# Instala Composer manualmente si no está disponible
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Define el directorio de trabajo
WORKDIR /var/www/html

# Ejecuta Composer para instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto 8000 para desarrollo (si aplica)
EXPOSE 8000

# Comando para iniciar la aplicación
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
