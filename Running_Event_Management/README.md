# Running Event Management System 🏃‍♂️

A Laravel-based web application for managing running events, participants, and leaderboards.

## 📋 Prerequisites

Before running the project, ensure you have the following installed on your system.

### 1. PHP & Composer
Laravel requires PHP and Composer.
- **Download PHP**: [windows.php.net](https://windows.php.net/download/) (VS16 x64 Non Thread Safe is usually fine for Nginx, Thread Safe for Apache).
- **Download Composer**: [getcomposer.org](https://getcomposer.org/download/)
  - Run the installer (`Composer-Setup.exe`).
  - It will ask to point to your `php.exe`.
  - Verify installation by opening a terminal (cmd/powershell) and running:
    ```bash
    composer -v
    ```

### 2. Node.js & NPM
Required for compiling frontend assets (TailwindCSS, etc.).
- **Download Node.js** (LTS version recommended): [nodejs.org](https://nodejs.org/)
- Install it and verify by running:
  ```bash
  node -v
  npm -v
  ```

### 3. Database Server (MySQL/MariaDB)
You need a MySQL-compatible database.
- **XAMPP / Laragon**: Easiest for Windows. Installing [Laragon](https://laragon.org/) will automatically install PHP, Composer, Node.js, and MySQL for you.
- **Standalone MySQL**: [dev.mysql.com](https://dev.mysql.com/downloads/installer/)

---

## 🚀 Setup Guide (Fresh Install)

Follow these steps after unzipping `Running_Event_Management.zip`.

### 1. Prepare the Environment
1. Open a terminal (PowerShell or Command Prompt) in the unzipped project folder.
2. Duplicate the environment file:
   ```bash
   copy .env.example .env
   ```
   *(Or manually copy and paste `.env.example` and rename it to `.env`)*

### 2. Configure Database
1. Create a new, empty database in your MySQL server (e.g., named `db_sistemmanajemenevent_lari`).
2. Open the `.env` file in a text editor (Notepad, VS Code, etc.).
3. specific these lines to match your database settings:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_sistemmanajemenevent_lari
   DB_USERNAME=root
   DB_PASSWORD=      # Enter your database password here (leave empty for default XAMPP/Laragon)
   ```

### 3. Install Dependencies
Run the following commands in your terminal to install the necessary libraries.

**Install PHP Dependencies:**
```bash
composer install
```

**Install JavaScript Dependencies:**
```bash
npm install
```

### 4. Application Initialization
Once dependencies are installed, initialize the app:

1. **Generate Encryption Key**:
   ```bash
   php artisan key:generate
   ```

2. **Setup Database**:
   You can migrate the database structure using Laravel:
   ```bash
   php artisan migrate
   ```
   *Alternatively, if you have the `final_db_export.sql` file, you can import it manually via HeidiSQL or phpMyAdmin.*

3. **Link Storage** (for images):
   ```bash
   php artisan storage:link
   ```

4. **Build Frontend Assets**:
   ```bash
   npm run build
   ```

---

## ▶️ Running the Application

1. **Start the Local Server**:
   ```bash
   php artisan serve
   ```
   
2. **Access the App**:
   Open your browser and navigate to: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 👤 Login Credentials (Default)

**Admin Account**:
- **Email**: `admin@bandungrun.com`
- **Password**: `admin123`

**User Account**:
- **Email**: `user@example.com`
- **Password**: `user123`

---

## 🛠 Troubleshooting
- **Missing Vendor/Node_Modules**: Ensure `composer install` and `npm install` ran without errors.
- **500 Server Error**: Check if `.env` exists and `php artisan key:generate` was run. Check logs in `storage/logs/laravel.log`.
- **Database Connection Refused**: Ensure your MySQL server (XAMPP/Laragon) is running.
