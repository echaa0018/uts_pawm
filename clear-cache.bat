@echo off
echo Clearing Laravel Cache...
echo.

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

echo.
echo ✅ Cache cleared!
echo.
pause
