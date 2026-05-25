<?php
require_once "settings.php";

function createEOITable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS eoi (
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
    )";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

createEOITable($conn);
?>
