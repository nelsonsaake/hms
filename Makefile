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

get:
	git pull origin main