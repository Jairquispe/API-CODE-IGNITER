# Usa una imagen oficial de PHP
FROM php:8.0-apache

# Copia el código fuente al contenedor
COPY . /var/www/html/

# Exponer el puerto que usará el servidor
EXPOSE 10000

# Inicia Apache con PHP
CMD ["apache2-foreground"]
