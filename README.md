# Job Finder 🚀

**Job Finder** is a complete job finder web platform that allows users to browse job opportunities and enables administrators to post and manage job listings through a professional dashboard. The project is built using modern web technologies with a clean UI and smooth UX.

---

## ✨ Features

### 🔍 Job Listings

* Display all available jobs on a clean and organized homepage
* Detailed job pages including:

  * Job title
  * Company name
  * Job description
  * Salary range
  * Application link

### 🛠 Job Management (CRUD)

* Create and publish new job listings
* Edit existing jobs
* Delete jobs
* View job details in a dedicated page

### 🔐 Authentication & Authorization

* User registration and login system
* Secure routes protected using middleware
* Role-based access control (Admin / User)

### 👤 User Profile & Settings

* Personal profile page for each user
* Update personal information
* Change account password

### 💰 Salary Insights

* View average salaries by job role or category
* Simple and clear UI to help users make informed decisions

### 📄 Job Landing Page

* Dedicated landing page for each job
* Optimized layout for better application experience

### 🔎 Job Search & Filtering

* Search jobs by keywords (Frontend, Backend, PHP, Remote, etc.)
* Fast and smooth filtering system

---

## 🧰 Technologies Used

* HTML
* CSS
* JavaScript
* Laravel 10
* Blade Template Engine
* Tailwind CSS
* MySQL
---

## ⚙️ Installation & Setup

```bash
# Clone the repository
git clone https://github.com/your-username/job-finder.git

# Navigate to the project directory
cd job-finder

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file

# Run migrations
php artisan migrate

# Start the development server
php artisan serve
```

---

## 🔑 Roles & Permissions

* **Admin**: Can create, edit, and delete job listings
* **User**: Can browse jobs, search, and manage personal profile

---

## 📌 Project Purpose

This project demonstrates a real-world **Laravel CRUD application** with authentication, authorization, dashboard management, and user-focused features. It is suitable for job portals, recruitment platforms, or as a strong portfolio project.

---

## 📄 License

This project is open-source and available under the **MIT License**.

---

## 🙌 Author

Developed by **Khaled Hamdy Salama**
Full Stack Web Developer
https://khaled-dev.vercel.app/

Feel free to ⭐ the repository if you find it useful!
