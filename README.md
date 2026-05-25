# Agricultural Machines

This project has two applications:

- `agricultural_machinery` - Laravel 12 backend API and Filament admin dashboard.
- `agricultural_machines_front` - Nuxt frontend storefront.

## Requirements

- PHP 8.2+
- Composer
- Node.js v22^ and npm
- MySQL

## Backend Setup

Go to the backend folder:

```bash
cd agricultural_machinery
```

Install PHP dependencies:

```bash
composer install
```

Create the Laravel environment file:

```bash
cp .env.example .env
```

Generate the app key:

```bash
php artisan key:generate
```

Update `.env` with your local database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agricultural_machinery
DB_USERNAME=root
DB_PASSWORD=
```

For email testing, set your Mailtrap values in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Run migrations and seed the demo data:

```bash
php artisan migrate --seed
```

Create the storage symlink for uploaded/public files:

```bash
php artisan storage:link
```

Start the backend API:

```bash
php artisan serve
```

The backend will usually run at:

```text
http://localhost:8000
```

## Filament Admin Dashboard

Filament is available at:

```text
http://localhost:8000/admin
```

After running the seeders, you can log in with:

```text
Email: test@example.com
Password: password
```

If you want to create another Filament admin user, run:

```bash
php artisan make:filament-user
```

The Filament dashboard includes admin resources for inventory cars, testimonials, team members, and related storefront data.

## Queue Worker

The backend uses the database queue driver:

```env
QUEUE_CONNECTION=database
```

Keep a queue worker running in a separate terminal so queued jobs can process:

```bash
cd agricultural_machinery
php artisan queue:work
```

For local development, you can restart the worker after code changes:

```bash
php artisan queue:restart
```

## Backend Useful Commands
Format PHP code:

```bash
./vendor/bin/pint
```

Clear caches:

```bash
php artisan optimize:clear
```

## Frontend Setup

Open a new terminal and go to the frontend folder:

```bash
cd agricultural_machines_front
```

Install Node dependencies:

```bash
npm install
```

Create a frontend environment file if you need to override the API URL. If a frontend `.env.example` file exists, copy it:

```bash
cp .env.example .env
```

Otherwise, create `.env` manually:

```env
NUXT_PUBLIC_API_BASE=http://localhost:8000/api
```

Start the Nuxt development server:

```bash
npm run dev
```

The frontend will usually run at:

```text
http://localhost:3000
```

If Nuxt chooses another port, use the URL shown in the terminal.

## Frontend Useful Commands

Build for production:

```bash
npm run build
```

Preview the production build:

```bash
npm run preview
```

Generate a static build:

```bash
npm run generate
```

## Recommended Local Development Terminals

Use separate terminals:

1. Backend API:

```bash
cd agricultural_machinery
php artisan serve
```

2. Queue worker:

```bash
cd agricultural_machinery
php artisan queue:work
```

3. Frontend:

```bash
cd agricultural_machines_front
npm run dev
```

Then open the frontend URL in the browser and use `http://localhost:8000/admin` for the Filament admin dashboard.
