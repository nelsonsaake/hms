.PHONY: run migrate setup get

run: 
	npm install && npm run build
	composer run dev

migrate:
	php artisan migrate

setup:
	composer require blade-ui-kit/blade-heroicons
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
	php artisan permission:cache-reset

raps:
	php artisan db:seed --class=RolesAndPermissionsSeeder
	php artisan db:seed --class=UserSeeder
	
# Port variable
PORT = 3306

check-port-cmd:
	netstat -ano | findstr :$(PORT) || echo Port $(PORT) is free\

check-port-ps:
	powershell -Command "Get-NetTCPConnection -LocalPort $(PORT) -ErrorAction SilentlyContinue | Format-Table -AutoSize || Write-Host 'Port $(PORT) is free'"

kill:
	taskkill /PID $(word 2,$(MAKECMDGOALS)) /F
	
