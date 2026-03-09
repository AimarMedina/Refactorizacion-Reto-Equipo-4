#!/bin/sh
set -e

echo "Esperando a PostgreSQL..."

until php -r "new PDO('pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));" 2>/dev/null; do
  echo -n "."
  sleep 2
done

echo "PostgreSQL listo"

# Crear .env si no existe
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

php artisan key:generate --force

php artisan migrate --force --seed

php artisan config:clear
php artisan config:cache
php artisan route:cache

echo "Iniciando servidor Laravel..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
