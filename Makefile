docker_php:
	docker exec -it php bash

docker_db:
	docker exec -it db bash

docker_nginx:
	docker exec -it nginx bash

encore-watch:
	docker exec -it php bash  yarn encore dev --watch

encore-dev-server:
	docker exec -it php bash  yarn encore dev-server
