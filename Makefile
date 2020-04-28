serve:
	php artisan serve

db-migrate:
	php artisan migrate

db-rollback:
	php artisan migrate:reset

dumpautoload:
	composer dumpautoload

db-reset:
	make dumpautoload
	php artisan migrate:refresh --seed
