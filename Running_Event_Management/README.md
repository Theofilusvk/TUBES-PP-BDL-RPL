# Running Event Management System 🏃‍♂️

A Laravel-based web application for managing running events, participants, and leaderboards.

## 📋 Prerequisites
- **Laragon** (Recommended for Windows) - Includes PHP, MySQL, Composer, and Node.js.
- **Git** (Optional, for version control).

---

## 🚀 Setup Guide (From Scratch)

### 1. Install & Configure Laragon
1. Download **Laragon Full** from [laragon.org](https://laragon.org/download/).
2. Install and launch Laragon.
3. Click **Start All** to start the Web Server (Apache/Nginx) and Database (MySQL).
4. Ensure you have the following reachable in your terminal (Laragon usually adds them to PATH):
   - `php -v`
   - `composer -v`
   - `npm -v`
   - `mysql --version`

### 2. Prepare the Project
1. Copy the project folder `Running_Event_Management` to your desired location (e.g., `C:\laragon\www\Running_Event_Management`).
2. Open a terminal inside this folder.

### 3. Database Setup
1. Open **Laragon Database Manager** (HeidiSQL) or use the terminal.
2. Create a new empty database named `db_sistemmanajemenevent_lari`.
3. **Import the SQL Script**:
   - We have provided a full database export file: `final_db_export.sql` (located in the project root).
   - In terminal:
     ```bash
     mysql -u root db_sistemmanajemenevent_lari < final_db_export.sql
     ```
   - *Alternatively in HeidiSQL*: File > Load SQL file > Select `final_db_export.sql` > Run.

### 4. Application Configuration
1. **Environment File**:
   Duplicate `.env.example` and rename it to `.env`.
   ```bash
   cp .env.example .env
   ```
2. **Edit `.env`**:
   Open `.env` and configure your database connection:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_sistemmanajemenevent_lari
   DB_USERNAME=root
   DB_PASSWORD=      # Leave empty if using default Laragon settings
   ```

### 5. Install Dependencies
Run the following commands in your project terminal:

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies (TailwindCSS, Alpine.js)
npm install
```

### 6. Final Initialization
```bash
# Generate App Key
php artisan key:generate

# Link Storage (for uploading images)
php artisan storage:link

# Compile Assets (Build CSS/JS)
npm run build
```

---

## ▶️ Running the Application

You can run the application in two ways:

### Option A: Using Artisan Serve (Easiest)
1. Run this command:
   ```bash
   php artisan serve
   ```
2. Open your browser and go to `http://127.0.0.1:8000`.

### Option B: Using Laragon Host
1. If you placed the folder in `C:\laragon\www\Running_Event_Management`:
2. Reload Laragon.
3. Visit `http://running_event_management.test` (assuming Laragon auto-host is enabled).

---

## 👤 Login Credentials

### Admin Account
- **Email**: `admin@bandungrun.com`
- **Password**: `admin123`
- **Access**: Full access to manage events, participants, and payments.

### User Account (Participant)
- **Email**: `user@example.com` (or create a new one)
- **Password**: `user123`
- **Access**: Register for events, view leaderboard, upload payment.

---

## 📂 Important Files
- **`final_db_export.sql`**: The full SQL script to restore the database.
- **`database_features.md`**: Documentation of Triggers, Views, and Procedures used.
