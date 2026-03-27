# Memory Matching Game Web Application

## Project Overview

This project is an interactive Memory Matching Game Web Application developed as part of the ICT 2204 Web Design and Technologies course.

The application allows users to:

* Register and log in securely
* Play a memory matching game with different difficulty levels
* Track their scores, levels, and progress
* View game history in a profile dashboard
* Send messages through a contact form

---

## Technologies Used

* Frontend: HTML, CSS, JavaScript
* Backend: PHP
* Database: MySQL
* Server Environment: XAMPP / WAMP

---

## Setup Instructions

### 1. Install XAMPP / WAMP

Download and install XAMPP or WAMP.

Start the following services:

* Apache
* MySQL

---

### 2. Import the Database

1. Open phpMyAdmin
2. Create a new database named:

   ```
   memory_game
   ```
3. Click Import
4. Select:

   ```
   database.sql
   ```
5. Click Go

---

### 3. Configure Database Connection

Open:

```
includes/db.php
```

Update if needed:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "memory_game";
```

---

### 4. Run the Project

1. Move the project folder into the full path:

   ```
   C:\xampp\htdocs\memory_game\
   ```
2. Open your browser and go to:

   ```
   http://localhost/memory_game/home.php
   ```

---

## Features

### User Authentication

* User registration with secure password hashing
* Login system with session handling
* Logout functionality

### Game System

* Memory matching game
* Multiple difficulty levels
* Tracks moves and time
* Displays results after each game

### User Profile Dashboard

* Displays total score and current level
* Includes a progress bar for level advancement
* Shows complete game history (score, moves, time, mode, date)

### Contact Form

* Users can submit messages
* Messages are stored in the database

---

## Database Structure

### Tables:

* users
  Stores user information and total score/level

* scores
  Stores game results (score, moves, time, mode, date)

* messages
  Stores contact form submissions

---

## Project Structure

```
memory_game/
│── auth/
│   ├── login.php
│   ├── logout.php
│   ├── register.php
│── css/
│   ├── home.css
│   ├── login.css
│   ├── style.css
│── js/
│   ├── game.js
│   ├── home.js
│   ├── result.js
│── includes/
│   ├── db.php
│   ├── save_score.php
│── contact.php
│── database.sql
│── difficulty.html
│── game.html
│── home.php
│── profile.php
│── result.html
│── README.md
```

---

## How to Use

1. Register a new account
2. Log in to the system
3. Select a difficulty level
4. Play the memory game
5. View results and progress in the profile page

---

## Notes

* Ensure Apache and MySQL are running
* Import the database before running the project
* Default MySQL port: 3306

---

## Author

Developed as part of coursework for Rajarata University of Sri Lanka

Reg No: ICT/2023/106 & ICT/2023/107

---

## Submission

* All project files are uploaded to GitHub
* database.sql file is included
* README contains complete setup instructions

---
