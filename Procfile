release: php artisan config:clear && php artisan migrate --force && php artisan storage:link && php artisan config:cache && php artisan route:cache && php artisan view:cache
web: php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
