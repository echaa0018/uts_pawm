#!/bin/bash
set -e

echo "🚀 Starting Laravel application..."

# Verify build directory exists
if [ ! -d "public/build" ]; then
    echo "❌ ERROR: public/build directory not found!"
    echo "Running emergency build..."
    npm install
    npm run build
fi

# Verify manifest exists
if [ ! -f "public/build/manifest.json" ]; then
    echo "❌ ERROR: manifest.json not found!"
    echo "Assets were not built properly. Running build..."
    npm run build
fi

echo "✅ Build directory verified"
ls -la public/build/

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Create storage link
echo "Creating storage link..."
php artisan storage:link || echo "Storage link already exists"

# Clear and optimize
echo "Optimizing application..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Application ready!"

# Start the server
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
