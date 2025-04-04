# AI Coding Assistant Guide

A modern PHP web application that provides information about using AI for coding and development.

## Features

- Clean, modern UI with responsive design
- Information about AI coding assistants
- Best practices and guidelines
- Interactive card-based layout
- Mobile-friendly design

## Requirements

- PHP 7.4 or higher
- A web server (Apache, Nginx, etc.)
- OR Docker (for containerized deployment)

## Setup Options

### Option 1: Traditional Setup
1. Clone this repository to your local machine
2. Place the files in your web server's document root
3. Start your web server
4. Access the application through your web browser

### Option 2: Using PHP's Built-in Server
You can quickly test the application using PHP's built-in development server:

```bash
php -S localhost:8000
```

Then open your browser and navigate to `http://localhost:8000`

### Option 3: Using Docker (Simplified)
1. Make sure you have Docker installed on your system
2. Build the Docker image:
   ```bash
   docker build -t php-simple-server .
   ```
3. Run the container:
   ```bash
   docker run -p 8000:8000 php-simple-server
   ```
4. Open your browser and visit `http://localhost:8000`

#### How it works:
- The container uses PHP's built-in development server (just like running `php -S localhost:8000`)
- All files are copied to the `/app` directory inside the container
- Port 8000 inside the container is mapped to port 8000 on your computer

## Technologies Used

- PHP
- HTML5
- CSS3
- Font Awesome Icons
- Docker (optional)

## php:8.2
This project is open source and available under the MIT License. 

A full Debian OS

PHP and all the tools you might need

Extra libraries, even if you don't use them

what if we change to php:8.2-alpine