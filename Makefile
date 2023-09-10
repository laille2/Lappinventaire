phpunit:
	symfony php bin/phpunit $@
	
EXEC_PHP      = php

SYMFONY       = $(EXEC_PHP) bin/console

serve: ## Serve the application with HTTPS support (add "--no-tls" to disable https)
	@$(SYMFONY_BIN) serve

SHELL := /bin/bash

.PHONY: tests

tests:
	symfony console doctrine:database:drop --force --env=test || true
	symfony console doctrine:database:create --env=test
	symfony console doctrine:migrations:migrate -n --env=test
	symfony console doctrine:fixtures:load -n --env=test
	symfony php bin/phpunit $@

