# Canberra Accountants — Deployment Guide

## Requirements

- PHP 8.2+ (8.3 recommended)
- MySQL 8.0+
- Node.js 20+
- Composer 2.x
- Nginx or Apache with `mod_rewrite`

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure `.env`:

```env
APP_NAME="Canberra Accountants"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=canberra_accountants
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_CONTACT_TO=info@canberraaccountants.com.au
QUEUE_CONNECTION=database
```

```bash
php artisan migrate --seed
php artisan storage:link
npm install && npm run build
php artisan serve
```

**Default admin:** `admin@canberraaccountants.com.au` / `ChangeMe123!` — change immediately.

Admin panel: `/admin/login`

## Production Deployment

### 1. Server preparation

```bash
git clone <repository> /var/www/canberra-accountants
cd /var/www/canberra-accountants
composer install --no-dev --optimize-autoloader
npm ci && npm run build
```

### 2. Environment

- Set `APP_ENV=production`, `APP_DEBUG=false`
- Use strong `APP_KEY`
- Configure MySQL credentials
- Set `APP_URL` to production domain

### 3. Laravel optimization

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 4. Queue worker (contact emails)

```bash
php artisan queue:table
php artisan migrate
```

Supervisor example:

```ini
[program:canberra-queue]
command=php /var/www/canberra-accountants/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
```

### 5. Nginx configuration

```nginx
server {
    listen 80;
    server_name www.canberraaccountants.com.au;
    root /var/www/canberra-accountants/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 6. SSL

Use Let's Encrypt (Certbot) for HTTPS. Update `APP_URL` to `https://`.

### 7. Scheduled tasks

```cron
* * * * * cd /var/www/canberra-accountants && php artisan schedule:run >> /dev/null 2>&1
```

### 8. File permissions

```bash
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

## Security Checklist

- [ ] Change default admin password
- [ ] Enable HTTPS
- [ ] Set secure session/cookie settings in production
- [ ] Configure firewall (rate limiting via Laravel throttle)
- [ ] Regular `composer update` security patches
- [ ] Database backups (daily)
- [ ] Restrict `/admin` by IP if required (Nginx `allow/deny`)

## Performance

- Enable OPcache in PHP
- Use Redis for `CACHE_DRIVER` and `SESSION_DRIVER` in production
- CDN for static assets
- `php artisan config:cache` after deploy

## SEO

- Update `public/robots.txt` sitemap URL for production
- Submit sitemap to Google Search Console: `/sitemap.xml`
