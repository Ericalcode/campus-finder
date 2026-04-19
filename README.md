# 🛡️ Campus Finder: Kirinyaga University

**Campus Finder** is a secure, responsive, web-based platform designed for students and staff to report, track, and recover lost or found items within the university campus. The project utilizes a modern **Glassmorphism UI** and is built on the robust **LAMP stack**.

---

## 🚀 Key Features

* **Live Campus Feed:** Real-time dashboard displaying verified lost and found items.
* **Admin Shield:** A master dashboard for administrators to approve posts, manage campus news, and oversee user accounts.
* **WhatsApp Integration:** Automated link generation using the **+254** prefix for seamless communication between finders and owners.
* **Photo Uploads:** Support for attaching images to posts to assist in quick identification.
* **Secure Authentication:** User accounts are protected with PHP `password_hash()` and persistent session management.
* **Mobile Optimized:** Responsive CSS Grid layout designed specifically for use on smartphones via **Cloudflare Tunnels**.

---

## 🛠️ Tech Stack

* **Frontend:** HTML5, CSS3 (Custom Glassmorphism design), JavaScript.
* **Backend:** PHP 8.x (Using PDO for SQL injection protection).
* **Database:** MySQL / MariaDB.
* **Development Environment:** Ubuntu 24.04 LTS on HP ProBook.
* **Network:** Cloudflare Tunnels (used for mobile testing and local hosting).

---

## 📂 Logical Project Structure

```text
campus_finder/
├── uploads/           # Storage for user-uploaded item images
├── admin.php          # Main Admin panel (Post moderation & news)
├── admin_users.php    # User management & password reset tools
├── index.php          # Student dashboard & live item feed
├── post_item.php      # Multi-part form for reporting items with photos
├── welcome.php        # Public landing page with campus news
├── db.php             # Centralized PDO database configuration
├── style.css          # Master stylesheet with responsive queries
└── logout.php         # Secure session destruction logic



⚙️ Setup Instructions
Clone the Repository:

Bash
git clone [https://github.com/ericalcode/campus-finder.git](https://github.com/ericalcode/campus-finder.git)
Configure Permissions:
Allow the web server to write to the uploads directory:

Bash
sudo chown -R www-data:www-data /var/www/html/campus_finder/uploads
sudo chmod -R 775 /var/www/html/campus_finder/uploads
Database Setup:
Create a database named campus_finder and import your SQL schema. Update db.php with your local MySQL credentials.

👤 Author
Eric Muboro Maina
BSc. Information Technology Student
Kirinyaga University, Kenya

📜 License
This project was developed for academic and community purposes at Kirinyaga University.


---

### How to add it manually:
1.  On your HP ProBook, run: `nano /var/www/html/campus_finder/README.md`
2.  **Paste** the content above.
3.  Save and exit (`Ctrl + O`, `Enter`, `Ctrl + X`).
4.  Run your Git commands:
    * `git add README.md`
    * `git commit -m "Finalized professional README"`
    * `git push origin main`


# 🛡️ Campus Finder: Kirinyaga University
**Official Lost and Found Portal for the Kirinyaga University Community.**

---

## 1. Project Overview
Campus Finder is a web-based utility designed to bridge the gap between finders and losers of items on campus. It streamlines the recovery process through a moderated feed, direct WhatsApp integration, and a transparent administration system.

### Core Modules
* **User Portal:** Registration, Login, Item Reporting, and Live Feed.
* **Admin Shield:** Moderation queue, News broadcasting, and User management.
* **Communication Layer:** WhatsApp API integration with automatic +254 Kenyan country code formatting.

---

## 2. Technical Architecture
The system follows the **LAMP Stack** (Linux, Apache, MySQL, PHP) architecture.

* **Operating System:** Ubuntu 24.04 LTS
* **Web Server:** Apache 2.4
* **Database:** MySQL 8.0 (Relational schema with InnoDB engine)
* **Server-Side:** PHP 8.3 (Utilizing PDO for SQL Injection prevention)
* **UI/UX:** Custom CSS with Glassmorphism effects and Mobile-First Responsive Design.
* **External Access:** Cloudflare Tunnels (Quick Tunneling for cross-device testing).



---

## 3. Logical Project Structure
The code is organized logically to separate concerns between administration and user-facing features:

```text
campus_finder/
├── uploads/           # Permanent storage for item imagery
├── admin.php          # Admin Controller: Approve/Delete posts & News
├── admin_users.php    # User Controller: Identity management & Password resets
├── index.php          # Main Feed: Displays active/approved posts
├── post_item.php      # Data Entry: Form for reporting items (with photo support)
├── login.php          # Auth Logic: Session handling and credential verification
├── db.php             # Config: Centralized PDO database connection
├── style.css          # Design System: Responsive layout and glassmorphism
└── logout.php         # Security: Destroys session and redirects to welcome


4. Installation & Deployment Guide
Follow these steps to deploy a local instance of Campus Finder.

Step 1: Clone the Repository
Clone the project into your local web root:

Bash
cd /var/www/html/
sudo git clone [https://github.com/ericalcode/campus-finder.git](https://github.com/ericalcode/campus-finder.git)
cd campus_finder
Step 2: Database Setup
Log in to your MySQL terminal: mysql -u root -p

Run the following commands:

SQL
CREATE DATABASE campus_finder;
USE campus_finder;
-- Import the database.sql file if provided, or create tables manually
Update db.php with your local database username and password.

Step 3: Configure File Permissions
The system requires write access to the uploads/ folder for images to appear correctly:

Bash
sudo chown -R www-data:www-data /var/www/html/campus_finder/uploads
sudo chmod -R 775 /var/www/html/campus_finder/uploads
Step 4: PHP Configuration
Adjust php.ini to support mobile photo uploads (usually > 2MB):

Locate php.ini (e.g., /etc/php/8.3/apache2/php.ini).

Update:

upload_max_filesize = 20M

post_max_size = 25M

Restart Apache: sudo systemctl restart apache2

5. Security Protocols
Data Sanitization: All user inputs are sanitized via a custom e() function to prevent XSS.

Password Security: Passwords are never stored in plain text; they are hashed using password_hash() and verified via password_verify().

Moderation Gate: Items are set to Pending by default. They only appear on the public feed once an administrator changes the status to Active.

6. Author & Attribution
Eric Muboro Maina
Bachelor of Science in Information Technology
Kirinyaga University

7. Future Enhancements
Implementation of real-time email notifications for item matches.

Integration of a Reputation Score system to reward honest finders.

Google Maps API integration for pinpointing exact "Found At" locations.

