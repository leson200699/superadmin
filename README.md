# SuperAdmin

Super Admin Panel for managing multiple projects and websites.

## Features

- Role-based access control system
- Multi-project management
- User authentication and authorization
- Dashboard analytics
- File management
- System configuration

## Installation

1. Clone the repository
2. Configure your database settings in `app/Config/Database.php`
3. Set up your environment variables in `.env` file
4. Run database migrations
5. Configure web server (Apache/Nginx)

## Configuration

### Database Setup
Update the database configuration in `app/Config/Database.php`

### Environment Variables
Copy `.env.example` to `.env` and configure:
- Database credentials
- Base URL
- Encryption key
- Other environment-specific settings

## Usage

### Role System Setup
Run the role system setup script:
```bash
bash setup_role_system.sh
```

### Upload to Server
Use the upload script for deployment:
```bash
bash upload.sh
```

## Project Structure

- `app/` - Application code
- `public/` - Web root directory
- `writable/` - Writable directories for cache, logs, uploads
- `system/` - CodeIgniter system files
- `tests/` - Test files

## Requirements

- PHP 7.4 or higher
- MySQL/MariaDB
- Web server (Apache/Nginx)
- Composer

## License

This project is proprietary software.
