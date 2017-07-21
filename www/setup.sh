#!/bin/bash

composer install --no-interaction
bin/console doctrine:database:create --no-interaction --if-not-exists
bin/console doctrine:schema:drop --force --no-interaction
bin/console doctrine:schema:create --no-interaction
