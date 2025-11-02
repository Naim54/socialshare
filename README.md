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

- **Docker** (version 20.10 or higher)
- **Docker Compose** (version 2.0 or higher)
- **Git** (for cloning the repository)
- **Make** (optional, but recommended for easier command execution)

### Verify Installation

```bash
docker --version
docker-compose --version
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

```bash
cp laravel/.env.example laravel/.env
```

If `.env.example` doesn't exist, create a `.env` file with the following configuration:

```env
APP_NAME=SocialShare
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=socialshare-db-service
DB_PORT=3306
DB_DATABASE=socialshare
DB_USERNAME=socialshare
DB_PASSWORD=socialshare

REDIS_HOST=socialshare-redis-service
REDIS_PORT=6379
REDIS_PASSWORD=null

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
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
