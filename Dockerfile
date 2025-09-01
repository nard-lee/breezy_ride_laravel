# Use official PHP image with Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Install system dependencies + Node + build tools
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    curl \
    libpq-dev \
    build-essential \
    && docker-php-ext-install pdo_pgsql mbstring zip exif pcntl gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set Apache DocumentRoot to Laravel public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copy app
COPY . .

# Install Composer PHP dependencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Remove old Vite build (if any) and build frontend assets
RUN rm -rf public/build
RUN npm ci
RUN npm run build

# Set permissions for Laravel (storage/logs writable)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Run migrations & start Apache
ENTRYPOINT ["/entrypoint.sh"]
