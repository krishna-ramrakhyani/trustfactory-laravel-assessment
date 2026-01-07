# Trustfactory Assessment - Simple E-commerce Shopping Cart

A full-stack e-commerce application built with **Laravel** and **Livewire**, designed to demonstrate backend logic, asynchronous queue processing, and task scheduling.

## 🚀 Project Overview

This project satisfies the technical assessment requirements for the **Trustfactory Laravel Developer** role. [cite_start]It implements a persistent shopping cart system where user actions are stored directly in the database rather than the session[cite: 19].

### Key Features implemented:

* **🛒 Persistent Shopping Cart:**
    * Cart is associated with the authenticated `User` model[cite: 18].
    * Uses Database Transactions to ensure stock accuracy during add/remove operations.
    * Prevents adding items if stock is insufficient.

* **📉 Low Stock Notification (Queue/Job):**
    * Automatically dispatches a background job (`LowStockJob`) when a product's stock drops to 5 or below.
    * Sends an email alert to a dummy admin user[cite: 28].

* **📊 Daily Sales Report (Task Scheduling):**
    * A scheduled task (`DailySalesReportJob`) runs every evening at **23:00**.
    * Compiles a list of products sold that day and emails a report to the admin[cite: 29].

## 🛠️ Tech Stack
* **Framework:** Laravel 11
* **Frontend:** Livewire + Tailwind CSS
* **Database:** MySQL
* **Queue Driver:** Database

---

## ⚙️ Installation & Setup

Follow these steps to get the project running locally.

### 1. Clone & Install
```bash
git clone <repository_url>
cd <repository_folder>

composer install
npm install && npm run build

```

### 2. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate

```

Update your `.env` file with your database credentials.

**Crucial:** To see email logs locally without setting up an SMTP server, set the mailer to `log`:

```env
MAIL_MAILER=log
QUEUE_CONNECTION=database

```

### 3. Database Migration

```bash
php artisan migrate

```

*Tip: You may want to seed some dummy products manually or via tinker to test the cart.*

### 4. Serve the Application

```bash
php artisan serve

```

---

## 🧪 How to Test Background Jobs

Since this project relies on Queues and Scheduling, you must run the following commands in separate terminal windows to see the features in action.

### 1. Run the Queue Worker

Required for **Low Stock Alerts** and sending emails.

```bash
php artisan queue:work

```

### 2. Test the Daily Report Schedule

Instead of waiting for 23:00, you can force the schedule to run immediately:

```bash
php artisan schedule:test

```

Check your `storage/logs/laravel.log` (or your configured mail trap) to see the "Daily Sales Report" email HTML.
