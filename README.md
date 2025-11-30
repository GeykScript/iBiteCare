# iBiteCare+

A comprehensive web-based clinic management system designed to streamline patient records, appointments, medical transactions, analytics, and administrative workflows for healthcare clinics.

---

## 📋 Requirements

Ensure the following software versions are installed before proceeding:

- **Laravel Installer**: 5.16.0 
- **Composer**: 2.8.5 
- **Node.js**: v22.14.0 
- **PHP**: 8.2.12 
- **MySQL**: 8.0.41

---

## 🗄️ Database Setup

1. Create a Database: `ibitecare`
2. Import the sql file : `ibitecare.sql`
3. Import into MySQL using `phpMyAdmin or MySQL Workbench`

---

## 📦 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/GeykScript/iBiteCare.git
cd iBiteCare
```

### 2. Configure Environment Variables

Create a `.env` file in the root directory with the following configuration:

```env
APP_NAME=Dr.Care-Guinobatan
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ibitecare
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Install PHP Dependencies

```bash
composer install
composer require barryvdh/laravel-dompdf:^3.1
composer require laravel/socialite:^5.2.3
composer require livewire/livewire:^3.6
composer require maatwebsite/excel:^3.1
```

### 4. Install Node.js Packages

**Build System:**
```bash
npm install vite@6.4.1 laravel-vite-plugin@1.3.0
```

**JavaScript Utilities:**
```bash
npm install axios@1.12.2 alpinejs@3.15.0 concurrently@9.2.1
```

**UI Components:**
```bash
npm install flowbite@3.1.2 lucide@0.525.0
```

**Charts:**
```bash
npm install apexcharts@3.54.1
```

**HTML to Image:**
```bash
npm install html2canvas@1.4.1
```

**Philippines Address Selector:**
```bash
npm install select-philippines-address@1.0.6
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Start the Development Server

```bash
php artisan serve
npm run dev
```

---

## 🔐 Login Credentials

### Admin Access

**URL:** `http://127.0.0.1:8000/clinic/login`

```
Account ID: DrCare-2025-0001-0001
Password: Test12345!
```

### Patient Access

**URL:** `http://127.0.0.1:8000/login`

```
Email: johndoe12@gmail.com
Password: user12345
```

---

## 🚀 Getting Started

After completing the installation steps and starting the development server, navigate to the appropriate login URL based on your role (Admin or Patient) and use the provided credentials to access the system.

