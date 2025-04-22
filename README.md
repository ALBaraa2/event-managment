# 🎉 Event Management API

A Laravel RESTful API for managing events and their attendees. Includes authentication (login/register), event CRUD operations, and attendee management.

## 📌 Features

- 🔐 User Authentication (Login & Logout)
- 📅 Create, Update, Delete Events
- 👥 Add and Remove Attendees from Events
- 🧾 JSON-based RESTful API
- 🛡️ Protected routes using Laravel Sanctum

## 🛠️ Tech Stack

- **PHP** 8.x  
- **Laravel**
- **PostgreSQL**
- **RESTful API**  
- **Laravel Sanctum**

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- PostgreSQL or MySQL
- Postman or any API testing tool

### Installation

```bash
git clone https://github.com/ALBaraa2/event-managment.git
cd event-managment
composer install
cp .env.example .env
php artisan key:generate
1.Configure your .env file with your database credentials
2.Run migrations:
php artisan migrate
3.Start the server:
php artisan serve

## 🧪 API Endpoints

---

### 🔐 Authentication

| Method | Endpoint       | Body Parameters                              | Description              |
|--------|----------------|----------------------------------------------|--------------------------|
| POST   | `/api/register`| name, email, password, password_confirmation | Register a new user      |
| POST   | `/api/login`   | email, password                              | Login and receive token  |
| POST   | `/api/logout`  | -                                            | Logout (requires token)  |

---

### 📅 Events

| Method | Endpoint           | Body Parameters                  | Description              |
|--------|--------------------|----------------------------------|--------------------------|
| GET    | `/api/events`      | -                                | List all events          |
| POST   | `/api/events`      | name, description, date          | Create a new event       |
| GET    | `/api/events/{id}` | -                                | Show details of an event |
| PUT    | `/api/events/{id}` | title, description, date         | Update an existing event |
| DELETE | `/api/events/{id}` | -                                | Delete an event          |

---

### 👥 Attendees

| Method | Endpoint                        | Body Parameters          | Description                  |
|--------|---------------------------------|--------------------------|------------------------------|
| GET    | `/api/attendees`                | -                        | List all attendees           |
| GET    | `/api/events/{id}`              | -                        | Show details of an attendees |
| POST   | `/api/events/{id}/attendees`    | name, email              | Add attendee to an event     |
| DELETE | `/api/attendees/{attendee_id}`  | -                        | Remove attendee from event   |

