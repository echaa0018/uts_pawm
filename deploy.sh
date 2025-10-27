#!/bin/bash

echo "Running post-deployment tasks..."

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Seed database if needed (comment out if you don't want to seed on every deploy)
# php artisan db:seed --force

# Clear and cache config
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verify build directory exists
if [ -d "public/build" ]; then
    echo "✅ Build directory found"
    ls -la public/build
else
    echo "❌ Build directory not found - assets may not be compiled!"
fi

echo "Post-deployment tasks completed!"
