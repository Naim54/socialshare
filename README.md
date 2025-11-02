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

> **Note**: Docker Desktop includes both Docker and Docker Compose, so you don't need to install them separately.

### Verify Installation

```bash
docker --version
docker compose version
git --version
make --version  # Optional (only if you want to use Make commands)
```

## 🛠️ Installation & Setup

### Step 1: Clone the Repository

```bash
git clone https://github.com/Naim54/socialshare.git
cd socialshare
```

### Step 2: Configure Environment

Create a `.env` file in the `laravel` directory and copy all content from the `envtocopy` file:

```bash
# On Linux/Mac
cp envtocopy laravel/.env

# On Windows (PowerShell)
Copy-Item envtocopy laravel\.env
```

> **Note**: The `envtocopy` file contains all the necessary environment variables pre-configured for Docker.

### Step 3: Build and Start the Application

**Option A: Using Make (Recommended - Linux/Mac/WSL)**

Run this single command to set everything up:

```bash
make setup
```

This will automatically:
- Build Docker containers
- Start all services
- Install Composer dependencies
- Install NPM dependencies
- Generate application key
- Set file permissions (storage, bootstrap/cache, public/images)
- Cache configuration
- Run database migrations
- Set up database seeders

**Option B: Manual Setup**

If you prefer to run commands manually or don't have Make installed:

```bash
# Build and start containers
docker-compose -f docker/docker-compose.yml build
docker-compose -f docker/docker-compose.yml up -d

# Wait a few seconds for containers to initialize, then:
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/bootstrap/cache
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images

# Install PHP dependencies
docker-compose -f docker/docker-compose.yml exec socialshare-php-service composer install --no-scripts
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan package:discover

# Install NPM dependencies
docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm install

# Generate application key
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan key:generate

# Run database migrations and seeders
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan migrate
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan db:seed

# Build frontend assets
docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm run build

# Cache configuration
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan config:cache
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan route:cache
```

**Option C: Windows PowerShell Script**

If you're on Windows, you can use this PowerShell script to automate setup:

```powershell
# Create setup.ps1 file with the following content:

Write-Host "Building containers..." -ForegroundColor Cyan
docker-compose -f docker/docker-compose.yml build

Write-Host "Starting containers..." -ForegroundColor Cyan
docker-compose -f docker/docker-compose.yml up -d

Write-Host "Waiting for containers to be ready..." -ForegroundColor Yellow
Start-Sleep -Seconds 10

Write-Host "Installing dependencies..." -ForegroundColor Cyan
docker-compose -f docker/docker-compose.yml exec socialshare-php-service composer install --no-scripts
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan package:discover
docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm install

Write-Host "Setting up application..." -ForegroundColor Cyan
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan key:generate
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan migrate
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan db:seed
docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm run build
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan config:cache
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan route:cache

Write-Host "Setting permissions..." -ForegroundColor Cyan
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/bootstrap/cache
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images

Write-Host "`n✅ Setup complete! Visit http://localhost:8080" -ForegroundColor Green
```

Run it with: `.\setup.ps1`

> **Note**: You may need to run `Set-ExecutionPolicy RemoteSigned` first if you get a permission error.

### Step 4: Set File Permissions

> **Note**: If you used `make setup` (Option A), permissions are already set automatically. Skip this step if you used `make setup`.

This step is important for Laravel to function properly (only needed if you did manual setup):

**Using Make (Easiest):**
```bash
make permissions
```

**Or manually:**
```bash
make shell-root
chown -R www-data:www-data /var/www/storage
chmod -R 755 /var/www/storage
chmod -R 755 /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/public/images
chmod -R 755 /var/www/public/images
exit
```

**Using Docker Compose directly:**
```bash
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/bootstrap/cache
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images
```

### Step 5: Access the Application

Once setup is complete, you can access:

| Service | URL | Credentials |
|---------|-----|-------------|
| **Main Application** | http://localhost:8080 | N/A |
| **Admin Panel** | http://localhost:8080/admin/login | Email: `admin@test.com`<br>Password: `admin12345` |
| **phpMyAdmin** | http://localhost:8081 | Username: `socialshare`<br>Password: `socialshare`<br>Server: `socialshare-db-service` |

> ⚠️ **Security Note**: Please change the default admin password after first login in production environments!

## 📁 Project Structure

```
socialshare/
├── docker/
│   ├── docker-compose.yml    # Docker Compose configuration
│   └── Dockerfile            # Multi-stage Docker build
├── laravel/                  # Laravel application
│   ├── app/                  # Application code
│   ├── config/               # Configuration files
│   ├── database/              # Migrations, seeders, factories
│   ├── resources/             # Views, assets, lang files
│   ├── routes/                # Route definitions
│   └── public/                # Public assets (images stored here)
├── nginx/                     # Nginx configuration
│   └── default.conf
├── Makefile                   # Convenience commands
├── envtocopy                  # Environment template
└── README.md
```

> **Note**: Images are stored directly in `laravel/public/images/articles/` - no symlink needed! This makes setup easier, especially on Windows.

## 🎯 Common Commands

### Quick Reference

| Task | Make Command | Docker Compose Equivalent |
|------|-------------|---------------------------|
| Start containers | `make up` | `docker-compose -f docker/docker-compose.yml up -d` |
| Stop containers | `make down` | `docker-compose -f docker/docker-compose.yml down` |
| View logs | `make logs` | `docker-compose -f docker/docker-compose.yml logs` |
| Access shell | `make shell` | `docker-compose -f docker/docker-compose.yml exec socialshare-php-service bash` |
| Run migrations | `make migrate` | `docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan migrate` |
| Build assets | `make vite-build` | `docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm run build` |

### Detailed Command List

**Docker Operations:**
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

**Laravel Operations:**
```bash
make artisan ARGS='command'  # Run any artisan command
make migrate                  # Run database migrations
make fresh                    # Fresh migration (drops all tables)
make seed                     # Run database seeders
make key                      # Generate application key
make cache                    # Clear and cache config/routes
make optimize                 # Optimize Laravel for production
make test                     # Run PHPUnit tests
make permissions              # Fix file permissions (storage, bootstrap, public)
```

**Frontend Operations:**
```bash
make npm-install    # Install NPM dependencies
make npm-build      # Build assets with Vite
make npm-dev        # Run Vite dev server (hot reload)
make vite-build     # Build assets with Vite
```

**Container Access:**
```bash
make shell          # Access PHP container shell
make shell-root     # Access PHP container as root
make db-shell       # Access MySQL shell
```

## 🔧 Development Workflow

### Starting Development

1. **Start containers:**
   ```bash
   make up
   ```

2. **Start Vite dev server** (for hot module replacement):
   ```bash
   make npm-dev
   ```

3. **Access the application** at http://localhost:8080

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

### Containers Won't Start

**Check if ports are in use:**
```bash
# Linux/Mac
netstat -tulpn | grep -E ':(8080|8081|3307|6379)'

