# Use official PHP 8.3 image with Apache
FROM php:8.3-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Set Apache to serve Laravel's public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update Apache config to use the new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/sites-available/default-ssl.conf

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory to Laravel root
WORKDIR /var/www/html

# Copy the Laravel project into the image
COPY . .

# Fix permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

            # Install PHP dependencies using Composer
            RUN composer install --no-dev --optimize-autoloader

            # Clear and cache Laravel configuration and routes
            RUN php artisan config:clear && \
                php artisan route:clear && \
                php artisan view:clear && \
                php artisan config:cache

# Expose port 80 for Apache
EXPOSE 80



