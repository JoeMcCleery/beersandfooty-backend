serve:
	php artisan serve

db-migrate:
	php artisan migrate

db-rollback:
	php artisan migrate:reset

db-reset:
	php artisan migrate:refresh
