DOCKER_BRIDGE_IP=$(shell docker network inspect bridge --format='{{(index .IPAM.Config 0).Gateway}}')

help:
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install all third party references
	docker compose exec -T phpfpm composer install

up: ## Start the application
	docker compose up --detach

down: ## Stop the application
	docker compose down --remove-orphans

login: ## Login to the docker php container
	docker compose exec phpfpm bash

logs: ## Display container logs (defaults to all containers, provide optional parameter container=[container] to follow just one)
	docker compose logs --tail=0 --follow ${container}

