# ♻️ Wastify – Smart Waste Management System

## 📌 Overview

Wastify is a smart waste management web application developed to improve the process of garbage collection, waste tracking, complaint handling, and subscription management. The platform helps households, workers, and administrators manage waste collection efficiently through a modern digital system.

The project is built using the Laravel framework with Tailwind CSS and Vite for frontend styling and development.

---

# 🚀 Features

## 👤 User Features

* User Registration & Login Authentication
* OTP Verification System
* Waste Collection Scheduling
* Subscription Management
* Online Payment Integration
* Complaint & Feedback System
* Garbage Bin Request Management
* Real-Time Truck Tracking
* Google Authentication Support

## 🧑‍💼 Admin Features

* Manage Users & Workers
* Assign Routes & Tasks
* Monitor Truck Locations
* Handle Complaints & Requests
* Manage Waste Collection Logs
* Dashboard & Analytics

## 🚛 Worker Features

* Worker Dashboard
* Route Management
* Waste Collection Status Updates
* Worker Issue Reporting
* Profile Management

---

# 🛠️ Tech Stack

## Backend

* PHP 8.2
* Laravel 11
* Laravel Jetstream
* Laravel Sanctum
* Laravel Socialite
* Livewire

## Frontend

* Tailwind CSS
* Vite
* JavaScript
* Axios

## Database

* MySQL

## Payment Integration

* Razorpay
* Stripe

---

# 📂 Project Structure

```bash
Wastify/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── vendor/
└── package.json
```

---

# ⚙️ Installation Guide

## 1️⃣ Clone the Repository

```bash
git clone https://github.com/your-username/wastify.git
cd wastify
```

## 2️⃣ Install PHP Dependencies

```bash
composer install
```

## 3️⃣ Install Node Modules

```bash
npm install
```

## 4️⃣ Configure Environment File

```bash
cp .env.example .env
```

Update the database credentials inside the `.env` file.

---

# 🗄️ Database Setup

```bash
php artisan migrate
```

(Optional)

```bash
php artisan db:seed
```

---

# 🔑 Generate Application Key

```bash
php artisan key:generate
```

---

# ▶️ Run the Application

## Start Laravel Server

```bash
php artisan serve
```

## Start Vite Development Server

```bash
npm run dev
```

Application URL:

```bash
http://127.0.0.1:8000
```

---

# 📸 Screenshots

Add your project screenshots here.

```md
![Dashboard](screenshots/dashboard.png)
![Tracking](screenshots/tracking.png)
```

---

# 🔒 Authentication & Security

* Laravel Authentication
* OTP Email Verification
* Middleware-Based Access Control
* Secure Payment Integration
* CSRF Protection

---

# 🌍 Future Enhancements

* AI-Based Waste Prediction
* Mobile Application Integration
* Smart Bin IoT Integration
* Real-Time Notifications
* Advanced Analytics Dashboard

---

# 🤝 Contributing

Contributions are welcome.

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to your branch
5. Open a Pull Request

---

# 📄 License

This project is licensed under the MIT License.

---

# 👨‍💻 Author

**Kundan Kumar**

* GitHub: [https://github.com/your-username](https://github.com/kundankumar9931)
* LinkedIn: [https://linkedin.com/in/your-profile](https://www.linkedin.com/in/kundan-kumar9931/)

---

# ⭐ Support

If you like this project, give it a ⭐ on GitHub.
