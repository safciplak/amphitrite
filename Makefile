sailup:
	./vendor/bin/sail up
migratedb:
	./vendor/bin/sail artisan migrate
migratedbwithseed:
	./vendor/bin/sail artisan migrate:fresh --seed
queuework:
	./vendor/bin/sail artisan queue:work database --tries=3
queueworkforfailed:
	./vendor/bin/sail artisan queue:retry all 
horizon:
	./vendor/bin/sail artisan horizon
phpstan:
	./vendor/bin/phpstan analyse app
	./vendor/bin/phpstan analyse database
	./vendor/bin/phpstan analyse config
phpcs:
	./vendor/bin/phpcs app
phpcbf:
	./vendor/bin/phpcbf app
composerdumpautoload:
	composer dump-autoload
