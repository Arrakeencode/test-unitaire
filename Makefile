SHELL := /bin/bash

tests:
	php bin/console doctrine:database:drop --if-exists --force --env=test || true
	php bin/console doctrine:database:create --env=test
	php bin/console doctrine:schema:create --env=test
	php bin/console doctrine:fixtures:load -n --env=test
	php bin/phpunit $(MAKECMDGOALS)
.PHONY: tests

TRUSTED_PROXIES=127.0.0.1