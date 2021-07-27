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

node        := $(dr) node
php         := $(dr) --no-deps php
sy          := $(php) php bin/console

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

public/assets:
	$(node) yarn
	$(node) yarn run build

public/assets-dev:
	$(node) yarn
	$(node) yarn run dev

vendor/autoload.php:
	$(php) composer update -w
	touch vendor/autoload.php

# ------------------------
# Tests
# ------------------------