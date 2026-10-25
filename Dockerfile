# Use an official lightweight PHP image with Apache (or Nginx)
FROM php:8.2-apache

# Install system dependencies and MySQL extension
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mysqli gd

# Enable Apache mod_rewrite for clean URLs / routing if needed
RUN a2enmod rewrite

# Copy your website source code into the container's web root
COPY . /var/apache/html/ 
# Note: standard apache doc root is /var/www/html, let's use that:
COPY . /var/www/html/

# Expose port 80 for web traffic
EXPOSE 80
