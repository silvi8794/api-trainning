FROM php:8.2-fpm-alpine

# Instalar dependencias necesarias
RUN apk add --no-cache \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
      libzip-dev \
      zip \
      bash \
      git \
      unzip \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip \
    && apk del --no-cache freetype-dev libjpeg-turbo-dev libpng-dev libzip-dev

# Copiar archivos del proyecto
WORKDIR /var/www
COPY . .

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Configuración de permisos
RUN chown -R www-data:www-data /var/www && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Configurar el contenedor para ejecutar PHP-FPM
USER www-data
WORKDIR /var/www
EXPOSE 9000
CMD ["php-fpm"]
