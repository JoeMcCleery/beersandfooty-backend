-include ../ubuntu-lamp/overrides.mk

LOCAL_PHP_VERSION=7.4

install:
	composer install
	npm install

serve:
	php artisan serve --host=${APP_HOST}

db-seed-fresh:
	php artisan migrate:fresh --seed

db-migrate-fresh:
	php artisan migrate:refresh

generate-keys:
	php artisan key:generate
	php artisan passport:install --force
	php artisan passport:client --client

flush:
	composer dumpautoload
	php artisan cache:clear
	php artisan config:cache
	php artisan view:cache

setup-storage:
	php artisan storage:link
	mkdir ./storage/app/public/uploads

deploy-prod:
	composer install --optimize-autoloader --no-dev
	npm install
	make flush
	make serve

-include .env
