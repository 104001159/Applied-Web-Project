-- CartX Database Setup
-- COS10026 Applied Web Project Part 2
-- Group G05

CREATE DATABASE IF NOT EXISTS cartx_db;
USE cartx_db;

-- Users table (for HR manager login)
CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

INSERT INTO users (username, password) VALUES
('admin', 'admin'),
('guest', '');

-- EOI (Expression of Interest) table
CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_ref VARCHAR(5) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    street VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state VARCHAR(3) NOT NULL,
    postcode VARCHAR(4) NOT NULL,
    skills VARCHAR(255),
    other_skills TEXT,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New'
);