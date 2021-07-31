-include .env
-include .env.local

app_dir := tchevalleraud_symfony-docker-full

user    := $(shell id -u)
group   := $(shell id -g)

ifeq ($(APP_ENV), prod)
	dc := USER_ID=$(user) GROUP_ID=$(group) docker-compose -f docker-compose.prod.yaml -p $(app_dir)_$(APP_ENV)
else ifeq ($(APP_ENV), dev)
	dc := USER_ID=$(user) GROUP_ID=$(group) docker-compose -f docker-compose.dev.yaml -p $(app_dir)_$(APP_ENV)
else ifeq ($(APP_ENV), test)
	dc := USER_ID=$(user) GROUP_ID=$(group) docker-compose -f docker-compose.test.yaml -p $(app_dir)_$(APP_ENV)
endif

dr      := $(dc) run --rm
de      := $(dc) exec

node    := $(dr) node
panther := $(dr) panther
php     := $(dr) --no-deps php
sy      := $(php) php bin/console

# ------------------------
# Default
# ------------------------
help:
	@echo "##############################"
	@echo "# HELP / ENV :" $(APP_ENV)
	@echo "##############################"

# ------------------------
# Command
# ------------------------
cache-clear:
	$(sy) cache:clear

docker-build:
	$(dc) pull --ignore-pull-failures
	$(dc) build

server-start:
	$(dc) up -d

server-stop:
	$(dc) down

# ------------------------
# Dependances
# ------------------------
doctrine-database-create:
	$(sy) doctrine:database:create -c mysql --if-not-exists
	$(sy) doctrine:database:create -c local
	$(sy) doctrine:schema:update --force --em mysql

doctrine-database-drop:
	$(sy) doctrine:database:drop -c mysql --force --if-exists
	$(sy) doctrine:database:drop -c local --force

doctrine-fixtures-load:
	$(sy) doctrine:fixtures:load -q  -n

public/assets:
	$(node) yarn
	$(node) yarn run build

public/assets-dev:
	$(node) yarn
	$(node) yarn run dev

vendor/autoload.php: composer.lock
	$(php) composer update
	touch vendor/autoload.php

# ------------------------
# Tests
# ------------------------
test-codecoverage:
	$(panther) ./vendor/bin/phpunit --exclude-group Screenshot --coverage-clover coverage.xml

test-screenshot:
	$(panther) ./vendor/bin/phpunit --testsuite Screenshot

test-unit-all:
	$(panther) ./vendor/bin/phpunit

test-unit-domain:
	$(panther) ./vendor/bin/phpunit --testsuite Domain

test-unit-globals:
	$(panther) ./vendor/bin/phpunit --testsuite Globals

test-unit-frontoffice:
	$(panther) ./vendor/bin/phpunit --testsuite FrontOffice