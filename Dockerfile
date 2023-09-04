# Use an official PHP image as the base image
FROM php:8.0-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the Laravel application files into the container
COPY . .

# Install Composer dependencies
RUN composer install

# Expose the port that your web server will listen on (default is 9000 for PHP-FPM)
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php-fpm"]
