# Usa una imagen oficial de PHP con Apache
FROM php:8.0-apache

# Habilita mod_rewrite de Apache (a veces necesario para rutas amigables)
RUN a2enmod rewrite

# Instala las extensiones necesarias para tu proyecto PHP (por ejemplo, cURL)
RUN docker-php-ext-install curl

# Copia todos los archivos de tu proyecto al contenedor Docker
COPY . /var/www/html/

# Establece permisos adecuados para los archivos
RUN chown -R www-data:www-data /var/www/html

# Configura el contenedor para escuchar en el puerto 80
EXPOSE 80