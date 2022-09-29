# Nourishing Africa Assessment
A simple CRUD system with user authentication and company management.
![homepage](public/home.png)

## Technical Details
1. Environment: **PHP Version >= 8.0**
2. Backend: **Laravel 9**
3. Frontend: **Inertia.js with Vue 3**

## Development Setup and Installation
1. Run `composer install`
2. Run `composer run-script post-root-package-install` to create your `.env` file
3. Run `php artisan key:generate` to generate your application key.
4. Run `php artisan serve`

## Issues
1. Search works locally, not on production. **Issue is with Inertia.js**
