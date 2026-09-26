-- ============================================================
-- Khan & Teams Education
-- Complete Project Database
-- Database: khan_academy
-- Compatible with XAMPP / MySQL / MariaDB
-- ============================================================

CREATE DATABASE IF NOT EXISTS khan_academy
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE khan_academy;

-- 1. PROGRAMS
CREATE TABLE IF NOT EXISTS programs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    subtitle VARCHAR(255) DEFAULT NULL,
    short_description TEXT DEFAULT NULL,
    duration VARCHAR(100) DEFAULT NULL,
    fee VARCHAR(100) DEFAULT NULL,
    mode VARCHAR(100) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    content_1_title VARCHAR(150) DEFAULT NULL,
    content_1 TEXT DEFAULT NULL,
    content_2_title VARCHAR(150) DEFAULT NULL,
    content_2 TEXT DEFAULT NULL,
    content_3_title VARCHAR(150) DEFAULT NULL,
    content_3 TEXT DEFAULT NULL,
    content_4_title VARCHAR(150) DEFAULT NULL,
    content_4 TEXT DEFAULT NULL,
    image VARCHAR(255) DEFAULT NULL,
    status TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_program_status (status),
    INDEX idx_program_title (title)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. APPLICATIONS
CREATE TABLE IF NOT EXISTS applications (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    program_id INT UNSIGNED DEFAULT NULL,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    address TEXT DEFAULT NULL,
    status ENUM('new', 'reviewed', 'contacted', 'completed', 'cancelled') NOT NULL DEFAULT 'new',
    notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_application_email (email),
    INDEX idx_application_status (status),
    INDEX idx_application_program (program_id),
    CONSTRAINT fk_application_program FOREIGN KEY (program_id)
        REFERENCES programs(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. CONTACT MESSAGES
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    subject VARCHAR(200) DEFAULT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied', 'closed') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_contact_email (email),
    INDEX idx_contact_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. PARTNER APPLICATIONS
CREATE TABLE IF NOT EXISTS partner_applications (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(200) DEFAULT NULL,
    contact_person VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    country VARCHAR(100) DEFAULT NULL,
    website VARCHAR(255) DEFAULT NULL,
    message TEXT DEFAULT NULL,
    status ENUM('new', 'reviewed', 'contacted', 'approved', 'rejected') NOT NULL DEFAULT 'new',
    notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_partner_email (email),
    INDEX idx_partner_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. LEADS
CREATE TABLE IF NOT EXISTS leads (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) DEFAULT NULL,
    email VARCHAR(150) DEFAULT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    source VARCHAR(150) DEFAULT NULL,
    source_url VARCHAR(500) DEFAULT NULL,
    interested_program VARCHAR(150) DEFAULT NULL,
    status ENUM('new', 'contacted', 'qualified', 'converted', 'lost') NOT NULL DEFAULT 'new',
    notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_lead_email (email),
    INDEX idx_lead_phone (phone),
    INDEX idx_lead_status (status),
    INDEX idx_lead_source (source)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. BLOGS
CREATE TABLE IF NOT EXISTS blogs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT DEFAULT NULL,
    content LONGTEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    author VARCHAR(150) DEFAULT NULL,
    status ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'draft',
    published_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_blog_status (status),
    INDEX idx_blog_published_at (published_at),
    INDEX idx_blog_title (title)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. ADMIN USERS (for future Admin Panel)
CREATE TABLE IF NOT EXISTS admin_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(150) DEFAULT NULL,
    status TINYINT(1) NOT NULL DEFAULT 1,
    last_login DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_admin_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. INITIAL PROGRAM DATA
INSERT INTO programs
(title, slug, subtitle, short_description, duration, fee, mode, description, status)
VALUES
('PPP 2025', 'ppp-2025', 'PhD/MPH/MPP/MPA Pathway Program', 'Program details for PPP 2025.', NULL, NULL, 'Online', 'PPP 2025 program information.', 1),
('PhD/MRes Proposal', 'phd-mres-proposal', 'PhD/MRes Research Proposal Support', 'Support for preparing PhD/MRes research proposals.', NULL, NULL, 'Online', 'PhD/MRes proposal support information.', 1),
('English Courses', 'english-courses', 'English Language Courses', 'English language courses for different learner needs.', NULL, NULL, 'Online', 'English course information.', 1),
('Education ROI Add-ons', 'education-roi', 'Education ROI Add-ons', 'Additional education support services.', NULL, NULL, 'Online', 'Education ROI add-on information.', 1)
ON DUPLICATE KEY UPDATE
    title = VALUES(title),
    subtitle = VALUES(subtitle),
    short_description = VALUES(short_description),
    mode = VALUES(mode),
    description = VALUES(description),
    status = VALUES(status);

-- Tables in this database:
-- programs              -> Programs Details + CRUD
-- applications          -> apply.now.php submissions
-- contact_messages      -> Contact form submissions
-- partner_applications   -> B2B / Partner applications
-- leads                  -> Lead collection
-- blogs                  -> Blog Management + CRUD
-- admin_users            -> Future Admin Panel authentication
