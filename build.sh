#!/bin/bash
set -e

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Installing NPM dependencies..."
npm ci --include=dev

echo "Building assets..."
npm run build

echo "Caching config..."
php artisan config:cache --no-interaction

echo "Build completed!"
