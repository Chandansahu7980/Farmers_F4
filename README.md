# 🌾 PROJECT-F4 | Farming Help Web Application

**PROJECT-F4** is a user-friendly web application aimed at helping farmers with agricultural guidance, crop management, expert consultations, and access to government schemes. Built using **PHP** and **MySQL**, this project was developed on B.Sc. ITM final-year of **Ravenshaw University** as part of my academic project submission.

---

## 📋 Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Screenshots](#screenshots)
- [Installation Guide](#installation-guide)
- [Project Modules](#project-modules)
- [Future Enhancements](#future-enhancements)
- [Contributors](#contributors)
- [License](#license)

---

## 🚀 Features

- 📌 Farmer registration and profile management  
- 🧑‍🌾 Step-by-step crop harvesting guides  
- 🧪 Pesticide and fertilizer information  
- 🧠 Expert advice and interaction  
- 📢 Government schemes, rules & alerts  
- 📰 News updates and farming insights  
- 🔒 Secure login system with password recovery  
- 📈 Admin dashboard for managing users and crops  
- 🛠️ Session tracking for both experts and farmers  

---

## 🛠 Technologies Used

- **Frontend**: HTML5, CSS3, JS  
- **Backend**: PHP 8.0+  
- **Database**: MySQL  
- **Platform**: Apache Server (via XAMPP)  

---

## 📁 Project Structure
<pre>
Project-f4/
├── db/ # SQL dump files and DB config file
├── php/
│ ├── admin/ # Admin login, dashboard, CRUD operations
│ ├── expertise/ # Expert login and query handling modules
│ ├── css/ # Stylesheets (if used)
│ │
│ └── ... # Core PHP files like index, crop details, login pages
├── imgs/ # Image assets used across the site
├── favicon.ico # Website favicon
├── Project_F4_Documantation.pdf # Final project documentation

</pre>


Each directory serves a role-based or functional purpose:
- **`db/`**: Database credentials and SQL imports
- **`php/admin/`**: Admin pages and actions
- **`php/expertise/`**: Expert interface and features
- **`php/`**: Shared PHP files like home, login, crop details
- **`imgs/`**: Static image content for the UI

> This modular structure keeps the project scalable and easy to navigate.


## 🖥️ Screenshots

> Screenshots are included in the documentation PDF.

---

## 📥 Installation Guide

Follow these steps to set up the project locally on your machine using XAMPP.

- **Step 1: Download and Install XAMPP**
  - Visit the official site: [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)
  - Download the latest version of XAMPP suitable for your operating system.
  - Run the installer and complete the installation.

- **Step 2: Start XAMPP Control Panel**
  - Launch XAMPP Control Panel.
  - Start the following services:
    - ✅ **Apache**
    - ✅ **MySQL**
    - (Optional) ✅ **FileZilla** (if your project uses FTP)

- **Step 3: Create a MySQL Database**
  - In your browser, open:
    ```
    http://localhost/phpmyadmin
    ```
  - Click **New**, enter a name such as `farming_db`, and click **Create**.

- **Step 4: Import the Database**
  - Click the **Import** tab in the newly created database.
  - Choose the provided `.sql` file (located in the `/db` or main project folder).
  - Click **Go** to import the schema and data.

- **Step 5: Move Project Files**
  - Copy your full project folder (e.g., `project-f4`) into:
    ```
    C:\xampp\htdocs\
    ```

- **Step 6: Configure Database Connection**
  - Open the file in any code editor:
    ```
    /project-f4/db/config.php
    ```
  - Make sure it reflects the database you created:
    ```php
    $servername = "localhost";
    $username = "root";
    $password = ""; // leave empty for XAMPP default
    $dbname = "farming_db"; // must match your **phpMyAdmin DB name**
    ```

- **Step 7: Test Database Connection**
  - To verify DB connectivity:
    - Open your browser and go to:
      ```
      http://localhost/project-f4/src/db/config.php
      ```
    - Check the output in the **browser or browser console**:
      - You should see a success message like:
        ```
        Connection successful!
        ```
      - If not, check your `config.php` for any DB name or credential issues.

- **Step 8: Access the Website**
  - In your browser, go to:
    ```
    http://localhost/project-f4/src/php/
    ```
  - The homepage or login screen should load.

- **Step 9: Admin Login Credentials**
  - Default Admin Login:
    - **Username**: `admin`
    - **Password**: `969696`
  - 🔐 To change these credentials, go to:
    ```
    /project-f4/src/php/admin/admin-login.php
    ```
    - Locate and update the hardcoded username and password securely.

---

✅ Your local copy of the Farming Help project is now running and connected to the database!



## 🔧 Project Modules

- **Admin Module**
  - Dashboard: View farmer/expert profiles, crop steps, queries  
  - Manage: Add/update farmers and crops  
  - View & update: Farmer and expert details   
  - Contact Queries: View incoming messages  
  - Account: View/edit profile and change password
  - Add/Update existing data

- **Farmer Module**
  - Dashboard: View profile and crop guides  
  - Expert Advice: Submit questions to experts  
  - History: View previously asked queries  
  - Account: Update profile, change or recover password  

- **Expert Module**
  - Dashboard: Manage profile and reply to queries  
  - History: View answered query history  
  - Account: Update personal info, change or recover password  

---

## 🌟 Future Enhancements

- 📱 Mobile App for Android/iOS  
- 🛒 E-commerce: Buy/sell seeds, tools  
- 🌐 Multilingual support for regional users  
- 📊 Live market pricing and news  
- 👨‍🔧 Dealer login and inventory features  
- ⭐ Feedback/review system for content and services  

---

## 👥 Contributors

#### **Chandan Kumar Sahu** (20DIT035)  

> Department of Information Technology Management  
> Ravenshaw University, Cuttack, Odisha

---

## 📄 License

This project is for academic and non-commercial use only. Free for reuse.

---

## 🔗 Reference Links

- [AgriApp on Play Store](https://play.google.com/store/apps/details?id=com.criyagen)  
- [Odisha Agriculture Schemes](https://agri.odisha.gov.in/schemes-agriculture/agriculture)
