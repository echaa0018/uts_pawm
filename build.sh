#!/bin/bash
set -e

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Installing NPM dependencies..."
npm ci

echo "Building assets..."
npm run build

echo "Running migrations..."
php artisan migrate --force --no-interaction

echo "Caching config..."
php artisan config:cache --no-interaction

echo "Build completed!"
