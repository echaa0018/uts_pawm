#!/bin/bash

echo "🚀 Starting Laravel application..."

# CRITICAL: Clear all caches FIRST to ensure fresh config
echo "🧹 Clearing all caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

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

# Test database connection
echo "🔍 Testing database connection..."
echo "DB_HOST: ${DB_HOST}"
echo "DB_DATABASE: ${DB_DATABASE}"
echo "DB_CONNECTION: ${DB_CONNECTION}"

# Run migrations with verbose output
echo "📦 Running database migrations..."
php artisan migrate --force --verbose || {
    echo "❌ Migration failed! Trying to diagnose..."
    php artisan config:show database || echo "Could not show config"
    exit 1
}

echo "✅ Migrations completed!"

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link || echo "Storage link already exists"

# NOW cache everything (after migrations succeed)
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Application ready!"
echo "Starting server on port ${PORT:-8080}..."

# Start the server
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
