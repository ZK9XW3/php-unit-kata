include .env
export

##################
# Docker commands
##################
php:
	docker exec -u www-data -ti ${PROJECT_NAME}_www bash
php-root:
	docker exec -u root -ti ${PROJECT_NAME}_www bash
stop:
	docker-compose stop
start:
	docker-compose up -d

##################
# Symfony/dev commands
##################
fix:
	docker exec -u www-data -ti ${PROJECT_NAME}_www bash -c "vendor/bin/php-cs-fixer fix src"
test:
	docker exec -u www-data -ti ${PROJECT_NAME}_www bash -c "php bin/phpunit"
fixtures:
	docker exec -u www-data -ti ${PROJECT_NAME}_php_apache bash -c "php bin/console doctrine:schema:drop --force && php bin/console doctrine:schema:create && php bin/console doctrine:fixtures:load"

##################
# Installation commands
##################
build:
	docker-compose up --build
build-daemon:
	docker-compose up --build -d
start-log:
	docker-compose up
install-phpunit:
	docker exec -u www-data -ti ${PROJECT_NAME}_www bash -c "composer require --dev symfony/test-pack"
# Install Symfony and specify the version. Example command: install-symfony version=7.2.x
install-symfony:
	docker exec -u www-data -ti ${PROJECT_NAME}_www bash -c "composer create-project symfony/skeleton:"${version}" ."
install-symfony-webapp:
	docker exec -u www-data -ti ${PROJECT_NAME}_www bash -c "composer require webapp"
init-project:
	cp .env.template .env
	cp ./backend/.env.dev ./backend/.env
	$(MAKE) build
	docker exec -u www-data -ti ${PROJECT_NAME}_www bash -c "composer install"
