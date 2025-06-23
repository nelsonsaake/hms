.PHONY: run migrate setup get

run: 
	npm install && npm run build
	composer run dev

migrate:
	php artisan migrate

setup:
	composer require spatie/laravel-permission
	php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
	php artisan migrate
	php artisan storage:link
	
get:
	git pull origin main

clear:
	php artisan config:clear
	php artisan cache:clear
	php artisan view:clear
	php artisan route:clear
	php artisan optimize:clear
