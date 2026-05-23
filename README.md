# Invoice Portal

A SaaS-based Invoice Management System built with Laravel. Allows business owners to create and send professional invoices to clients, track payments, and manage subscriptions.

## 🔴 Live Demo
[https://web-production-15ad2e.up.railway.app](https://web-production-15ad2e.up.railway.app)

**Demo credentials:**
- Email: nehal@test.com
- Password: password123

## ✨ Features

- **Authentication** — Register, login, password reset
- **Client Management** — Add, edit, delete clients
- **Invoice CRUD** — Create invoices with multiple line items
- **PDF Generation** — Download professional invoice PDFs
- **Dashboard** — Total invoices, clients, revenue, pending stats
- **Status Tracking** — Draft, Unpaid, Paid, Overdue
- **Multi-tenancy** — Each user sees only their own data

## 🛠 Tech Stack

- **Backend:** Laravel 11, PHP 8.3
- **Frontend:** Blade Templates, Tailwind CSS
- **Database:** MySQL
- **PDF:** barryvdh/laravel-dompdf
- **Auth:** Laravel Breeze
- **Deploy:** Railway.app

## 📦 Installation

```bash
git clone https://github.com/nehaal-dev/invoice_portal.git
cd invoice_portal
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## 📸 Screenshots
## 📸 Screenshots

### Dashboard
![Dashboard](screenshots/dashboard.png)

### Invoices
![Invoices](screenshots/invoices.png)

Dashboard, Clients, Invoices — clean Tailwind UI

## 👨‍💻 Author

Nehal Khan — Full Stack PHP Laravel Developer