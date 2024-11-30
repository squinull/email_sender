# Email Management Project

## Requirements

- **PHP**: ^8.0
- **Composer**: ^2.0
- **Laravel**: ^9.x
- **Database**: MySQL/PostgreSQL/SQLite
- **Node.js**: ^16.x
- **SMTP Server**

## Installation

```bash
git clone https://github.com/your-username/email-management.git
cd email-management
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
```

## Configuration

Update the .env file with your environment details:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your_smtp_username
MAIL_PASSWORD=your_smtp_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@example.com

QUEUE_CONNECTION=database
```

## Database Migration

```bash
php artisan migrate
```
