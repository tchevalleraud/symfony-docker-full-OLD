-include .env
-include .env.local

user    := $(shell id -u)
group   := $(shell id -g)

ifeq ($(APP_ENV), prod)
	dc := USER_ID=$(user) GROUP_ID=$(group) docker-compose -f docker-compose.prod.yaml
else ifeq ($(APP_ENV), dev)
	dc := USER_ID=$(user) GROUP_ID=$(group) docker-compose -f docker-compose.dev.yaml
else ifeq ($(APP_ENV), test)
	dc := USER_ID=$(user) GROUP_ID=$(group) docker-compose -f docker-compose.test.yaml
endif

dr      := $(dc) run --rm
de      := $(dc) exec

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
docker-build:
	$(dc) pull --ignore-pull-failures
	$(dc) build

# ------------------------
# Dependances
# ------------------------
vendor/autoload.php:
	$(php) composer update
	touch vendor/autoload.php

# ------------------------
# Tests
# ------------------------