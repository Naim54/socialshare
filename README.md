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
make --version  # Optional (only if you want to use Make commands)
```

> **Note for Windows Users**: If you don't have WSL (Windows Subsystem for Linux) or Make installed, you can use Docker Compose commands directly. See the [Windows Setup (Without Make/WSL)](#-windows-setup-without-makewsl) section below.

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

> **Note**: Images are stored directly in `public/images/articles/` - no symlink needed! This makes setup easier, especially on Windows.

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

# Set permissions (important!)
make shell-root
chown -R www-data:www-data /var/www/storage
chmod -R 755 /var/www/storage
chmod -R 755 /var/www/bootstrap/cache
chmod -R 755 /var/www/public/images
exit
```

### 4. Set Permissions

Set proper permissions for storage, cache, and public images directories:

**Using Make:**

```bash
# Fix permissions
make shell-root
chown -R www-data:www-data /var/www/storage
chmod -R 755 /var/www/storage
chmod -R 755 /var/www/bootstrap/cache
chmod -R 755 /var/www/public/images
exit
```

**Windows (PowerShell/CMD):**

```powershell
# Fix permissions (as root)
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/bootstrap/cache
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images
```

> **Note**: Images are stored directly in `public/images/articles/` (no symlink needed!). This makes setup easier, especially on Windows.

### 5. Access the Application

Once setup is complete, you can access:

- **Main Application**: http://localhost:8080
- **Admin Panel**: http://localhost:8080/admin/login
  - **Username/Email**: `admin@test.com`
  - **Password**: `admin12345`
  - After login, you'll be redirected to the admin dashboard at http://localhost:8080/admin/dashboard
- **phpMyAdmin**: http://localhost:8081
  - Username: `socialshare`
  - Password: `socialshare`
  - Server: `socialshare-db-service`

> **Security Note**: Please change the default admin password after first login in production environments!

## 🪟 Windows Setup (Without Make/WSL)

If you're on Windows and don't have WSL or Make installed, you can use Docker Compose commands directly. Docker Desktop works perfectly on Windows without WSL.

### Quick Setup (Windows)

Open **PowerShell** or **Command Prompt** in the project directory and run:

```powershell
# 1. Build and start containers
docker-compose -f docker/docker-compose.yml build
docker-compose -f docker/docker-compose.yml up -d

# 2. Wait a few seconds for containers to be ready, then install dependencies
docker-compose -f docker/docker-compose.yml exec socialshare-php-service composer install --no-scripts
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan package:discover

# 3. Install NPM dependencies
docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm install

# 4. Generate application key
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan key:generate

# 5. Run migrations and seeders
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan migrate
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan db:seed

# 6. Build frontend assets
docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm run build

# 7. Set permissions (important!)
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/bootstrap/cache
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images

# 8. Cache configuration
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan config:cache
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan route:cache
```

> **Note**: You can use either `docker-compose` (hyphen) or `docker compose` (space) - both work with Docker Desktop. The commands above use `docker-compose` for consistency with the Makefile.

### Common Commands (Windows - PowerShell/CMD)

Replace `make <command>` with these Docker Compose equivalents:

| Make Command | Windows Equivalent |
|--------------|-------------------|
| `make up` | `docker-compose -f docker/docker-compose.yml up -d` |
| `make down` | `docker-compose -f docker/docker-compose.yml down` |
| `make logs` | `docker-compose -f docker/docker-compose.yml logs` |
| `make shell` | `docker-compose -f docker/docker-compose.yml exec socialshare-php-service bash` |
| `make migrate` | `docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan migrate` |
| `make seed` | `docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan db:seed` |
| `make npm-build` | `docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm run build` |
| `make cache` | `docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan config:cache` |

### PowerShell Script (Optional)

You can create a PowerShell script (`setup.ps1`) to automate the setup:

```powershell
# setup.ps1
Write-Host "Building containers..."
docker-compose -f docker/docker-compose.yml build

Write-Host "Starting containers..."
docker-compose -f docker/docker-compose.yml up -d

Write-Host "Waiting for containers to be ready..."
Start-Sleep -Seconds 10

Write-Host "Installing dependencies..."
docker-compose -f docker/docker-compose.yml exec socialshare-php-service composer install --no-scripts
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan package:discover
docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm install

Write-Host "Setting up application..."
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan key:generate
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan migrate
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan db:seed
docker-compose -f docker/docker-compose.yml exec socialshare-php-service npm run build
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan config:cache
docker-compose -f docker/docker-compose.yml exec socialshare-php-service php artisan route:cache

Write-Host "Setting permissions..."
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/storage
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/bootstrap/cache
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images

Write-Host "Setup complete! Visit http://localhost:8080"
```

Run it with: `.\setup.ps1` (you may need to run `Set-ExecutionPolicy RemoteSigned` first if you get a permission error)

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

### Images Not Loading

If images are not loading (showing broken image icons), follow these steps:

**Step 1: Create images directory structure**

```bash
# Create the images/articles directory
make shell-root
mkdir -p /var/www/public/images/articles
chown -R www-data:www-data /var/www/public/images
chmod -R 755 /var/www/public/images
exit
```

**Windows:**
```powershell
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service mkdir -p /var/www/public/images/articles
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/public/images
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images
```

**Step 2: Check if image files actually exist**

The database may reference image filenames (like `3600974.webp`), but the actual files might not exist. Check:

```bash
# Check if images exist in public/images/articles/
make shell
ls -la /var/www/public/images/articles/
exit
```

**If the directory is empty**, the images referenced in the database don't exist. You have two options:

**Option A: Use placeholder images (Quick Fix)**

```bash
# Create a placeholder image
make shell
cd /var/www/storage/app/public/images/articles
# Download a sample image or create one
# For now, articles will work but show broken images until real images are uploaded
exit
```

**Option B: Images will work when you upload them through the admin panel**

The admin panel can upload images, which will create the files automatically.

**Step 3: Fix permissions and verify**

```bash
# Ensure permissions are correct
make shell-root
chown -R www-data:www-data /var/www/public/images
chmod -R 755 /var/www/public/images
exit
```

**Windows:**
```powershell
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chown -R www-data:www-data /var/www/public/images
docker-compose -f docker/docker-compose.yml exec -u root socialshare-php-service chmod -R 755 /var/www/public/images
```

**Step 4: Verify it's working**

1. **Check if the directory is accessible:**
   - Visit: http://localhost:8080/images/articles/
   - You should see either a directory listing or a 404 (if empty, that's normal)

2. **Check browser console (F12):**
   - Look for 404 errors on image URLs
   - The URL should be: `http://localhost:8080/images/articles/3600974.webp`
   - If you see 404, the file doesn't exist (which is expected if you haven't uploaded images yet)

3. **Check Laravel logs:**
   ```bash
   make logs
   # or
   docker-compose -f docker/docker-compose.yml logs socialshare-php-service
   ```

**Important Note:** The seeded articles reference image filenames, but the actual image files are not included in the repository. Images will display correctly once you:
- Upload images through the admin panel, OR
- Manually place image files in `laravel/public/images/articles/`

> **Git Note**: Uploaded images in `public/images/articles/` are intentionally excluded from git (see `.gitignore`). This means:
> - `git push` will NOT upload image files (this is correct!)
> - Images are stored directly in `public/images/articles/` - no symlink needed!
> - Uploaded images are local to each environment and won't be synced via git

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
