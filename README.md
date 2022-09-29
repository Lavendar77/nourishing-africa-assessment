# Nourishing Africa Assessment
A simple CRUD system with user authentication and company management.
![homepage](public/home.png)

## Guide
1. Users can register an account.
2. Users can create up to 3 companies, not more.
3. Users can update their profile and change their passwords.
4. Companies are only unique to the users.
5. Companies are also soft-deleted, that is, users can delete and restore their companies.

## Technical Details
1. Environment: **PHP Version >= 8.0**
2. Backend: **Laravel 9**
3. Frontend: **Inertia.js with Vue 3**
4. Database: **MySQL (default)**. Used **Postgres** on test server.

## Development Setup and Installation
1. Run `composer install`
2. Run `composer run-script post-root-package-install` to create your `.env` file
3. Run `php artisan key:generate` to generate your application key.
4. Run `php artisan migrate --seed`
   1. Countries are seeded into the database by default because they use a public API (restcountries.com).
5. Run `php artisan serve` to start the server.
6. For frontend changes, run `npm run dev`. To deploy, run `npm run build`.
7. For fake data:
   1. Users: `php artisan db:seed --class=UserSeeder`
   2. Companies: `php artisan db:seed --class=CompanySeeder`

## Issues
1. Mailing (not included in assessment requirements).
