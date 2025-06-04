# 🏡 Landora - Estate Management Platform

![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)
![Status](https://img.shields.io/badge/status-in--development-yellow)

Landora is a powerful and intuitive **estate management platform** built with Laravel. It provides a comprehensive system for managing properties, tenants, leases, maintenance requests, and user roles — ideal for real estate companies, agents, and landlords.

---

## ✨ Features

- 🔐 Role-Based Access Control (Admin, Agent, Tenant)
- 🏘️ Property Listing and Management
- 📋 Lease Agreements & Tenant Profiles
- 🔔 Notification System for New Posts and Updates
- 🧰 Maintenance Request Tracking
- 📊 Admin Dashboard with Analytics
- 💬 Comment System for Posts and Videos
- 🌐 Responsive Design with Bootstrap 5
- 
---

## 🚀 Tech Stack

- **Framework**: Laravel 10+
- **Frontend**: Blade, Bootstrap 5
- **Database**: MySQL / PostgreSQL
- **Authentication**: Laravel Breeze / Jetstream
- **Roles & Permissions**: Spatie Laravel-Permission
- **Notifications**: Laravel Notifications

---

## 📦 Installation

```bash
git clone https://github.com/your-username/landora.git
cd landora
composer install
cp .env.example .env
php artisan key:generate
