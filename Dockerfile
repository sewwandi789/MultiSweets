# PHP + Apache Image
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite (if needed for your app)
RUN a2enmod rewrite

# Copy project files to the container
COPY . /var/www/html

# Set permissions for the web server
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for Apache
EXPOSE 80

# CMD to start Apache server
CMD ["apache2-foreground"]
