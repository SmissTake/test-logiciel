FROM php:8.1-apache-bullseye

RUN apt-get update && apt-get install -y \
  sudo


RUN curl -LsS https://r.mariadb.com/downloads/mariadb_repo_setup | sudo bash

RUN apt-get install -y \
  git \
  zip \
  unzip \
  mariadb-client \
  libzip-dev \
  libpng-dev \
  mariadb-server



# launch mariadb with service
# RUN service mariadb start

# Install required PHP extensions
RUN docker-php-ext-install pdo_mysql

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the application code to the container
COPY . /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction

# Create database
# RUN php bin/console doctrine:database:create


# Create migrations
# RUN php bin/console make:migration

# Run migrations
# RUN php bin/console doctrine:migrations:migrate --no-interaction

# Create fixtures
# RUN php bin/console doctrine:fixtures:load

# Set the Apache document root to /var/www/html/public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/default-ssl.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose port 80 and start Apache
EXPOSE 80