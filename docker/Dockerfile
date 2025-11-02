# ===========================
# Stage 1: Build Laravel assets (Node)
# ===========================
FROM node:lts-alpine AS builder
WORKDIR /var/www

# Copy package files first for better caching
COPY laravel/package*.json ./

# Install dependencies
RUN npm install --frozen-lockfile

# Copy Laravel application files (but preserve node_modules from install)
# Copy files selectively to avoid overwriting node_modules
# Essential files for Vite build
COPY laravel/vite.config.js ./
COPY laravel/resources ./resources
COPY laravel/public ./public
# Config directory (might be needed for Laravel Vite plugin)
COPY laravel/config ./config

# Verify vite.config.js and node_modules exist
RUN ls -la vite.config.js && ls -la node_modules/.bin/vite || (echo "ERROR: vite not found!" && exit 1)

# Ensure build output directory exists
RUN mkdir -p public/build

# Build assets
RUN npm run build


# ===========================
# Stage 2: PHP-FPM
# ===========================
FROM php:8.3-fpm-alpine AS php
WORKDIR /var/www

# Set timezone
ENV TZ=UTC

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    nano \
    tzdata \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code with ownership
COPY --chown=www-data:www-data laravel/ /var/www

# Install Laravel dependencies (dev dependencies included for development)
# Use --no-scripts during build since artisan may not be fully set up
# Scripts will run automatically when container starts with volumes mounted
RUN composer install --optimize-autoloader --no-interaction --no-scripts

# Note: Assets will be built in the builder stage or mounted via volumes
# NPM dependencies are installed but assets are built separately

# Create public images directory (no symlink needed - images stored directly in public)
RUN mkdir -p /var/www/public/images/articles \
    && chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache \
    && chmod -R 755 /var/www/public/images

# Expose port 9000 for PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]


# ===========================
# Stage 3: Nginx
# ===========================
FROM nginx:alpine-slim AS nginx
WORKDIR /var/www

# Set timezone
ENV TZ=UTC
RUN apk add --no-cache tzdata \
    && cp /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone \
    && apk del tzdata

# Copy Nginx config
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy built assets from builder stage (Vite outputs to public/build)
COPY --from=builder /var/www/public/build /var/www/public/build

# Copy Laravel public directory
COPY laravel/public /var/www/public

# Fix ownership
RUN chown -R nginx:nginx /var/www/public

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
