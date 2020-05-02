-include ../ubuntu-lamp/overrides.mk
LOCAL_PHP_VERSION=7.3

serve:
	php artisan serve

db-reset:
	composer dumpautoload

generate-keys:
	php artisan key:generate

