<?php
require_once 'settings.php';

$sql = "CREATE TABLE IF NOT EXISTS jobs (
    job_id                  INT AUTO_INCREMENT PRIMARY KEY,
    job_ref                 VARCHAR(5)   NOT NULL,
    title                   VARCHAR(100) NOT NULL,
    description             TEXT         NOT NULL,
    salary                  VARCHAR(50),
    reporting_line          TEXT,
    key_responsibilities    TEXT,
    essential_requirements  TEXT,
    preferred_requirements  TEXT
)";

mysqli_query($conn, $sql);
?>