# Abed Karakira — Portfolio

Personal portfolio built with Laravel 12 (PHP 8.2+), Tailwind and Alpine. Public pages for projects, about, certificates, blog and contact, plus an admin panel to manage all content, uploads (project images, certificates, CV, profile photo, OG image) and contact messages.

## Local development

```bash
composer setup                 # install deps, create .env, generate key, migrate, build assets
php artisan db:seed            # creates the site settings row
php artisan app:create-admin   # create your admin login
composer dev                   # serve + vite + logs
```

Optional demo data: `php artisan db:seed --class=ProjectSeeder` (skipped automatically in production).

Run the tests with `composer test`.

## Deploying to shared hosting (SSH)

### 1. Layout: keep the app outside the web root

Upload the project to a folder **outside** `public_html`, for example `~/portfolio`, and make the web root serve `~/portfolio/public`:

```bash
# Hostinger-style: replace public_html with a link to the app's public folder
mv ~/public_html ~/public_html.bak
ln -s ~/portfolio/public ~/public_html
```

Never upload the whole project into `public_html`: that makes `.env`, `database/database.sqlite` and `storage/logs` downloadable.

### 2. Production `.env`

Copy `.env.example` to `.env` and set at least:

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
LOG_LEVEL=error
SESSION_SECURE_COOKIE=true

MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_PORT=465
MAIL_SCHEME=smtps
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_FROM_ADDRESS=...
CONTACT_RECEIVER_EMAIL=you@your-domain.com
```

### 3. Install and build

```bash
composer install --no-dev --optimize-autoloader
npm ci && npm run build        # or build locally and upload public/build if the host has no Node
php artisan key:generate       # first deploy only
touch database/database.sqlite # first deploy only, when using SQLite
php artisan migrate --force
php artisan db:seed --force    # only creates the site settings row; safe to re-run
php artisan app:create-admin   # first deploy only
php artisan storage:link
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

If the host blocks symlinks and `storage:link` fails, uploaded images won't load. Ask the host to allow symlinks, or point the `public` disk's `root` at `public_html/storage`.

### 4. Check after each deploy

- `https://your-domain.com/.env` returns 404.
- The contact form delivers a real email to `CONTACT_RECEIVER_EMAIL`, and replying goes to the visitor.
- An uploaded image and the CV link load.
- `/robots.txt` shows your domain in the `Sitemap:` line.
- `composer audit` reports no advisories.

### Updating

```bash
git pull
composer install --no-dev --optimize-autoloader
npm ci && npm run build
php artisan migrate --force
php artisan optimize:clear && php artisan config:cache && php artisan route:cache && php artisan view:cache
```
