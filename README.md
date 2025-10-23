# Project Title

A brief description of what this project does and who it's for

# iBiteCare+: Web-Based Clinic Management System

## Requirements

-   **Laravel Installer**: 5.16.0
-   **Composer**: 2.8.5
-   **Node.js**: v22.14.0
-   **PHP**: 8.2.12
-   **MySQL**: 8.0.41

---

## Database Setup

1. Locate the SQL file: `ibitecare.sql`
2. Open it with a code editor, copy the contents, and import it into your MySQL database using phpMyAdmin or the MySQL CLI.

---

## Project Setup

1. **Clone the repository**:

    ```bash
    git clone https://github.com/GeykScript/iBiteCare.git
    cd iBiteCare

    ```

2. **Create your .env file and update the database configuration:**

    ```bash
    APP_NAME=Dr.Care-Guinobatan
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ibitecare
    DB_USERNAME=root
    DB_PASSWORD=

    ```

3. **Generate the application key:**
    ```bash
    php artisan key:generate
    ```
4. **Run the development server and frontend compiler:**
    ```bash
    php artisan serve
    npm run dev
    ```

**Visit the following URL to access the admin login page:**

```bash
 http://127.0.0.1:8000/clinic/login

Ex.DrCare-2025-0001-0001
Pass: jakemorales
```
**Visit the following URL to access the Patient login page:**

```bash
 http://127.0.0.1:8000/login
johndoe12@gmail.com
user12345
```
