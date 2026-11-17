# Leave Request Management System

## 1. Project Description

The Leave Request Management System is a web application developed using Laravel and PHP. It allows employees to register, log in and manage their leave requests online.

Employees can submit leave requests, view their requests, edit pending requests and delete pending requests.

## 2. Technologies Used

- Laravel 13
- PHP 8.5
- SQLite Database
- HTML and CSS
- Git and GitHub
- PHPUnit / Laravel Feature Tests

## 3. Application Features

- Employee registration
- Employee login and logout
- Submit a leave request
- View a list of personal leave requests
- View leave request details
- Edit pending leave requests
- Delete pending leave requests
- Form validation
- Automatic Pending status for new requests
- Protection so employees can only access their own requests

## 4. Database

The application uses SQLite for local development.

The main database table is `leave_requests`, which stores:

- User ID
- Leave type
- Start date
- End date
- Reason
- Status
- Created and updated dates

## 5. Requirements

Before running the application, install:

- PHP 8.2 or later
- Composer
- Git

## 6. Installation and Setup

### Step 1: Clone the repository

```bash
git clone https://github.com/Nomusa03/leave-request-app.git
```

### Step 2: Open the project folder

```bash
cd leave-request-app
```

### Step 3: Install dependencies

```bash
composer install
```

### Step 4: Create the environment file

For Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

### Step 5: Generate the application key

```bash
php artisan key:generate
```

### Step 6: Create the SQLite database

Run this in PowerShell:

```powershell
if (!(Test-Path database/database.sqlite)) {
    New-Item database/database.sqlite -ItemType File
}
```

Make sure `.env` contains:

```env
DB_CONNECTION=sqlite
```

### Step 7: Run database migrations

```bash
php artisan migrate
```

### Step 8: Start the application

```bash
php artisan serve
```

Open the following address in your browser:

http://127.0.0.1:8000

## 7. Running Tests

To run the automated tests, use:

```bash
php artisan test
```

The project currently has five leave-request feature tests covering viewing, creating, updating and deleting leave requests, as well as accessing the leave-request list.

## 8. GitHub Repository

https://github.com/Nomusa03/leave-request-app

## 9. Developer

**Name:** Nomusa Mbokazi

**Project:** Leave Request Management System

**Framework:** Laravel