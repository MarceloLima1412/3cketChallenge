up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

build-clean:
	docker-compose build --no-cache --force-rm --compress

migrate:
	docker exec -it 3cket_app php artisan migrate

migrate-seed:
	docker exec -it 3cket_app php artisan migrate:fresh --seed

rollback:
	docker exec -it 3cket_app php artisan migrate:rollback

seed:
	php --version artisan db:seed

seed-class:
	docker exec -it 3cket_app php artisan db:seed --class=$(class)

run:
	docker exec -it 3cket_app php artisan $(command)

composer-install:
	docker exec -it 3cket_app composer install

composer-update:
	docker exec -it 3cket_app composer update

composer-require:
	docker exec -it 3cket_app composer require $(lib)

clean-cache:
	docker exec -it 3cket_app php artisan cache:clear
	docker exec -it 3cket_app php artisan config:clear
	docker exec -it 3cket_app composer dump-autoload -o

api-update-availability-queues:
	docker exec -it 3cket_app php artisan queue:work --queue=LocalApiAvailabilityService.fifo --daemon --tries=3 --timeout=0 --stop-when-empty --sleep=1

api-update-rate-queues:
	docker exec -it 3cket_app php artisan queue:work --queue=LocalApiRoomRateBulkService.fifo --daemon --tries=3 --timeout=0 --stop-when-empty --sleep=1

api-update-restrictions-queues:
	docker exec -it 3cket_app php artisan queue:work --queue=LocalApiRoomRateRestrictionBulkService.fifo --daemon --tries=3 --timeout=0 --stop-when-empty --sleep=1

check-version:
	docker exec -it 3cket_app php artisan --version
