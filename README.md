# Application Name

A clean Laravel application with user authentication and role-based access control.

## Features

- 🏠 **Home Dashboard** - Main landing page after login
- 👥 **User Management** - Create, read, update, and delete users
- 🔐 **Role Management** - Manage user roles and permissions
- 🔑 **Authentication** - Secure login/logout system
- ✅ **Permission System** - Role-based access control using Spatie

## Setup Instructions

### 1. Install Dependencies

Install PHP dependencies:
```bash
composer install
```

Install Node dependencies:
```bash
npm install
```

### 2. Configure Environment

Copy `.env.example` to `.env` and configure your database:
```bash
cp .env.example .env
```

Update database credentials in `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Generate application key:
```bash
php artisan key:generate
```

### 3. Setup Database

Run migrations and seeders:
```bash
php artisan migrate:fresh --seed
```

This will create:
- All necessary database tables
- 3 default users (Admin, Employee, Stakeholder)
- Default roles and permissions

### 4. Run the Application

Start the Vite development server:
```bash
npm run dev
```

Start the PHP development server:
```bash
php artisan serve
```

Access the application at: `http://localhost:8000`

## Default Login Credentials

**Admin User:**
- Email: `admin@houshou.com`
- Password: `password`
- Role: Admin (Full Access)

**Employee User:**
- Email: `teacher@houshou.com`
- Password: `password`
- Role: Teacher (Full Access, future tbc)

**Stakeholder User:**
- Email: `student@houshou.com`
- Password: `password`
- Role: Student (Full Access, future tbc)

⚠️ **Change these credentials in production!**

## Available Routes

- `/` - Homepage (redirects to /home or /login)
- `/login` - Login page
- `/logout` - Logout
- `/home` - Dashboard (requires authentication)
- `/user` - User management (requires authentication)
- `/role` - Role management (requires authentication)
- `/role/{id}` - Role details (requires authentication)

## Documentation

- **DATABASE_RESET_GUIDE.md** - How to reset and configure database
- **LOGIN_CREDENTIALS.md** - Detailed user management guide
- **CLEANUP_SUMMARY.md** - Summary of removed asset-related features

## Tech Stack

- **Framework:** Laravel 11
- **Frontend:** Livewire 3, TailwindCSS
- **Database:** PostgreSQL (or MySQL)
- **Authentication:** Laravel Breeze
- **Permissions:** Spatie Laravel Permission
- **UI Components:** Mary UI

## Development

### Clear Caches

```bash
php artisan route:clear
php artisan view:clear
php artisan config:clear
php artisan cache:clear
```

### Create New Components

Create a new Livewire component:
```bash
php artisan make:livewire YourComponent
```

Create a new migration:
```bash
php artisan make:migration create_your_table
```

Create a new model:
```bash
php artisan make:model YourModel -m
```

## License

This project is open-sourced software licensed under the MIT license.

