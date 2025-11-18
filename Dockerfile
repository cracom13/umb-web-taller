# Dockerfile
FROM php:8.2-apache

# Habilitar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copiar API
COPY api/ /var/www/html/

# Copiar certificado CA (si lo vas a incluir en el repo; mejor: agregarlo vía secret en Render)
# COPY certs/ca.pem /etc/ssl/certs/ca.pem

# Habilitar rewrite
RUN a2enmod rewrite

EXPOSE 80
