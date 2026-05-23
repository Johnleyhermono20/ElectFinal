# 📋 Task Management System

A Laravel-based task management application for organizing and tracking daily tasks with categories and due dates.

## Features

- ✅ Create, read, update, and delete tasks
- 🏷️ Categorize tasks (Work, Personal, Study, Health, Shopping)
- 📅 Set due dates for tasks
- ✔️ Mark tasks as completed
- 📊 View pending and completed tasks

## Requirements

- PHP 8.2 or higher
- Composer
- SQLite (included with PHP)

## Installation & Setup

1. **Extract the project folder**

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Create environment configuration**
   ```bash
   cp .env.example .env
   ```
   Or create `.env` file with:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=task_manager_db
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Run database migrations and seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   Open your browser and navigate to: `http://127.0.0.1:8000`

## Project Structure

- `/app/Http/Controllers/` - Application controllers
- `/app/Models/` - Database models (Task, Category, User)
- `/database/migrations/` - Database schema
- `/database/seeders/` - Database seed data
- `/resources/views/` - Blade templates
- `/routes/web.php` - Web routes

## Database Models

- **User** - User accounts
- **Task** - Tasks with title, description, due date, and completion status
- **Category** - Task categories (Work, Personal, Study, Health, Shopping)

## Notes

- The `.gitignore` file excludes large folders like `vendor/` and `node_modules/`
- Database is stored as SQLite in `task_manager_db`
- All dependencies can be reinstalled with `composer install`

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
