#!/usr/bin/env bash
# Exit on error
set -o errexit

# Install PHP dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Copy environment file
if [ ! -f .env ]; then
  cp .env.render .env
fi

# Generate application key
php artisan key:generate --ansi

# Run database migrations
php artisan migrate --force --no-interaction

# Clear caches
php artisan config:cache
php artisan route:cache
php artisan view:cache