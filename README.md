# CMS Sederhana

A simple Content Management System built with PHP and AdminLTE.

## Features

- User Authentication
- Post Management (CRUD)
- Category Management
- User Management
- Modern UI with AdminLTE
- Responsive Design

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web Server (Apache/Nginx)
- Composer (for dependencies)

## Installation

1. Clone this repository to your web server directory:
```bash
git clone https://github.com/yourusername/cms_sederhana.git
```

2. Create a MySQL database and import the database structure:
```bash
mysql -u root -p < database.sql
```

3. Configure the database connection in `config/database.php`:
```php
$host = 'localhost';
$dbname = 'cms_sederhana';
$username = 'your_username';
$password = 'your_password';
```

4. Make sure your web server has write permissions to the following directories:
- `uploads/`
- `cache/`

5. Access the CMS through your web browser:
```
http://localhost/cms_sederhana
```

## Default Login

- Username: admin
- Password: admin123

## Security

For production use, please make sure to:
1. Change the default admin password
2. Use HTTPS
3. Set proper file permissions
4. Keep PHP and all dependencies updated

## License

This project is licensed under the MIT License. 