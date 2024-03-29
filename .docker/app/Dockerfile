# php stable debian image
FROM php:fpm-bullseye

WORKDIR /var/www/

# Install dependencies for the operating system software
# libmpdec-dev was installed to be used with php-decimal pecl package
RUN apt-get update && apt-get install -y \
    build-essential \
    libmpdec-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    curl \
    cron

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions for php
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# cache and queue persistent layer vendor libs
RUN pecl install redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis
# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application backend directory contents to the working directory (working_dir)
#COPY ./backend /var/www
#COPY .docker/app/config/cron/jc /etc/cron.d/jc
# Assign permissions of the working directory to the www-data user
RUN chown -R www-data:www-data /var/www

# Expose port 9000 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 9000
