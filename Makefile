.PHONY: up composer down appbash composer install-dev build-images appbash
comando = $(comando)

test:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) saude_app_1 bash -c "php bin/phpunit";
	make chown-user

chown-user:
	sudo chown $(USER):$(USER) . -R

comando:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) saude_app_1 $(comando);
	make chown-user

up-prod:
	docker-compose -f prod.docker-compose.yml up -d
	make chown-user

up:
	docker-compose up -d
	make chown-user

down:
	docker-compose down

appbash:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) -it saude_app_1 bash
	make chown-user

dbrhbash:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) -it saude_db_rh_1 bash -c "psql -U saude -d rhparana"
	make chown-user

composer:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) -it saude_app_1 /bin/bash -c "curl -sS https://getcomposer.org/installer | php && php composer.phar install -vvv"
	make chown-user

migration:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) -it saude_app_1 /bin/bash -c "./bin/console doctrine:migrations:migrate -n"
	make chown-user

cp_env:
	cp .env.dist .env

db_rh:
	docker exec -it saude_db_rh_1 bash -c "/bin/sh /docker-entrypoint-initdb.d/db_rh.sh"

install-dev: cp_env build-images up composer migration db_rh chown-user

install-prod: cp_env build-images up-prod composer migration chown-user

build-images:
	pwd=$(`pwd`) && cd .docker/dev/app && docker image build --build-arg http_proxy=$(http_proxy) --build-arg https_proxy=$(https_proxy) -t ddtq/saude_app:0.2 . && cd $(pwd)
	pwd=$(`pwd`) && cd .docker/dev/web && docker image build --build-arg http_proxy=$(http_proxy) --build-arg https_proxy=$(https_proxy) -t ddtq/saude_web:0.1 . && cd $(pwd)
	pwd=$(`pwd`) && cd .docker/dev/db_rh && docker image build --build-arg http_proxy=$(http_proxy) --build-arg https_proxy=$(https_proxy) -t ddtq/saude_db_rh:0.1 . && cd $(pwd)


dbbash:
	docker exec -e http_proxy=$(http_proxy) -e https_proxy=$(http_proxy) -it saude_db_1 bash -c "psql -U saude -d saude"
	make chown-user
