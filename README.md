# Media Library

A web-based Media Library application built with **PHP, MySQL, and the MVC (Model–View–Controller) architecture**. The project is organized into application logic, views, public assets, and database scripts to support structured development and maintenance.

## 📌 Project Overview

Media Library is designed to organize media-related functionality in a web application using PHP and a MySQL database. It separates application logic from the user interface through the MVC pattern.

## 🛠️ Tech Stack

- **Backend:** PHP
- **Database:** MySQL
- **Architecture:** Model–View–Controller (MVC)
- **Dependency Management:** Composer
- **Frontend:** HTML, CSS, JavaScript
- **Local Development:** XAMPP / Apache

## 📂 Project Structure

```text
Media-Library/
├── App/                 # Application logic
├── Public/              # Public application resources
├── css/                 # Stylesheets
├── img/                 # Image assets
├── view/                # View templates
├── vendor/              # Composer dependencies
├── .env.example         # Example environment configuration
├── composer.json        # Project dependencies
├── composer.lock        # Locked dependency versions
├── database.sql         # Database SQL script
├── Database01.sql       # Additional database script
└── StoreProcedures.sql  # Stored procedure definitions
```

*The exact responsibilities of individual files may vary depending on their implementation.*

## ⚙️ Getting Started

### Prerequisites

Make sure you have installed:

- PHP 8.1 or a compatible version required by the project
- MySQL or MariaDB
- Apache server (XAMPP recommended)
- Composer
- Git

### 1. Clone the Repository

```bash
git clone https://github.com/htetnandarlinn14/Media-Library.git
```

Navigate to the project directory:

```bash
cd Media-Library
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment Variables

Copy `.env.example` to `.env` and configure the values required by your application.

For example:

```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

Use the actual variable names expected by the project's configuration code. Do not commit passwords, API keys, or other secrets to GitHub.

### 4. Set Up the Database

1. Start Apache and MySQL from the XAMPP Control Panel.
2. Open phpMyAdmin at `http://localhost/phpmyadmin`.
3. Create the database required by the application.
4. Import the appropriate SQL file from the project, such as `database.sql`.
5. Run any additional SQL scripts required by the application.

Check the SQL files before importing them to determine which schema and stored procedures are required.

### 5. Run the Application

Place the project inside your XAMPP `htdocs` directory if it is not already there.

Start Apache and MySQL, then open the appropriate application URL in your browser:

```text
http://localhost/Media-Library/
```

If the application uses a different entry point or document root, adjust the URL or Apache configuration accordingly.

## 🔑 Key Concepts

- MVC architecture for separation of concerns
- PHP-based server-side development
- MySQL database integration
- Composer dependency management
- Environment-based configuration
- Reusable application components

## 🚀 Future Improvements

- Improve media organization and search functionality
- Enhance input validation and error handling
- Strengthen authentication and authorization where applicable
- Add automated tests
- Improve responsive design and accessibility
- Document database relationships and application workflows

## 👨‍💻 Author

**Htet Nandar Linn**

GitHub: [@htetnandarlinn14](https://github.com/htetnandarlinn14)

## 📄 License

No license has been specified yet. All rights are reserved by default unless a license is added to the repository. Add an appropriate open-source license if you intend to permit reuse or modification.

---

⭐ If you find this project useful, feel free to explore the repository and its implementation.

**Repository:** [Media-Library on GitHub](https://github.com/htetnandarlinn14/Media-Library)
