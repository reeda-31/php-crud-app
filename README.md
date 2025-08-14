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

## 🗂 Project Structure
```bash
CRUDOperation/
│
├── DBConnection.php   # Handles DB connection using .env values
├── index.php          # Main CRUD operations and UI
├── .env               # Local database credentials 
└── README.md          # Project instructions
```

## ⚙️ Installation & Setup

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/reeda-31/php-crud-app.git
cd yourrepo
```

### 2️⃣ Create the .env File
```bash
DB_SERVER=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_NAME=2341041044
```

### 3️⃣ Create the Database Table
```bash
Run the following SQL in phpMyAdmin or MySQL CLI:

CREATE TABLE ActivityList (
    ActID INT PRIMARY KEY,
    ActTitle VARCHAR(255) NOT NULL,
    ActDesc TEXT NOT NULL
);
```

### 4️⃣ Configure XAMPP / WAMP
```bash
Move the project folder into your htdocs (XAMPP) or www (WAMP) directory.
Start Apache and MySQL.
```

### 5️⃣ Run the App
```bash
Open your browser:
http://localhost/yourproject/index.php
``` 

### 🛠 How It Works
```bash
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
```

### 🔒 Security Notes
```bash
Uses prepared statements to avoid SQL injection.
.env file with DB credentials is ignored by GitHub via .gitignore.
```
