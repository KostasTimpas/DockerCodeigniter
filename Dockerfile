# Use the official PHP-Apache image as the base
FROM php:8.2-apache

# Install system dependencies and PHP extensions required by CodeIgniter 4
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite for CodeIgniter's URL routing
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i 's|<Directory /var/www/html/>|<Directory /var/www/html/public/>\\n    AllowOverride All|g' /etc/apache2/apache2.conf

# Copy the CodeIgniter application to the Apache web root
COPY . /var/www/html

# Set proper permissions for the web server
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/writable \
    && chmod -R 755 /var/www/html/public

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install CodeIgniter dependencies
WORKDIR /var/www/html
RUN composer install

# Copy custom php.ini
COPY php.ini /usr/local/etc/php/

# Expose port 80 for Apache
EXPOSE 80

# Set Apache DocumentRoot to /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Start Apache in the foreground
CMD ["apache2-foreground"]
