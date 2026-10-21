# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite for custom URLs/routing if needed
RUN a2enmod rewrite

# Install required PHP extensions (mysqli & pdo_mysql for MySQL database connection)
RUN docker-php-ext-install mysqli pdo_mysql

# Copy all project files to Apache's public root folder
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80