# Windows (PowerShell)
netstat -ano | findstr "8080 8081 3307 6379"
```

**Clean and rebuild:**
```bash
make clean
make rebuild
```

### Permission Issues

If you see permission errors, fix them with:

```bash
make shell-root
chown -R www-data:www-data /var/www/storage
chmod -R 755 /var/www/storage
chmod -R 755 /var/www/bootstrap/cache
chmod -R 755 /var/www/public/images
exit
```

**Windows (PowerShell):**
```powershell
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/bootstrap/cache
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images
```

### Application Key Missing

```bash
make key
```

### Database Connection Issues

1. Verify containers are running: `make status`
2. Check database is ready: `make db-shell`
3. Verify `.env` file has correct database credentials

### Assets Not Loading

**Rebuild assets:**
```bash
make vite-build
```

**Or for development with hot reload:**
```bash
make npm-dev
```

### Images Not Loading

If images are not showing (broken image icons), check the following:

1. **Verify the images directory exists:**
   ```bash
   make shell
   ls -la /var/www/public/images/articles/
   exit
   ```

2. **Fix permissions:**
   ```bash
   make shell-root
   chown -R www-data:www-data /var/www/public/images
   chmod -R 755 /var/www/public/images
   exit
   ```

3. **Check if images exist:**
   - The seeded articles include image files in the repository
   - Visit: http://localhost:8080/images/articles/ to see if files exist
   - If the directory is empty, images will work once you upload them through the admin panel

> **Note**: Images are stored directly in `public/images/articles/` - no symlink needed. The repository includes seeded article images, so they should display correctly after setup.

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

**Database:**
- Host: `socialshare-db-service` (from inside containers)
- Database: `socialshare`
- Username: `socialshare`
- Password: `socialshare`
- Root Password: `socialshare`

**phpMyAdmin:**
- Username: `socialshare`
- Password: `socialshare`

**Admin Panel:**
- Email: `admin@test.com`
- Password: `admin12345`

⚠️ **Important**: Change these credentials in production!

## 🧪 Testing

Run the test suite:




**Happy Sharing! 🚀**
