FROM php:8.4-cli

WORKDIR /var/www/html

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    zip \
    gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar solo el backend
COPY backend/ /var/www/html/

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Copiar entrypoint y darle permisos
COPY docker/backend/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Definir entrypoint
ENTRYPOINT ["/entrypoint.sh"]
