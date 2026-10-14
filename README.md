<p align="center">
  <img src="https://via.placeholder.com/1200x300/071318/40E0D0?text=TRAVORA+-+Explore+Beyond" alt="Travora Banner" width="100%">
</p>

<h1 align="center">🌍 Travora — AI-Powered Travel Platform</h1>

<p align="center">
  <strong>A cinematic 3D travel platform built with Laravel 9</strong><br>
  Explore destinations • AI Concierge • Trip Planner • Booking System • Admin Dashboard
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-9.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 9">
  <img src="https://img.shields.io/badge/PHP-8.0-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.0">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
  <img src="https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
</p>

---

## ✨ Features

### 🎨 Frontend
- **Cinematic 3D UI** — Custom cursor, magnetic buttons, parallax hero, glassmorphism cards
- **Custom Design System** — Dark palette (`#071318`), turquoise accent (`#40E0D0`), Syne + Inter fonts
- **Smooth Animations** — Intersection Observer fade-ins, hover 3D effects, animated progress bars
- **Fully Responsive** — Mobile-optimized adaptive layouts

### 🤖 AI Travel Concierge
- **Local Rule-Based AI** — No external API needed, works instantly
- **Intent Detection** — Greetings, budgets, packing, food, hotels, flights, destinations
- **Context-Aware** — Mention a destination → get specific info
- **Conversation Logging** — Every chat saved to DB, visible to admin

### 🗺️ Exploration
- **16 Curated Destinations** across 6 categories (Beaches, Mountains, Cities, Deserts, Forests, Islands)
- **Live Search + Filter** — JS-powered instant results
- **Category Pages** — Dedicated pages with sub-products
- **Destination Detail** — Gallery, highlights, trip info sidebar, similar destinations

### ❤️ Favorites System
- **Session-Based** — Works for both guests and logged-in users
- **AJAX Toggle** — Heart icon updates without page reload
- **Live Navbar Count** — Badge updates instantly

### 📅 Booking System
- **Multi-Step Form** — Personal info → dates → travelers → special requests
- **Live Price Calculator** — Travelers × base price in real time
- **Unique Reference** — Auto-generated (`TRV-XXXXXXXX`)
- **Success Page** — Full booking summary

### 🔐 Authentication
- **Separate User & Admin Login** — Different URLs, different redirects
- **Role-Based Access** — Middleware-protected admin routes
- **User Profile** — Bookings, favorites, activity history
- **Activity Logging** — Login, register, booking, status changes tracked

### 📊 Admin Dashboard
- **Stats Overview** — Users, bookings, revenue, AI chats
- **7-Day Booking Chart** — Visual analytics
- **Recent Activity Feed** — Real-time user actions
- **User Management** — All users with booking counts
- **Booking Management** — Change status (Pending → Confirmed → Cancelled)
- **AI Chat Monitor** — See every user's AI conversation

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 9, PHP 8.0 |
| **Database** | MySQL (Eloquent ORM, Migrations) |
| **Frontend** | Bootstrap 5, Custom CSS, Vanilla JavaScript |
| **Features** | AJAX, Session, Middleware, Blade Templates |
| **Fonts** | Google Fonts (Syne, Inter) |
| **Icons** | Font Awesome 6 |

---

## 🚀 Installation

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- Node.js & NPM (optional)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/InshalAkbar/Travora-Travel-Platform.git
   cd Travora-Travel-Platform