# Canberra Accountants

Production-ready corporate website for Canberra Accountants — an Australian accounting and taxation firm.

## Stack

- Laravel 12
- PHP 8.2+
- MySQL
- Tailwind CSS 4
- Alpine.js
- Vite

## Quick Start

```bash
composer install
cp .env.example .env
php artisan key:generate
# Configure MySQL in .env
php artisan migrate --seed
php artisan storage:link
npm install && npm run build
php artisan serve
```

Visit http://localhost:8000

**Admin:** http://localhost:8000/admin/login  
**Credentials:** `admin@canberraaccountants.com.au` / `ChangeMe123!`

### Admin login features

- Secure login with remember me, rate limiting, and session regeneration
- Forgot / reset password (`/admin/forgot-password`)
- Role-based access: Super Admin, Admin, Editor
- Profile & password change (`/admin/profile`)
- User management for Super Admins (`/admin/users`)
- Create users via CLI: `php artisan admin:create-user`

## Documentation

- [DEPLOYMENT.md](DEPLOYMENT.md) — Production deployment guide
- [DATABASE.md](DATABASE.md) — Schema and ERD

## Features

- Public website (Home, About, Services, Team, Insights, Companies, Contact)
- Secure admin dashboard with role-based access
- SEO (meta tags, Open Graph, Twitter Cards, sitemap, schema)
- Contact form with spam protection and queued email notifications
- Full CRUD for articles, team, companies, services, and site settings
