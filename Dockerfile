# Use official PHP image with Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Install system dependencies + Node
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    curl \
    libpq-dev \
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

# Install Node dependencies & build assets (Vite + Tailwind)
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Use entrypoint to run migrations + start Apache
ENTRYPOINT ["/entrypoint.sh"]
