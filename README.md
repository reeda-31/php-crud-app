# 📝 PHP MySQL CRUD App — My Daily Life Activity Tracker

This project is a **CRUD (Create, Read, Update, Delete)** web application built with **PHP**, **MySQL**, and **Bootstrap 4**.  
It lets users manage their daily life activities — add, search, edit, and delete activities — all in a clean, responsive interface.

---

## 📌 Features
- **Add Activities**: Create a new activity with ID, title, and description.
- **View Activities**: Display all saved activities in a table format.
- **Search Activities**: Search by title or description with **highlighted search results**.
- **Edit Activities**: Update title and description for an existing activity.
- **Delete Activities**: Remove an activity, with automatic ID adjustment.
- **Bootstrap Styling**: Responsive, mobile-friendly interface with modals.
- **Prepared Statements**: Secure MySQL queries to prevent SQL injection.

---

## 📂 Project Structure
.
├── DBCon.php # Database connection script (uses .env variables)
├── index.php # Main CRUD interface with HTML & PHP logic
├── .env # Database credentials (ignored in Git)
├── .gitignore # Ensures .env is not pushed to GitHub
└── README.md # Project documentation

---

## ⚙️ Installation & Setup

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/yourusername/yourrepo.git
cd yourrepo

2️⃣ Create the .env File
DB_SERVER=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_NAME=2341041044

3️⃣ Create the Database Table
Run the following SQL in phpMyAdmin or MySQL CLI:

sql
Copy
Edit
CREATE TABLE ActivityList (
    ActID INT PRIMARY KEY,
    ActTitle VARCHAR(255) NOT NULL,
    ActDesc TEXT NOT NULL
);

4️⃣ Configure XAMPP / WAMP
Move the project folder into your htdocs (XAMPP) or www (WAMP) directory.

Start Apache and MySQL.

5️⃣ Run the App
Open your browser:

arduino
Copy
Edit
http://localhost/yourproject/index.php
🛠 How It Works
Add Activity
Click Add Your Activity button.

Fill in ID, Title, and Description in the modal form.

Data is inserted via a prepared statement into ActivityList.

Search Activity
Enter a keyword in the search box.

Matching words in Title or Description are highlighted.

Edit Activity
Click Edit on the desired row.

Update the details in the modal.

Changes are saved with a prepared UPDATE query.

Delete Activity
Click Delete to remove a record.

All subsequent IDs are decremented automatically.
🔒 Security Notes
Uses prepared statements to avoid SQL injection.

.env file with DB credentials is ignored by GitHub via .gitignore.

Never commit your .env file.

📜 License
This project is open source and free to use.

yaml
Copy
Edit

---

If you want, I can **add screenshots & usage GIFs** to the README so it looks visually impressive on GitHub.  
That will make it easier for others to understand your app at a glance.
