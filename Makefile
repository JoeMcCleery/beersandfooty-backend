-include ../ubuntu-lamp/overrides.mk

LOCAL_PHP_VERSION=7.3

install:
	composer install
	npm install
	php artisan passport:install
	cp ./.env.example ./.env

serve:
	php artisan serve

db-reset:
	php artisan migrate:fresh --seed

generate-keys:
	php artisan key:generate
	php artisan passport:keys --force

flush:
	composer dumpautoload
	php artisan cache:clear
	php artisan config:cache
	php artisan route:cache
	php artisan view:cahce

deploy-prod:
	make install
	make generate-keys
	make serve
	php artisan down
	make db-reset
	composer install --optimize-autoloader --no-dev
	make flush
	php artisan up
