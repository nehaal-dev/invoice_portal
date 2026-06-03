# 🧾 Invoice Portal

A SaaS-based Invoice Management System built with Laravel 11. Business owners can manage clients, create professional invoices, accept online payments via Stripe, send email notifications, and provide clients with a dedicated portal.

## 🔴 Live Demo
**[https://web-production-15ad2e.up.railway.app](https://web-production-15ad2e.up.railway.app)**

> ⚠️ Demo credentials — please do not change password:
> -  User Email: `nehalkhan4639@gmail.com`
> -  Password: `Khan4639`

---

## ✨ Features

- **Authentication** — Register, Login, Logout (Laravel Breeze)
- **Client Management** — Add, edit, delete clients with portal access
- **Invoice CRUD** — Create invoices with multiple dynamic line items
- **Auto Invoice Number** — INV-001, INV-002 auto-generated
- **Tax & Discount** — Tax (%) and Discount (₹) calculation
- **PDF Generation** — Download professional invoice PDFs
- **Stripe Payment** — Online payment via Stripe (test mode)
- **Email Notifications** — Invoice email with PDF attachment (Gmail SMTP)
- **Dashboard** — Total invoices, clients, revenue, pending stats
- **Status Tracking** — Draft, Unpaid, Paid, Overdue with color badges
- **Search & Filter** — Search by invoice number, client, status
- **REST API** — Sanctum Bearer token authentication
- **Subscription Plans** — Free (5 invoices/month) / Pro (unlimited)
- **Client Portal** — Clients login and view their own invoices
- **Multi-tenancy** — Each owner sees only their own data
- **Responsive Design** — Mobile and desktop friendly

---

## 🛠 Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 11, PHP 8.3 |
| Frontend | Blade Templates, Tailwind CSS |
| Database | MySQL |
| Authentication | Laravel Breeze + Sanctum |
| PDF | barryvdh/laravel-dompdf |
| Payment | Stripe (Test Mode) |
| Email | Gmail SMTP |
| Deployment | Railway.app |

---

## 📸 Screenshots

### Dashboard
 
<img width="2940" height="1912" alt="image" src="https://github.com/user-attachments/assets/1e14dc70-1ea6-4121-ac1b-815d5a99b4dd" />

### Client Portal Dashboard
Client Loged in 
<img width="2940" height="1912" alt="image" src="https://github.com/user-attachments/assets/c5aab744-d30b-4d89-b9d0-d8eddc5157a7" />




### Invoice List (with Search & Filter)
 
<img width="1442" height="724" alt="Screenshot 2026-06-03 at 4 07 44 PM" src="https://github.com/user-attachments/assets/e093cf6a-1930-4625-bf0b-4ab8f7f23c20" />


### Invoice Detail
 
<img width="2940" height="1912" alt="image" src="https://github.com/user-attachments/assets/c29becf1-e6a8-4aee-9a42-e9c71d5c69d8" />
<img width="2940" height="1912" alt="image" src="https://github.com/user-attachments/assets/7b693db8-9c3d-40f3-b1d0-a25d6585ffc1" />



### PDF Invoice
 
<img width="2940" height="1912" alt="image" src="https://github.com/user-attachments/assets/b07498c6-af96-49e4-a3ee-efdf0ed7d104" />
<img width="2940" height="1912" alt="image" src="https://github.com/user-attachments/assets/9582a2fa-34b7-4eb8-a043-6156cbe245dc" />



### Stripe Payment
![Payment](screenshots/payment.png)


---

## 🔌 REST API Endpoints

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | /api/login | Get Bearer token | No |
| GET | /api/invoices | Get all invoices | Bearer |
| GET | /api/invoices/{id} | Get single invoice | Bearer |
| POST | /api/invoices | Create invoice | Bearer |
| GET | /api/clients | Get all clients | Bearer |
| POST | /api/clients | Create client | Bearer |

---

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

### Environment Variables Required
```env
APP_KEY=
DB_CONNECTION=mysql
DB_DATABASE=invoice_portal
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your_app_password
```

---

## 👨‍💻 Author

**Nehal Khan** — Full Stack PHP Laravel Developer

- GitHub: [@nehaal-dev](https://github.com/nehaal-dev)
- Live Project: [Invoice Portal](https://web-production-15ad2e.up.railway.app)
