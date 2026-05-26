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

-- About / Member Contributions table
CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_name VARCHAR(100) NOT NULL,
    student_id VARCHAR(20) NOT NULL,
    contribution_area VARCHAR(100) NOT NULL,
    contribution_detail TEXT NOT NULL,
    project_part INT NOT NULL,
    quote_text TEXT,
    quote_lang VARCHAR(10),
    quote_translation TEXT
);

-- Insert member contributions for Part 1
INSERT INTO about (member_name, student_id, contribution_area, contribution_detail, project_part, quote_text, quote_lang, quote_translation) VALUES
('Kavish', '104001159', 'Index.HTML', 'The Home Page and its CSS', 1, 'எண்ணம் போல் வாழ்வு', '', 'Perception drives Reality'),
('Kavish', '104001159', 'Navigation Menu', 'Central Navigation Menu used on all pages', 1, NULL, NULL, NULL),
('Kavish', '104001159', 'Github Repository', 'Creator of the Github Repository', 1, NULL, NULL, NULL),
('YuKit', '106409878', 'Apply.html', 'The Apply page and its CSS', 1, '星隕似箭劃萬裡 瞬芒終歸入萬空', 'zh-Hant', 'Shooting stars cut across vast distances like arrows, a brief flash and returns to the emptiness'),
('YuKit', '106409878', 'Jira', 'Creator of the Jira Board', 1, NULL, NULL, NULL),
('Tom', '106501169', 'Jobs.html', 'The Jobs page and its CSS', 1, 'Creér, c''est vivre deux fois', 'fr', 'To create is to live twice. - Albert Camus'),
('Tom', '106501169', 'About.html', 'The About page and its CSS', 1, NULL, NULL, NULL);

-- Insert member contributions for Part 2
INSERT INTO about (member_name, student_id, contribution_area, contribution_detail, project_part) VALUES
('Kavish', '104001159', 'settings.php', 'Set up database connection settings and configuration', 2),
('Kavish', '104001159', 'EOI Table', 'Designed and created the Expression of Interest database table', 2),
('Kavish', '104001159', 'about.php', 'Updated About page to load member contributions from the database', 2),
('Tom', '106501169', 'PHP Includes', 'Extracted shared HTML (header, nav, footer) into reusable .inc files and converted all pages to .php', 2),
('Tom', '106501169', 'manage.php', 'Built the HR manager portal with login authentication', 2);