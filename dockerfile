FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo_mysql

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the application code to the container
COPY . /var/www/html

# Set the Apache document root to /var/www/html/public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/default-ssl.conf

# Enable Apache rewrite module
RUN a2enmod rewrite