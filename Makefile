.PHONY: up composer down appbash composer install-dev build-images appbash

up-prod:
	docker-compose -f prod.docker-compose.yml up -d

up:
	docker-compose up -d

down:
	docker-compose down

appbash:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) -it saude_app_1 bash

composer:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) -it saude_app_1 /bin/bash -c "curl -sS https://getcomposer.org/installer | php && php composer.phar install"

migration:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) -it saude_app_1 /bin/bash -c "./bin/console doctrine:migrations:migrate -n"

cp_env:
	cp .env.exemplo .env

db_rh:
	docker exec -it saude_db_rh_1 bash -c "/bin/sh /docker-entrypoint-initdb.d/db_rh.sh"

install-dev: cp_env build-images up composer migration db_rh

install-prod: cp_env build-images up-prod composer migration

build-images:
	pwd=$(`pwd`) && cd .docker/dev/app && docker image build --build-arg http_proxy=$(http_proxy) --build-arg https_proxy=$(https_proxy) -t ddtq/saude_app:0.2 . && cd $(pwd)
	pwd=$(`pwd`) && cd .docker/dev/web && docker image build --build-arg http_proxy=$(http_proxy) --build-arg https_proxy=$(https_proxy) -t ddtq/saude_web:0.1 . && cd $(pwd)
	pwd=$(`pwd`) && cd .docker/dev/db_rh && docker image build --build-arg http_proxy=$(http_proxy) --build-arg https_proxy=$(https_proxy) -t ddtq/saude_db_rh:0.1 . && cd $(pwd)
