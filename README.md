# AI Coding Assistant Guide

A modern PHP web application that provides information about using AI for coding and development.

## Features

- Clean, modern UI with responsive design
- Information about AI coding assistants
- Best practices and guidelines
- Interactive card-based layout
- Mobile-friendly design
- Automatic logging of visitor information to PostgreSQL database
- Admin page to view access logs

## Requirements

- PHP 7.4 or higher
- PostgreSQL (optional, if using Docker)
- Docker and Docker Compose (optional)

## Setup Options

### Option 1: Using Docker Compose (Recommended)
1. Make sure you have Docker and Docker Compose installed
2. Run the following command:
   ```bash
   docker-compose up --build
   docker-compose down -v
   docker-compose down
   docker-compose exec db psql -U postgres -d ai_guide -c "SELECT * FROM page_access;"
   ```
3. The application will be available at `http://localhost:8000`
4. The admin page will be available at `http://localhost:8000/admin.php`
5. The database will be available at `localhost:5432`

### Option 2: Using PHP's Built-in Server
You can quickly test the application using PHP's built-in development server:

```bash
php -S localhost:8000
```

Then open your browser and navigate to:
- Main application: `http://localhost:8000`
- Admin page: `http://localhost:8000/admin.php`

#### Database Setup (for local development)
1. Install PostgreSQL
2. Create a database named `ai_guide`
3. Run the SQL commands in `config/schema.sql`
4. Update the database credentials in `config/database.php`

## Pages

### Main Page (`index.php`)
- Displays information about AI coding
- Automatically logs visitor information
- Modern, responsive design

### Admin Page (`admin.php`)
- View all access logs in a table format
- Shows detailed information about each visit:
  - IP Address
  - User Agent
  - Page URL
  - Access Time
  - Referrer
  - Browser Language
  - Screen Resolution
- No password required (for educational purposes)

## Database Schema

The application logs the following information for each page access:
- IP Address
- User Agent (browser information)
- Page URL
- Access Time
- Referrer
- Browser Language
- Screen Resolution

## Technologies Used

- PHP
- PostgreSQL
- HTML5
- CSS3
- Font Awesome Icons
- Docker
- Docker Compose

## License

This project is open source and available under the MIT License.

A full Debian OS

PHP and all the tools you might need

Extra libraries, even if you don't use them

what if we change to php:8.2-alpine