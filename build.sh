#!/bin/bash
set -e

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Installing NPM dependencies..."
npm ci --include=dev

echo "Building assets..."
npm run build

echo "Verifying build output..."
if [ -d "public/build" ]; then
    echo "✅ Build directory created successfully"
    ls -la public/build
else
    echo "❌ ERROR: Build directory not found!"
    exit 1
fi

echo "Caching config..."
php artisan config:cache --no-interaction

echo "Build completed!"
