# Cinema — Simple Booking App (PHP + MySQL)

**Recruiter‑friendly summary:** Minimal **full‑stack** web app in **PHP** with **MySQL** demonstrating classic **CRUD** and session‑based authentication. Users can browse films, create seat bookings, and view their reservations. The code uses raw SQL via `mysqli`, server‑rendered PHP views, and a lightweight JS/CSS layer.  
**Keywords:** PHP, MySQL, mysqli, sessions, CRUD, authentication, booking system, HTML/CSS/JS.

**Live Demo:** <!-- TODO: add production URL here, e.g., https://example.com/cinema -->

---

## Tech Stack

- **Backend:** PHP (procedural), `mysqli` for database access, `session_start()` for auth/session
- **Database:** MySQL/MariaDB (schema and sample data included)
- **Frontend:** HTML + CSS (`styles.css`, `cinema.css`) + vanilla JavaScript (`cinema.js`)
- **Assets:** sample screenshots (`films.png`, `booked.png`, `users.png`)

---

## Features (from the codebase)

- **Authentication:** register and log in (sessions)
- **Films:** list films (CRUD provided in SQL scripts)
- **Booking:** create and view bookings for a selected film
- **Users:** basic user table with plaintext passwords *(demo/learning only)*

> **Note:** Educational project — no layered architecture, ORM, or framework‑level sanitization. Treat as a learning example; production would require security hardening (see “Security & Improvements” below).

---

## Database Schema

Two SQL dumps are provided: `cinema_project.sql` (schema + sample data) and `cinema_database.sql`. Main tables:

- `users (id, username, password, email)`
- `films (id, title, genre, description, image)`
- `booked (id, user_id, film_id, seats, created_at)`

---

## Local Setup

### 1) MySQL
```sql
-- create a database (e.g., cinema)
CREATE DATABASE cinema CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- import schema + sample data
-- via phpMyAdmin or CLI:
-- mysql -u root -p cinema < cinema_project.sql
```

### 2) PHP Server
Configure a virtual host or use the built‑in PHP server:

```bash
# from the project directory
php -S localhost:8000
```

### 3) DB Credentials
Update DB connection settings (`host`, `user`, `password`, `database`) in the PHP files (e.g., `index.php` / `cinema.php`).

---

## Project Structure

```
Cinema-main/
  index.php            # landing/routing
  films.php            # film views/operations
  cinema.php           # booking logic and operations
  cinema_project.sql   # schema + sample data
  cinema_database.sql  # alternative dump
  cinema.js            # minor interactions
  styles.css           # base styles
  cinema.css           # additional styles
  README.md
  *.png                # screenshots
```

---

## Screens

![image](https://user-images.githubusercontent.com/70780585/181725098-41c12922-49f8-4842-bee2-bbbadaee422c.png)
![image](https://user-images.githubusercontent.com/70780585/181725154-b0d33418-4d49-476a-aceb-3b6c9eeb2f16.png)
![image](https://user-images.githubusercontent.com/70780585/181725225-67435e9f-0a7d-4a0d-b37d-543cccd79be9.png)
![image](https://user-images.githubusercontent.com/70780585/181725265-0cc8df48-5322-438f-9dfc-dcdb2b543c8a.png)

---

## License

MIT (unless stated otherwise).
