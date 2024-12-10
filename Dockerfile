# Usa una imagen oficial de PHP como base
FROM php:8.3-fpm

# Instalar dependencias necesarias para Symfony
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unixodbc-dev \
    gnupg2 \
    curl \
    libzip-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip pdo pdo_mysql
    
# Agregar claves e instalar Microsoft ODBC Driver sin usar apt-key
RUN curl https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor > /usr/share/keyrings/microsoft-archive-keyring.gpg && \
    echo "deb [arch=amd64 signed-by=/usr/share/keyrings/microsoft-archive-keyring.gpg] https://packages.microsoft.com/ubuntu/20.04/prod focal main" > /etc/apt/sources.list.d/mssql-release.list && \
    apt-get update && ACCEPT_EULA=Y apt-get install -y \
    msodbcsql18 \
    unixodbc-dev && \
    pecl install sqlsrv pdo_sqlsrv && \
    docker-php-ext-enable sqlsrv pdo_sqlsrv
# Crear un usuario para evitar ejecutar como root
RUN useradd -ms /bin/bash symfonyuser

RUN chown symfonyuser -R /var/www/html/

# Cambiar a ese usuario


# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar el proyecto al contenedor
COPY . /var/www/html
RUN mkdir -p /var/www/html/var/cache/dev
RUN mkdir -p /var/www/html/var/cache/prod
RUN mkdir -p /var/www/html/var/log
RUN chmod -R 777 /var/www/html/var/cache
RUN chmod -R 777 /var/www/html/var/log
USER symfonyuser
# Agregar directorio de Git como seguro
RUN git config --global --add safe.directory /var/www/html

# Instalar Composer en un directorio accesible por el usuario
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/var/www/html --filename=composer

# Agregar Composer al PATH para que sea accesible globalmente
ENV PATH="/var/www/html:${PATH}"

#USER root

# Eliminar el directorio vendor antes de la instalación para evitar conflictos
#RUN rm -rf /var/www/html/vendor
USER root
RUN chown -R symfonyuser /var/www/html/

USER symfonyuser
# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Cambiar los permisos de los directorios importantes
USER root
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/var/cache /var/www/html/vendor

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]