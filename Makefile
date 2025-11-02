.PHONY: help build up down restart logs shell composer artisan npm migrate fresh seed test clean

# Variables
DOCKER_COMPOSE = docker-compose -f docker/docker-compose.yml
PHP_CONTAINER = socialshare-php-container
NGINX_CONTAINER = socialshare-nginx-container
DB_CONTAINER = socialshare-db-container

# Default target
help:
	@echo "Available commands:"
	@echo "  make build          - Build Docker containers"
	@echo "  make up             - Start all containers"
	@echo "  make down           - Stop all containers"
	@echo "  make restart        - Restart all containers"
	@echo "  make logs           - View logs from all containers"
	@echo "  make logs-follow    - Follow logs from all containers"
	@echo "  make shell          - Access PHP container shell"
	@echo "  make shell-root     - Access PHP container as root"
	@echo "  make composer-install - Install Composer dependencies"
	@echo "  make composer-update - Update Composer dependencies"
	@echo "  make artisan        - Run artisan command (usage: make artisan ARGS='migrate')"
	@echo "  make npm-install    - Install NPM dependencies"
	@echo "  make npm-build      - Build assets with Vite"
	@echo "  make npm-dev        - Run Vite dev server"
	@echo "  make daisyui        - Install DaisyUI only (one-time setup)"
	@echo "  make vite-build     - Build assets with Vite (use after changes)"
	@echo "  make migrate        - Run database migrations"
	@echo "  make fresh          - Fresh migration (drop all tables and re-run)"
	@echo "  make seed           - Run database seeders"
	@echo "  make test           - Run PHPUnit tests"
	@echo "  make key            - Generate application key"
	@echo "  make storage-link   - Create storage symlink"
	@echo "  make cache          - Clear and cache config/routes"
	@echo "  make optimize       - Optimize Laravel for production"
	@echo "  make clean          - Clean Docker resources (containers, volumes, images)"
	@echo "  make rebuild         - Rebuild containers from scratch"
	@echo "  make db-shell       - Access MySQL shell"
	@echo "  make db-reset       - Reset database (drop and recreate)"
	@echo "  make status         - Show container status"

# Docker commands
build:
	@echo "Building Docker containers..."
	$(DOCKER_COMPOSE) build

up:
	@echo "Starting containers..."
	$(DOCKER_COMPOSE) up -d

down:
	@echo "Stopping containers..."
	$(DOCKER_COMPOSE) down

restart:
	@echo "Restarting containers..."
	$(DOCKER_COMPOSE) restart

logs:
	$(DOCKER_COMPOSE) logs --tail=50

logs-follow:
	$(DOCKER_COMPOSE) logs -f

status:
	$(DOCKER_COMPOSE) ps

# Container access
shell:
	@echo "Accessing PHP container..."
	$(DOCKER_COMPOSE) exec socialshare-php-service bash

shell-root:
	@echo "Accessing PHP container as root..."
	$(DOCKER_COMPOSE) exec -u root socialshare-php-service bash

db-shell:
	@echo "Accessing MySQL shell..."
	$(DOCKER_COMPOSE) exec socialshare-db-service mysql -u socialshare -psocialshare socialshare

# Composer commands
composer-install:
	@echo "Installing Composer dependencies..."
	$(DOCKER_COMPOSE) exec socialshare-php-service composer install --no-scripts
	@echo "Running package discovery..."
	@$(DOCKER_COMPOSE) exec socialshare-php-service php artisan package:discover || true

composer-update:
	@echo "Updating Composer dependencies..."
	$(DOCKER_COMPOSE) exec socialshare-php-service composer update --no-scripts
	@echo "Running package discovery..."
	@$(DOCKER_COMPOSE) exec socialshare-php-service php artisan package:discover || true

# Artisan commands
artisan:
	@if [ -z "$(ARGS)" ]; then \
		echo "Usage: make artisan ARGS='command'"; \
	else \
		$(DOCKER_COMPOSE) exec socialshare-php-service php artisan $(ARGS); \
	fi

migrate:
	@echo "Running migrations..."
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan migrate

fresh:
	@echo "Running fresh migrations..."
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan migrate:fresh

seed:
	@echo "Running seeders..."
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan db:seed

key:
	@echo "Generating application key..."
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan key:generate

storage-link:
	@echo "Creating storage symlink..."
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan storage:link

cache:
	@echo "Clearing and caching config/routes..."
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan config:clear
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan route:clear
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan cache:clear
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan config:cache
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan route:cache

optimize:
	@echo "Optimizing Laravel for production..."
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan config:cache
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan route:cache
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan view:cache

# NPM commands
npm-install:
	@echo "Installing NPM dependencies..."
	$(DOCKER_COMPOSE) exec socialshare-php-service npm install

npm-build:
	@echo "Building assets with Vite..."
	$(DOCKER_COMPOSE) exec socialshare-php-service npm run build

npm-dev:
	@echo "Starting Vite dev server..."
	$(DOCKER_COMPOSE) exec socialshare-php-service npm run dev

daisyui:
	@echo "Installing DaisyUI..."
	$(DOCKER_COMPOSE) exec socialshare-php-service npm install daisyui@latest
	@echo "DaisyUI installed! Run 'make vite-build' to build assets."

vite-build: npm-build
	@echo "Assets built with Vite!"

# Testing
test:
	@echo "Running PHPUnit tests..."
	$(DOCKER_COMPOSE) exec socialshare-php-service php artisan test

# Database commands
db-reset:
	@echo "Resetting database..."
	@read -p "This will drop all tables. Are you sure? [y/N] " confirm && \
	if [ "$$confirm" = "y" ] || [ "$$confirm" = "Y" ]; then \
		$(DOCKER_COMPOSE) exec socialshare-php-service php artisan migrate:fresh; \
	else \
		echo "Cancelled."; \
	fi

# Setup commands
setup: build up composer-install npm-install key cache migrate seed
	@echo "Setup complete! Visit http://localhost:8080"

# Cleanup commands
clean:
	@echo "Cleaning Docker resources..."
	$(DOCKER_COMPOSE) down -v
	docker system prune -f

rebuild: clean build
	@echo "Containers rebuilt from scratch"

# Quick shortcuts
ps: status
install: composer-install npm-install
update: composer-update npm-build
refresh: migrate seed cache

