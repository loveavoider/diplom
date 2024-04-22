##################
# Variables
##################

DOCKER_COMPOSE = docker-compose -f ./docker/docker-compose.yml
DOCKER_COMPOSE_PHP_FPM_EXEC = ${DOCKER_COMPOSE} exec -u www-data php-fpm

build:
	${DOCKER_COMPOSE} build

up:
	${DOCKER_COMPOSE} up -d --remove-orphans

down:
	${DOCKER_COMPOSE} down --remove-orphans

ps:
	${DOCKER_COMPOSE} ps

##################
# App
##################

app_bash:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bash

doc_validate:
	php bin/console doctrine\:schema\:validate

mig_diff:
	php bin/console doctrine:migrations:diff

migrate:
	php bin/console doctrine:migrations:migrate