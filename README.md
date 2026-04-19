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



