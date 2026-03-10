#!/bin/sh
set -e

echo "Esperando a MySQL..."

until php -r "new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));" 2>/dev/null; do
  echo -n "."
  sleep 2
done

echo "MySQL listo"

echo "Creando base de datos si no existe..."
php -r "
\$pdo = new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
\$pdo->exec('CREATE DATABASE IF NOT EXISTS ' . getenv('DB_DATABASE'));
"

# Crear .env si no existe
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

php artisan key:generate --force

# Borra tablas y vuelve a migrar
php artisan migrate:fresh --force --seed

php artisan config:clear
php artisan config:cache
php artisan route:cache

echo "Iniciando servidor Laravel..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
