# Mythologisite — Multilingual Mythology Platform

> A content management system and public API for mythology stories, characters, and cultures across languages and regions.

---

## 🎯 About

Mythologisite is a full-stack platform designed to preserve and share world mythology through:

- **Admin CMS** for managing multilingual content
- **Public REST APIs** for apps and websites
- **Multi-language support** with automatic fallback

**Status:** Active Development

---

## 🛠️ Tech Stack

**Backend:** Laravel, PostgreSQL, Sanctum Auth, Docker  
**Frontend:** Next.js, TailwindCSS  
**DevOps:** Docker Compose, Git

---

## ✨ Features

- Role-based admin authentication
- Multilingual content system (cultures, stories, characters)
- RESTful APIs with locale-aware responses
- Translation management workflows
- Normalized database with relational integrity

---

## 🚀 Quick Start

### Prerequisites
- Docker & Docker Compose

### Setup
```bash
git clone https://github.com/jaya6400/mythologisite.git
cd mythologisite

# Start services
docker-compose up --build -d

# Run migrations and seed
docker exec -it mythology-backend php artisan migrate
docker exec -it mythology-backend php artisan db:seed
```

**Access:**
- Frontend: `http://localhost:3000`
- Backend API: `http://localhost:8000`

---

## 📂 Structure
```
mythologisite/
├── backend/          # Laravel API
├── frontend/         # Next.js UI
└── docker-compose.yml
```

---

## 🔗 API Endpoints
```
GET  /api/cultures/{slug}?lang=en
GET  /api/stories/{slug}?lang=hi
GET  /api/characters
```

Full API documentation: in progress.

---

**Built by Jaya Dubey**  
[LinkedIn](https://www.linkedin.com/in/jaya6400/) | [Portfolio](https://jaya-dubey-resume.netlify.app/) | jayadubey6402@gmail.com
