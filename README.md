# Virtual Lab Management System

A Laravel application with user authentication, role-based access control, and virtual laboratory features. This application is deployed and accessible online.

## 🌐 Live Application

**Access the application at:** [Your Railway URL]
<!-- Replace with your actual deployment URL -->

## Features

- 🏠 **Home Dashboard** - Main landing page after login
- 👥 **User Management** - Create, read, update, and delete users
- 🔐 **Role Management** - Manage user roles and permissions
- 🔑 **Authentication** - Secure login/logout system
- ✅ **Permission System** - Role-based access control using Spatie
- 🧪 **Virtual Lab** - Interactive physics and chemistry laboratory simulations

## Deployment

This application is deployed on Railway with the following stack:
- **Platform:** Railway
- **Server:** FrankenPHP
- **Database:** PostgreSQL
- **Asset Compilation:** Vite (production build)

### Environment Configuration

The production environment uses:
- `APP_ENV=production`
- `APP_DEBUG=false`
- PostgreSQL database (Railway managed)
- Production-optimized asset compilation

## Local Development Setup

If you want to run this project locally:

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Configure Environment

```bash
cp .env.example .env
```

Update database credentials and generate application key:
```bash
php artisan key:generate
```

### 3. Setup Database

```bash
php artisan migrate:fresh --seed
```

### 4. Run the Application

```bash
npm run dev
php artisan serve
```

Access at: `http://localhost:8000`

## User Accounts

The system includes pre-configured user accounts:

**Admin User:**
- Email: `admin@houshou.com`
- Password: `password`
- Role: Admin (Full Access)

**Teacher User:**
- Email: `teacher@houshou.com`
- Password: `password`
- Role: Teacher

**Student User:**
- Email: `student@houshou.com`
- Password: `password`
- Role: Student

⚠️ **Note:** These are default credentials created by the database seeder.

## Application Routes

- `/` - Homepage (redirects to /home or /login)
- `/login` - Login page
- `/logout` - Logout
- `/home` - Dashboard (requires authentication)
- `/user` - User management (requires admin role)
- `/role` - Role management (requires admin role)
- `/role/{id}` - Role details (requires admin role)
- `/virtual-lab` - Virtual laboratory interface

## Tech Stack

- **Framework:** Laravel 11
- **Frontend:** Livewire 3, TailwindCSS, Alpine.js
- **Database:** PostgreSQL
- **Authentication:** Laravel Breeze
- **Permissions:** Spatie Laravel Permission
- **UI Components:** Mary UI
- **Charts:** Larapex Charts
- **Deployment:** Railway + FrankenPHP
- **Build Tool:** Vite

## Project Structure

```
app/
├── Http/Controllers/     # HTTP controllers
├── Livewire/            # Livewire components
│   ├── VirtualLab/      # Virtual lab features
│   ├── Users/           # User management
│   └── Roles/           # Role management
├── Models/              # Eloquent models
└── Services/            # Business logic services

resources/
├── views/livewire/      # Livewire blade templates
└── js/                  # Frontend JavaScript

routes/
└── web.php             # Web routes
```

## For Developers

### Useful Artisan Commands

Clear application caches:
```bash
php artisan route:clear
php artisan view:clear
php artisan config:clear
php artisan cache:clear
```

Create new components:
```bash
php artisan make:livewire YourComponent
php artisan make:migration create_your_table
php artisan make:model YourModel -m
```

## Academic Project

This is a project for the Web and Mobile Application Development course (Semester 5).

## License

This project is open-sourced software licensed under the MIT license.

