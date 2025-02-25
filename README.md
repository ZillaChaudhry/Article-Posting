# Article Posting Website

## Overview

This project is an **Article Posting Website** built using **PHP**, **HTML**, **CSS**, **JavaScript**, and **phpMyAdmin** 
for the database. It allows users to post articles, which are then reviewed by an admin. The admin can either accept or 
reject the articles, and the status is communicated to the publisher via email. The top approved articles are displayed 
on the home page for visitors to read.

---

## Key Features

### 1. **User Article Submission**
   - Users can submit articles by filling out a form.
   - Articles are stored in the database and await admin review.

### 2. **Admin Review System**
   - Admins can log in to review submitted articles.
   - Admins can **accept** or **reject** articles based on their content.

### 3. **Email Notifications**
   - Once an article is reviewed, the publisher receives an email notification with the status (accepted or rejected).

### 4. **Home Page Display**
   - The home page displays the top approved articles for visitors to read.
   - Articles are showcased in a clean and user-friendly layout.

### 5. **Simple and Lightweight**
   - Built using **PHP** for backend logic, **HTML/CSS** for frontend design, and **JavaScript** for interactivity.
   - Uses **phpMyAdmin** for database management.

---

## Technologies Used

### Backend
- **PHP**: For server-side logic and handling article submission, review, and email notifications.
- **MySQL (phpMyAdmin)**: For storing articles, user data, and admin details.

### Frontend
- **HTML**: For structuring the web pages.
- **CSS**: For styling the website and making it visually appealing.
- **JavaScript**: For adding interactivity and dynamic features.

### Additional Tools
- **SMTP**: For sending email notifications to publishers.
- **phpMyAdmin**: For managing the MySQL database.

---

## How It Works

1. **Article Submission**:
   - Users fill out a form to submit their articles.
   - The article is saved in the database and marked as "pending" for admin review.

2. **Admin Review**:
   - Admins log in to the admin panel to review pending articles.
   - Admins can either **accept** or **reject** the article.

3. **Email Notification**:
   - Once an article is reviewed, the publisher receives an email with the status (accepted or rejected).

4. **Home Page Display**:
   - Approved articles are displayed on the home page for visitors to read.
   - The most popular or recent articles are showcased prominently.

---

## Setup and Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/ZillaChaudhry/Article-Posting.git
   ```

2. Set up the database:
   - Import the provided SQL file (e.g., `database.sql`) into your **phpMyAdmin** to create the necessary tables.

3. Configure the database connection:
   - Update the `config.php` file with your database credentials:
     ```php
     $host = "your_database_host";
     $username = "your_database_username";
     $password = "your_database_password";
     $database = "your_database_name";
     ```

4. Set up email notifications:
   - Update the email configuration in the `send_email.php` file with your SMTP credentials:
     ```php
     $smtpHost = "your_smtp_host";
     $smtpUsername = "your_smtp_username";
     $smtpPassword = "your_smtp_password";
     $smtpPort = "your_smtp_port";
     ```

5. Run the project:
   - Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Access the website via your browser (e.g., `http://localhost/Article-Posting`).

---

## Future Enhancements

- Implement **categories and tags** for articles to improve organization and searchability.
- Add a **comment system** for visitors to engage with articles.
- Implement **pagination** for the home page to handle a large number of articles.

---

Thank you for checking out this project! 🚀
