# Use the official PHP Alpine image for smaller size
FROM php:8.2-alpine

# Install PostgreSQL extension and required dependencies
RUN apk add --no-cache postgresql-dev postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

# Create a directory for our app
WORKDIR /app

# Copy all files to our app directory
COPY . /app/

# Expose port 8000 for the PHP development server
EXPOSE 8000

# Start the PHP development server
# This is like running: php -S localhost:8000
CMD ["php", "-S", "0.0.0.0:8000"] 

