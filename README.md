# Khan & Teams Education Website

> A responsive PHP and MySQL based education consultancy website developed as an academic and industrial attachment project.

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-Frontend-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-Styling-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-Interactions-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![XAMPP](https://img.shields.io/badge/XAMPP-Local%20Development-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)

## Project Overview

Khan & Teams Education is a responsive education consultancy website built with PHP, MySQL, HTML, CSS, and JavaScript.

The project focuses on recreating a modern education consultancy website experience while adding a functional backend for dynamic program information, form submissions, database operations, and administrative management.

The website contains reusable header and footer components, responsive layouts, program-specific detail pages, database-driven content, user submission forms, and an admin panel for program management.

---

## Objectives

- Build a responsive and user-friendly education consultancy website.
- Develop the website using PHP and MySQL with XAMPP.
- Connect frontend pages with a relational database.
- Display program information dynamically from MySQL.
- Store application, contact, and partner form submissions.
- Implement CRUD operations for program management.
- Create an admin area for managing programs and viewing submitted data.
- Maintain a clean and reusable project structure.

---

## Key Features

### 1. Responsive Website Interface

The website includes:

- Responsive navigation bar
- Programs dropdown menu
- Hero/banner sections
- Service cards
- Study destination cards
- Student success stories
- Call-to-action sections
- Reusable footer
- Responsive mobile layout
- Floating WhatsApp button
- Back-to-top interaction

### 2. Main Website Pages

| Page | Description |
| --- | --- |
| Home | Main landing page with services, destinations, statistics, success stories and CTA |
| About Us | Company overview, mission, values and compliance information |
| Services | Education consultancy services and service descriptions |
| Contact | Payment information, partner programme and contact forms |
| Apply Now | Student application form |
| PPP 2025 | Dynamic Professional Practice Programme details |
| PhD/MRes Proposal | Dynamic research proposal and supervisor support details |
| English Courses | Dynamic English and communication course details |
| Education ROI Add-ons | Dynamic ROI success stories |

### 3. Dynamic Programs

Program information is connected to MySQL instead of being fully hardcoded in the page files.

The program system uses:

- `programs`
- `program_sections`
- `roi_stories`

Program detail pages retrieve their content from the database using program slugs.

### 4. Form Processing

The website includes database-connected forms.

#### Application Form

The `apply.now.php` page collects:

- Full Name
- Email
- Phone Number
- Address

Submissions are stored in the `applications` table.

#### Contact Form

The contact form collects:

- Full Name
- Email Address
- Phone Number
- Destination Interest
- Message
- PPP Interest

Submissions are stored in the `contact_messages` table.

#### Partner Application Form

The partner form collects:

- Full Name
- Agency Name
- Country
- Phone Number
- Email Address
- Experience
- Agreement

Submissions are stored in the `partner_applications` table.

### 5. Admin Panel

The admin area contains:

- Dashboard
- Program listing
- Add Program
- Edit Program
- Delete Program
- Application listing
- Contact message listing
- Application status update
- Contact message status update

### 6. Program CRUD

CRUD operations are available for program management:

- **Create** — Add a new program
- **Read** — View programs from the database
- **Update** — Edit existing program information
- **Delete** — Remove a program

---

## Database Design

Database name:

```text
khan_academy
```

### Main Tables

| Table | Purpose |
| --- | --- |
| `programs` | Stores program information |
| `program_sections` | Stores sections/cards for program detail pages |
| `roi_stories` | Stores Education ROI success stories |
| `applications` | Stores student applications |
| `contact_messages` | Stores contact form messages |
| `partner_applications` | Stores partner applications |
| `leads` | Lead collection structure |
| `blogs` | Blog management structure |
| `admin_users` | Admin user structure |

The database setup and starter data are stored in:

```text
database/khan_academy.sql
```

---

## Database Workflow

```text
                     Khan & Teams Education
                              |
                +-------------+-------------+
                |             |             |
                v             v             v
          Application      Contact       Partner
             Form           Form          Form
                |             |             |
                v             v             v
         applications   contact_messages  partner_applications
                |             |             |
                +-------------+-------------+
                              |
                              v
                            MySQL
                        khan_academy


Program Management:

Admin Panel
     |
     v
Programs CRUD
     |
     +---- Create
     +---- Read
     +---- Update
     +---- Delete
     |
     v
   programs
      |
      +---- program_sections
      |
      +---- roi_stories
```

---

## Project Structure

```text
Khan-and-Teams-Education/
│
├── admin/
│   ├── add-program.php
│   ├── applications.php
│   ├── delete-program.php
│   ├── edit-program.php
│   ├── index.php
│   ├── messages.php
│   └── programs.php
│
├── assets/
│   └── images/
│       ├── about-bg.jpg
│       ├── australia.jpg
│       ├── hero-bg.jpg
│       ├── logo.png
│       ├── malaysia.jpg
│       ├── new-zealand.jpg
│       ├── other-destinations.jpg
│       ├── services-bg.jpg
│       ├── thailand.jpg
│       └── uk.jpg
│
├── config/
│   └── database.php
│
├── css/
│   └── style.css
│
├── database/
│   └── khan_academy.sql
│
├── includes/
│   ├── footer.php
│   └── header.php
│
├── js/
│   └── script.js
│
├── roi/
│   └── index.php
│
├── about.php
├── apply.now.php
├── contact.php
├── english_courses.php
├── index.php
├── phd_proposal.php
├── ppp.php
├── programs.php
├── services.php
├── .gitignore
└── README.md
```

### Folder Responsibilities

**`admin/`**  
Contains backend management pages for programs, applications and contact messages.

**`assets/images/`**  
Contains website images and branding assets.

**`config/`**  
Contains the database connection file.

**`css/`**  
Contains the main stylesheet used across the website.

**`database/`**  
Contains the SQL database backup and setup file.

**`includes/`**  
Contains reusable header and footer components.

**`js/`**  
Contains frontend JavaScript interactions and UI behavior.

**`roi/`**  
Contains the Education ROI page and its nested resources.

---

## Technologies

- **PHP** — Server-side development and database operations
- **MySQL** — Relational database
- **HTML5** — Website structure
- **CSS3** — Responsive styling and visual design
- **JavaScript** — Frontend interactions
- **Font Awesome** — Icons
- **XAMPP** — Local PHP/MySQL development environment
- **phpMyAdmin** — Database management
- **Git & GitHub** — Version control and project hosting

---

## Local Setup

### 1. Install XAMPP

Start:

```text
Apache
MySQL
```

### 2. Place the project

Copy the project into:

```text
C:\xampp\htdocs\Khan-and-Teams-Education
```

### 3. Create the database

Open:

```text
http://localhost/phpmyadmin
```

Import:

```text
database/khan_academy.sql
```

### 4. Configure database connection

Open:

```text
config/database.php
```

Default local configuration:

```text
Host: localhost
Database: khan_academy
Username: root
Password: empty
```

### 5. Run the website

Open:

```text
http://localhost/Khan-and-Teams-Education/
```

### 6. Open the admin area

```text
http://localhost/Khan-and-Teams-Education/admin/
```

---

## Screenshots

### Home Page — Desktop

![Home Page Desktop](screenshots/home-desktop.png)

### Home Page — Mobile

![Home Page Mobile](screenshots/home-mobile.png)

### PPP 2025

![PPP 2025](screenshots/ppp.png)

### PhD/MRes Proposal

![PhD/MRes Proposal](screenshots/phd-mres.png)

### English Courses

![English Courses](screenshots/english-courses.png)

### Education ROI

![Education ROI](screenshots/roi.png)

---

## Implementation Highlights

### Reusable Components

Common website elements are separated into:

```text
includes/header.php
includes/footer.php
```

This keeps the layout consistent and reduces repeated code.

### Database Connectivity

The project uses PDO for MySQL connectivity through:

```text
config/database.php
```

Prepared statements are used in database-driven form and CRUD operations.

### Dynamic Content

Program pages retrieve information from MySQL so that program data can be updated without rewriting the full page layout.

### Form Validation

Form handling includes required-field validation and email validation before inserting records into the database.

### Responsive Design

The interface adapts to desktop, tablet and mobile screen sizes.

---

## Development Status

### Completed

- [x] Responsive homepage
- [x] About page
- [x] Services page
- [x] Contact page
- [x] Application page
- [x] Programs dropdown
- [x] PPP program page
- [x] PhD/MRes program page
- [x] English Courses page
- [x] Education ROI page
- [x] MySQL database integration
- [x] Dynamic program content
- [x] Application form database storage
- [x] Contact form database storage
- [x] Partner application database storage
- [x] Admin dashboard
- [x] Program CRUD
- [x] Application management
- [x] Contact message management

---

## Future Improvements

Possible future extensions include:

- Secure admin authentication
- Full blog management
- Lead management interface
- Email notifications
- File upload management
- Online deployment
- Production database configuration

---

## Conclusion

This project combines a responsive frontend with a functional PHP and MySQL backend. It demonstrates practical implementation of reusable components, dynamic database-driven content, form processing, CRUD operations, and administrative data management in a real-world website structure.

---

## Project Purpose

This website was developed as an academic and industrial attachment project to gain practical experience in:

- Full-stack web development
- PHP programming
- MySQL database management
- CRUD operations
- Form processing
- Responsive UI development
- Local server deployment using XAMPP
- Version control with Git and GitHub
