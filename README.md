# SocialShare - Social Media Sharing Analytics Platform

A Laravel-based application for tracking and analyzing social media shares across multiple platforms (Facebook, Twitter, WhatsApp, Telegram, Email). Built with Docker for easy deployment and development.

## 🚀 Features

- Track social share clicks across multiple platforms
- Analytics dashboard for social sharing metrics
- Support for Facebook, Twitter, WhatsApp, Telegram, and Email sharing
- Modern UI built with Laravel, Vite, and Tailwind CSS
- Docker-based development environment
- Redis caching for improved performance
- MySQL database for data persistence
- phpMyAdmin for database management

## 📋 Prerequisites

Before you begin, ensure you have the following installed on your system:

- **Docker Desktop** (includes Docker and Docker Compose)
- **Git** (for cloning the repository)
- **Make** (optional, but recommended for easier command execution)

### Install Docker Desktop

Download and install Docker Desktop for your operating system:
- **Windows/Mac**: Download from [docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop/)
- **Linux**: Follow the [Docker Engine installation guide](https://docs.docker.com/engine/install/)

Docker Desktop includes both Docker and Docker Compose, so you don't need to install them separately.

### Verify Installation

```bash
docker --version
docker compose version
git --version
make --version  # Optional
```

## 🛠️ Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/Naim54/socialshare.git
cd socialshare
```

### 2. Environment Configuration

Create a `.env` file in the `laravel` directory:



### Copy this into .env

```env


APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:E9ISCwd69rvoKORv5VxTSGTZIMDuqrBlDmvu9RhE5pw=
APP_DEBUG=true
APP_TIMEZONE=Asia/Kuala_Lumpur
APP_URL=http://localhost:8080

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=socialshare-db-service
DB_PORT=3306
DB_DATABASE=socialshare
DB_USERNAME=socialshare
DB_PASSWORD=socialshare

SESSION_DRIVER=redis
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
SESSION_CONNECTION=default
SESSION_STORE=redis

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database


CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=predis
REDIS_HOST=socialshare-redis-service
REDIS_USERNAME=null
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_DB=0
QUEUE_CONNECTION=redis
CACHE_PREFIX=
CACHE_STORE=redis
REDIS_CACHE_DB=1 

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"



REDIS_CLUSTER=false

```

### 3. Build and Start Containers

**Option A: Using Make (Recommended)**

```bash
make setup
```

This single command will:
- Build Docker containers
- Start all services
- Install Composer dependencies
- Install NPM dependencies
- Generate application key
- Cache configuration
- Run database migrations

**Option B: Manual Setup**

```bash
# Build containers
make build

# Start containers
make up

# Install Composer dependencies
make composer-install

# Install NPM dependencies
make npm-install

# Generate application key
make key

# Run database migrations
make migrate

# Build frontend assets
make vite-build

# Clear and cache configuration
make cache
```

### 4. Access the Application

Once setup is complete, you can access:

- **Main Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
  - Username: `socialshare`
  - Password: `socialshare`
  - Server: `socialshare-db-service`

## 📁 Project Structure

```
socialshare/
├── docker/
│   ├── docker-compose.yml    # Docker Compose configuration
│   └── Dockerfile            # Multi-stage Docker build
├── laravel/                  # Laravel application
│   ├── app/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   └── ...
├── nginx/                    # Nginx configuration
│   └── default.conf
├── Makefile                  # Convenience commands
└── README.md
```

## 🎯 Common Commands

### Docker Operations

```bash
make build          # Build Docker containers
make up             # Start all containers
make down           # Stop all containers
make restart        # Restart all containers
make logs           # View logs from all containers
make logs-follow    # Follow logs (real-time)
make status         # Show container status
make clean          # Clean Docker resources
make rebuild        # Rebuild containers from scratch
```

### Container Access

```bash
make shell          # Access PHP container shell
make shell-root     # Access PHP container as root
make db-shell       # Access MySQL shell
```

### Laravel Operations

```bash
make artisan ARGS='command'  # Run any artisan command
make migrate                  # Run database migrations
make fresh                    # Fresh migration (drops all tables)
make seed                     # Run database seeders
make key                      # Generate application key
make storage-link             # Create storage symlink
make cache                    # Clear and cache config/routes
make optimize                 # Optimize Laravel for production
make test                     # Run PHPUnit tests
```

### Frontend Operations

```bash
make npm-install    # Install NPM dependencies
make npm-build      # Build assets with Vite
make npm-dev        # Run Vite dev server (hot reload)
make vite-build     # Build assets with Vite
```

### Combined Operations

```bash
make install       # Install both Composer and NPM dependencies
make update        # Update dependencies and rebuild assets
make refresh       # Run migrations, seeders, and cache
```

## 🔧 Development Workflow

### Running in Development Mode

1. Start containers:
   ```bash
   make up
   ```

2. Start Vite dev server (for hot module replacement):
   ```bash
   make npm-dev
   ```

3. Access the application at http://localhost:8080

### Making Changes

- **PHP/Laravel changes**: Edit files in `laravel/` directory (changes reflect immediately due to volume mounting)
- **Frontend changes**: Edit files in `laravel/resources/` - Vite will auto-reload if dev server is running
- **After adding new packages**: Run `make composer-install` or `make npm-install`
- **After code changes**: No restart needed, but you may need to run `make cache` to clear config cache

### Database Management

Access phpMyAdmin at http://localhost:8081 or use MySQL shell:

```bash
make db-shell
```

## 🐛 Troubleshooting

### Containers won't start

```bash
# Check if ports are already in use
netstat -tulpn | grep -E ':(8080|8081|3307|6379)'

# Clean and rebuild
make clean
make rebuild
```

### Permission Issues

```bash
# Fix storage permissions
make shell-root
chown -R www-data:www-data /var/www/storage
chmod -R 755 /var/www/storage
exit
```

### Application Key Missing

```bash
make key
```

### Database Connection Issues

- Verify containers are running: `make status`
- Check database is ready: `make db-shell`
- Verify `.env` file has correct database credentials

### Assets Not Loading

```bash
# Rebuild assets
make vite-build

# Or for development with hot reload
make npm-dev
```

### Clear All Caches

```bash
make cache
```

## 📊 Services & Ports

| Service | Container Name | Port | Description |
|---------|---------------|------|-------------|
| Nginx | socialshare-nginx-container | 8080 | Web server |
| PHP-FPM | socialshare-php-container | 9000 (internal) | PHP application server |
| MySQL | socialshare-db-container | 3307 | Database server |
| phpMyAdmin | socialshare-phpmyadmin-container | 8081 | Database management |
| Redis | socialshare-redis-container | 6379 | Cache & session store |

## 🔐 Default Credentials

- **Database**: 
  - Host: `socialshare-db-service` (from inside containers)
  - Database: `socialshare`
  - Username: `socialshare`
  - Password: `socialshare`
  - Root Password: `socialshare`

- **phpMyAdmin**:
  - Username: `socialshare`
  - Password: `socialshare`

⚠️ **Important**: Change these credentials in production!

## 🧪 Testing

Run the test suite:

```bash
make test
```

## 📝 API Endpoints

The application provides REST API endpoints for tracking social shares. See `laravel/routes/api.php` for details.

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙋 Support

If you encounter any issues or have questions:

1. Check the [Troubleshooting](#-troubleshooting) section
2. Review container logs: `make logs`
3. Open an issue on GitHub

---

**Happy Sharing! 🚀**
