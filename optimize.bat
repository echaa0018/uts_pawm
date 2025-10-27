@echo off
echo Optimizing Laravel Application...
echo.

echo [1/5] Clearing old cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo [2/5] Caching configuration...
php artisan config:cache

echo.
echo [3/5] Caching routes...
php artisan route:cache

echo.
echo [4/5] Caching views...
php artisan view:cache

echo.
echo [5/5] Caching events...
php artisan event:cache

echo.
echo ✅ Optimization complete!
echo.
pause
