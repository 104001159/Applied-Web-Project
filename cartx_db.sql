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
('Tom', '106501169', 'manage.php', 'Built the HR manager portal with login authentication', 2),
('YuKit', '106409878', 'process_eoi.php', 'Handles EOI form submission with full server-side validation and sanitisation', 2),
('YuKit', '106409878', 'jobs.php & Jobs Table', 'Created the jobs database table and added a search bar to retrieve jobs from the database', 2);


CREATE TABLE IF NOT EXISTS jobs (
    job_id                  INT AUTO_INCREMENT PRIMARY KEY,
    job_ref                 VARCHAR(5)   NOT NULL,
    title                   VARCHAR(100) NOT NULL,
    description             TEXT         NOT NULL,
    salary                  VARCHAR(50),
    reporting_line          TEXT,
    key_responsibilities    TEXT,
    essential_requirements  TEXT,
    preferred_requirements  TEXT
);

-- Jobs table
CREATE TABLE IF NOT EXISTS jobs (
    job_id                  INT AUTO_INCREMENT PRIMARY KEY,
    job_ref                 VARCHAR(5)   NOT NULL,
    title                   VARCHAR(100) NOT NULL,
    description             TEXT         NOT NULL,
    salary                  VARCHAR(50),
    reporting_line          TEXT,
    key_responsibilities    TEXT,
    essential_requirements  TEXT,
    preferred_requirements  TEXT
);

-- Seed job listings
INSERT INTO jobs (job_ref, title, description, salary, reporting_line, key_responsibilities, essential_requirements, preferred_requirements) VALUES
('FED10', 'HTML Developer',
 'We are seeking a dedicated HTML developer to join our growing CartX team. You will collaborate with renowned designers to create responsive, accessible and effective website layouts. You will also work directly with a number of clients and take direction from them. Your duties will include working on HTML and CSS files, as well as communication with clients around design.',
 '$110,000 annually',
 'Senior Developer|Head of Development Team|Product Manager|CEO',
 'Complete, end-to-end construction of websites for clients|Create maintainable and collaborative websites based on client requests|Ensure cross-platform functionality, accessibility and satisfaction are high|Test other developers websites for issues',
 'Strong ability in HTML, CSS and JavaScript|Strong familiarity with source control systems like Git|Strong accessibility, responsive design and multi-browser design with proof',
 'Knowledge of PHP or MySQL|Graphic Design ability will greatly increase interview chances|Familiarity with web security is much preferred, but this can be trained'),

('OFC39', 'Full-Time Office Cleaner',
 'We are seeking a full-time office cleaner for our Melbourne location. You will maintain a healthy, hygienic and professional workspace for the developers and designers that work in house. In this role, you are expected to dust, sweep, mop and vacuum based on the job. Deep cleaning is performed once a month, and detailed cleaning tasks may occur as needed. We offer a high hourly rate compared to other similar jobs in the area.',
 '$30 an hour',
 'Head of Cleaning Team|Human Resources|CEO',
 'Maintain a safe, healthy and clean workspace|Empty office bins|Clear lunch area|Wipe down desks, monitors and keyboards each night',
 '2+ Professional references|Ability to bend over without pain|Heavy lifting may be required',
 '>1 year of work experience as a cleaner'),

('PRM44', 'Project Manager',
 'We are seeking an experienced project manager for our Melbourne location.',
 '$150,000 annually',
 'CEO',
 'Communicate with your team of developers to create a product for our customers|Manage schedules of your team|Oversee workflow and adjust course through the process of creation',
 '2+ years of experience as a project manager|Bachelor of Business or a related degree|Strong leadership, communication and risk management skills',
 'Experience working with HTML and CSS|Budgeting skills|Other certificates in relevant fields');