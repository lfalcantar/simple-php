# Use the official PHP image
FROM php:8.2-alpine

# Create a directory for our app
WORKDIR /app

# Copy all files to our app directory
COPY . /app/

# Expose port 8000 for the PHP development server saying container listens on port 8000 internally."
# But by itself, it doesn't open or forward the port to your host machine.
EXPOSE 8081

# Start the PHP development server
# This is like running: php -S localhost:8000
CMD ["php", "-S", "0.0.0.0:8081"] 

