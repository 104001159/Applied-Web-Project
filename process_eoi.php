<?php

session_start();

// redirect
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST)) {
    header('Location: index.php');
    exit;
}

require_once 'settings.php';

// call create eoi
require_once 'create_eoi_table.php';

// Sanitise function
function clean($value) {
    return htmlspecialchars(stripslashes(trim($value)));
}


$job_ref      = clean($_POST['job_ref'] ?? '');
$first_name   = clean($_POST['first_name'] ?? '');
$last_name    = clean($_POST['last_name'] ?? '');
$dob_input    = clean($_POST['dob'] ?? '');
$email        = clean($_POST['email'] ?? '');
$phone        = clean($_POST['phone'] ?? '');
$gender       = clean($_POST['gender'] ?? '');
$street       = clean($_POST['street'] ?? '');
$suburb       = clean($_POST['suburb'] ?? '');
$state        = clean($_POST['state'] ?? '');
$postcode     = clean($_POST['postcode'] ?? '');
$other_skills = clean($_POST['other_skills'] ?? '');

// checkbox array
$skills_posted = isset($_POST['skills']) ? $_POST['skills'] : [];

// store all validation, 
$errors = [];

// 5 alphanumeric characters, 
// job ref is intentionally omitted for reasons
// 1. table might not be created if not in order (database is create in jobs.php first visit)
// 2. job listings may be internal or posted to database, checking might leak those code by bruteforce
// 3. the user might be generally applying
// 4. spec 
if ($job_ref === '') {
    $errors['job_ref'] = 'Job reference number is required.';
} elseif (!preg_match('/^[A-Za-z0-9]{5}$/', $job_ref)) {
    $errors['job_ref'] = 'Job reference must be exactly 5 alphanumeric characters (e.g. FED10).';
}

// letters only, max 20
if ($first_name === '') {
    $errors['first_name'] = 'First name is required.';
} elseif (!preg_match('/^[A-Za-z]{1,20}$/', $first_name)) {
    $errors['first_name'] = 'First name must contain letters only (max 20 characters).';
}

// letters only, max 20
if ($last_name === '') {
    $errors['last_name'] = 'Last name is required.';
} elseif (!preg_match('/^[A-Za-z]{1,20}$/', $last_name)) {
    $errors['last_name'] = 'Last name must contain letters only (max 20 characters).';
}

// dd/mm/yyyy, real date, age 16-122
$dob_for_database = '';
if ($dob_input === '') {
    $errors['dob'] = 'Date of birth is required.';
} elseif (!preg_match('/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/([0-9]{4})$/', $dob_input, $date_matches)) {
    $errors['dob'] = 'Date of birth must be in dd/mm/yyyy format.';
} else {
    $day   = (int)$date_matches[1];
    $month = (int)$date_matches[2];
    $year  = (int)$date_matches[3];
    if (!checkdate($month, $day, $year)) {
        $errors['dob'] = 'Date of birth is not a valid date.';
    } else {
        $dob_for_database = $date_matches[3] . '-' . $date_matches[2] . '-' . $date_matches[1];
        $today = new DateTime();
        $dob_obj = new DateTime($dob_for_database);

        // stackoverflow: 3776682, age calculation idea
        $applicant_age = $today->diff($dob_obj)->y;
        if ($applicant_age < 16 || $applicant_age > 122) {
            $errors['dob'] = 'Applicant must be between 16 and 122 years old.';
        }
    }
}

