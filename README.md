# PHP User Authentication and Admin Panel

This repository contains a simple PHP-based web application demonstrating user authentication with session management, a "Remember Me" feature, and distinct user and administrator roles.

## ✨ Features

* **User Registration**: Create new user accounts with email and password.
* **User Login**: Authenticate users with email and password.
* **Session Management**: Maintain user login state across pages.
* **Remember Me**: Keep users logged in using cookies.
* **Admin Panel**: Separate access for administrator users.
* **URL Rewriting**: Clean URLs using `.htaccess`.
* **MySQL Database**: Stores user data securely with hashed passwords.
* **PDO**: Secure database interactions using PHP Data Objects.

---

## 🚀 Prerequisites

Before running this application, ensure you have the following installed:

* **Web Server**: Apache (with `mod_rewrite` enabled) or Nginx
* **PHP**: Version 7.4 or higher (with `pdo_mysql` extension enabled)
* **MySQL Database**: Or any other compatible database

---

## ⚙️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/php-user-auth-admin.git
cd php-user-auth-admin
```

### 2. Database Setup

Create a new MySQL database (e.g., `test`) and run the following SQL to create the `users` table:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE
);
```

### 3. Update Database Connection

Edit the `getDatabaseConnection()` function in `login.php` and `register.php`:

```php
function getDatabaseConnection(){
    $host = "localhost";
    $dbname = "test";
    $username = "root";
    $password = "";

    $dsn = "mysql:host=$host;dbname=$dbname";
    return new PDO($dsn, $username, $password);
}
```

### 4. Configure Web Server

* Point your web server's document root to the `php-user-auth-admin` directory.
* Enable `mod_rewrite` for Apache.
* Ensure the provided `.htaccess` file is active for URL rewriting.

---

## 📅 Usage

* **Register**: Navigate to `/register` to create a new account.
* **Login**: Go to `/login` to sign in.
* **Home**: Redirects to `/` after logging in.
* **Admin Panel**: Users with `is_admin = TRUE` in the database are redirected to `/admin`.
* **Logout**: Click the "Logout Now!" link to end the session.

---

## 📂 Project Structure

```
.htaccess           # Handles URL rewriting
index.php           # Main router and entry point
login.php           # User login logic
register.php        # User registration logic
home.php            # Dashboard for logged-in users
admin.php           # Dashboard for admins
logout.php          # Logout functionality
not_found.php       # 404 Page handler
```

---

## 🔒 Security Considerations

* **Password Hashing**: Uses `password_hash()` for secure password storage.
* **Prepared Statements**: Protects against SQL injection.
* **Session Management**: Follows standard PHP session handling best practices.

**Note**: For production, add robust validation, error handling, HTTPS, CSRF protection, and secure cookie practices.

---

## ✉️ License

This project is open-source and available under the [MIT License](LICENSE).

---

## ✨ Author

Maintained by [Your Name](https://github.com/your-username).

---

## 🚧 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.
