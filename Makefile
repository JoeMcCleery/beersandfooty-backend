-include ../ubuntu-lamp/overrides.mk

LOCAL_PHP_VERSION=7.4

install:
	composer install
	npm install

serve:
	php artisan serve --host=${APP_HOST}

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
	make db-reset
	make generate-keys
	make flush
	make serve

-include .env