// email
if ($email === '') {
    $errors['email'] = 'Email address is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}

// optional + 9-12 digits only
if ($phone === '') {
    $errors['phone'] = 'Phone number is required.';
} elseif (!preg_match('/^\+?[0-9]{9,12}$/', $phone)) {
    $errors['phone'] = 'Phone number must be 9-12 digits, numbers or + only.';
}

// gender based on apply.php radio button, could be dynamic but no.
$genders = ['male', 'female', 'other', 'prefer-not'];
if ($gender === '') {
    $errors['gender'] = 'Please select a gender option.';
} elseif (!in_array($gender, $genders)) {
    // placeholder, radio button
    $errors['gender'] = 'Invalid gender selection.';
}

// street address
if ($street === '') {
    $errors['street'] = 'Street address is required.';
} elseif (strlen($street) > 40) {
    $errors['street'] = 'Street address must be 40 characters or fewer.';
}

// suburb
if ($suburb === '') {
    $errors['suburb'] = 'Suburb is required.';
} elseif (strlen($suburb) > 40) {
    $errors['suburb'] = 'Suburb must be 40 characters or fewer.';
}

// state
$allowed_states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
if ($state === '') {
    $errors['state'] = 'Please select a state.';
} elseif (!in_array(strtoupper($state), $allowed_states)) {
    // placeholder, checkbox
    $errors['state'] = 'Please select a valid Australian state.';
}

// postcode, exactly 4 digits
if ($postcode === '') {
    $errors['postcode'] = 'Postcode is required.';
} elseif (!preg_match('/^[0-9]{4}$/', $postcode)) {
    $errors['postcode'] = 'Postcode must be exactly 4 digits.';
}

// skill checkbox
$allowed_skills  = ['frontend', 'backend', 'ecommerce', 'marketing', 'product-mgmt', 'customer-exp'];
$skills_selected = [];
foreach ($skills_posted as $skill) {
    $skill = clean($skill);
    if (in_array($skill, $allowed_skills)) {
        $skills_selected[] = $skill;
    }
}
$skills_string = implode(', ', $skills_selected);

// If there are errors, store in session for apply.php sticky form,
// then show error summary page with a link back
if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data']   = [
        'job_ref'      => $job_ref,
        'first_name'   => $first_name,
        'last_name'    => $last_name,
        'dob'          => $dob_input,
        'email'        => $email,
        'phone'        => $phone,
        'gender'       => $gender,
        'street'       => $street,
        'suburb'       => $suburb,
        'state'        => $state,
        'postcode'     => $postcode,
        'skills'       => $skills_selected,
        'other_skills' => $other_skills,
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.inc'; ?>
    <title>Application Error - CartX</title>
</head>
<body>
    <header>
        <img src="images/cartx_logo.png" alt="CartX company logo">
        <h1>CartX</h1>
        <p class="slogan">E-Commerce &amp; Digital Retail Platform</p>
    </header>
    <nav>
        <p class="menu"><a href="index.php">Home</a></p>
        <p class="menu"><a href="jobs.php">Jobs</a></p>
        <p class="menu"><a href="apply.php">Apply</a></p>
        <p class="menu"><a href="about.php">About Us</a></p>
    </nav>
    <article>
        <h2>Please fix the following errors:</h2>
        <ul>
        <?php foreach ($errors as $error_message): ?>
            <li><?php echo htmlspecialchars($error_message); ?></li>
        <?php endforeach; ?>
        </ul>
        <p><a href="apply.php">Go back and fix errors</a></p>
    </article>
    <?php include 'footer.inc'; ?>
</body>
</html>
<?php
    mysqli_close($conn);
    exit;
}

// insert into database
$insert_statement = "INSERT INTO eoi
        (job_ref, first_name, last_name, dob, email, phone, gender,
         street, suburb, state, postcode, skills, other_skills, status)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";

// Searched from stackoverflow: 7537377, PHP 8.2 or above
// or use bind_param

$insert_success = mysqli_execute_query($conn, $insert_statement, [
    $job_ref, $first_name, $last_name, $dob_for_database,
    $email, $phone, $gender,
    $street, $suburb, $state, $postcode,
    $skills_string, $other_skills
    ]);

$eoi_number     = $insert_success ? mysqli_insert_id($conn) : null;
$database_error = $insert_success ? null : mysqli_error($conn);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.inc'; ?>
    <title><?php echo $insert_success ? 'Application Submitted' : 'Submission Error'; ?> - CartX</title>
</head>
<body>
    <header>
        <img src="images/cartx_logo.png" alt="CartX company logo">
        <h1>CartX</h1>
        <p class="slogan">E-Commerce &amp; Digital Retail Platform</p>
    </header>
    <nav>
        <p class="menu"><a href="index.php">Home</a></p>
        <p class="menu"><a href="jobs.php">Jobs</a></p>
        <p class="menu"><a href="apply.php">Apply</a></p>
        <p class="menu"><a href="about.php">About Us</a></p>
    </nav>
    <article>
        <?php if ($insert_success): ?>
            <h2>Application Submitted Successfully</h2>
            <p>Thank you, <?php echo $first_name . ' ' . $last_name; ?>. Your application has been received.</p>
            <p>Your EOI number is: <strong><?php echo $eoi_number; ?></strong></p>
            <p>Please keep this number for your records.</p>
            <p><a href="index.php">Back to Home</a> | <a href="apply.php">Submit Another</a></p>
        <?php else: ?>
            <h2>Database Error</h2>
            <p>Your application could not be saved. Please try again.</p>
            <?php if ($database_error): ?>
                <p><?php echo htmlspecialchars($database_error); ?></p>
            <?php endif; ?>
            <a href="apply.php">Go Back</a>
        <?php endif; ?>
    </article>
    <?php include 'footer.inc'; ?>
</body>
</html>
