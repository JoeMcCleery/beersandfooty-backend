-include ../ubuntu-lamp/overrides.mk
LOCAL_PHP_VERSION=7.3

serve:
	php artisan serve

db-reset:
	composer dumpautoload
	php artisan migrate:fresh --seed

generate-keys:
	php artisan key:generate

deploy-prod:
	make serve
	php artisan down
	make db-reset
	composer install --optimize-autoloader --no-dev
	php artisan config:cache
	php artisan route:cache
	php artisan view:cache
	php artisan up
