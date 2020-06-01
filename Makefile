-include ../ubuntu-lamp/overrides.mk

LOCAL_PHP_VERSION=7.3

install:
	composer install
	npm install
	make generate-keys

serve:
	php artisan serve

db-reset:
	php artisan migrate:fresh --seed

generate-keys:
	php artisan key:generate
	php artisan passport:install --force
	php artisan passport:client --client

flush:
	composer dumpautoload
	php artisan cache:clear
	php artisan config:cache
	php artisan view:cache

deploy-prod:
	composer install --optimize-autoloader --no-dev
	npm install
	make generate-keys
	make db-reset
	make flush
	make serve

