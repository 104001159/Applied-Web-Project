<?php
session_start();
 
// error from process_eoi
$errors = $_SESSION['form_errors'] ?? [];
$old    = $_SESSION['form_data']   ?? [];

// unset session as we have copied it
unset($_SESSION['form_errors'], $_SESSION['form_data']);
 
// past record field
$fields = [
    // from GET from jobs.php, override if process.php 
    'job_ref'      => ($old['job_ref'] ?? '') !== '' ? htmlspecialchars($old['job_ref']) : htmlspecialchars($_GET['job_ref'] ?? ''),
    'first_name'   => htmlspecialchars($old['first_name'] ?? ''),
    'last_name'    => htmlspecialchars($old['last_name'] ?? ''),
    'dob'          => htmlspecialchars($old['dob'] ?? ''),
    'email'        => htmlspecialchars($old['email'] ?? ''),
    'phone'        => htmlspecialchars($old['phone'] ?? ''),
    'street'       => htmlspecialchars($old['street'] ?? ''),
    'suburb'       => htmlspecialchars($old['suburb'] ?? ''),
    'state'        => $old['state'] ?? '',
    'postcode'     => htmlspecialchars($old['postcode'] ?? ''),
    'gender'       => $old['gender'] ?? '',
    'skills'       => $old['skills'] ?? [],
    'other_skills' => htmlspecialchars($old['other_skills'] ?? ''),
];
 
// inline error span
function field_error($field, $errors) {
    if (!empty($errors[$field])) {
        echo '<span class="field-error">&#9888; ' . htmlspecialchars($errors[$field]) . '</span>';
    }
}
 
// show error class for css
function err_class($field, $errors) {
    return !empty($errors[$field]) ? 'class="input-error"' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.inc'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apply for a position at CartX. Complete our online expression of interest form with your personal details, address, and relevant skills.">
    <meta name="author" content="YuKit(Karco)">
    <title>Apply – CartX</title>

    <style>
        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
        }
 
        .form-row .form-field {
            flex: 1;
        }
 
        .form-field {
            margin-bottom: 10px;
        }
 
        form {
            width: 620px;
            margin: 20px auto;
        }
 
        fieldset {
            margin-bottom: 15px;
            padding: 10px 15px;
            border: 1px solid #c9b8e8;
            border-radius: 6px;
            background-color: #ffffff;
        }
 
        legend {
            font-weight: bold;
            color: #2d1b4e;
        }
 
        label {
            display: block;
            font-weight: bold;
            margin-top: 6px;
            margin-bottom: 3px;
            color: #2d1b4e;
        }
 
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 6px;
            border: 2px solid #c9b8e8;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: 'Trebuchet MS', Arial, sans-serif;
            font-size: 0.95em;
        }
 
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        select:focus,
        textarea:focus {
            border-color: #d4a017;
            outline: none;
        }
 
        .input-error {
            border-color: #c0392b !important;
        }
 
        textarea {
            height: 80px;
            resize: vertical;
        }
 
        .radio-label,
        .checkbox-label {
            display: inline;
            font-weight: normal;
            margin-right: 12px;
            color: #2d2d2d;
        }
 
        input[type="submit"] {
            padding: 0.5em 1.2em;
            background-color: #2d1b4e;
            color: #fdefc3;
            border: 2px solid #2d1b4e;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Trebuchet MS', Arial, sans-serif;
            font-size: 0.95em;
            margin-top: 10px;
        }
 
        input[type="submit"]:hover {
            background-color: #d4a017;
            border-color: #d4a017;
            color: #2d1b4e;
        }
 
        .field-error {
            display: block;
            color: #c0392b;
            font-size: 0.85em;
            margin-top: 3px;
            font-weight: normal;
        }
 
    </style>
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
        <p class="menu" style="float: right;"><a href="loginpage.php">Manager Login</a></p>
    </nav>
 
    <article style="max-width: 700px;">
 
        <h2>Job Application Form</h2>
        <p>Apply for a position at CartX. All fields with * are required.</p>
 
        <form action="process_eoi.php" method="post" novalidate>
 
            <!-- Position -->
            <fieldset>
                <legend>Position</legend>
                <div class="form-field">
                    <label for="job_ref">Job Reference Number *</label>
                    <!-- maxlength is physically preventing more character, QOL, not validation -->
                    <input type="text" id="job_ref" name="job_ref"
                           placeholder="e.g. FED10"
                           maxlength="5"
                           value="<?php echo $fields['job_ref']; ?>"
                           <?php echo err_class('job_ref', $errors); ?>>
                    <?php field_error('job_ref', $errors); ?>
                </div>
            </fieldset>
 
            <!-- Personal Details -->
            <fieldset>
                <legend>Personal Details</legend>
 
                <!-- row: Fname + Lname -->
                <div class="form-row">
                    <div class="form-field">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name"
                               placeholder="John"
                               maxlength="20"
                               value="<?php echo $fields['first_name']; ?>"
                               <?php echo err_class('first_name', $errors); ?>>
                        <?php field_error('first_name', $errors); ?>
                    </div>
                    <div class="form-field">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name"
                               placeholder="Smith"
                               maxlength="20"
                               value="<?php echo $fields['last_name']; ?>"
                               <?php echo err_class('last_name', $errors); ?>>
                        <?php field_error('last_name', $errors); ?>
                    </div>
                </div>
 
                <!-- DOB -->
                <div class="form-field">
                    <label for="dob">Date of Birth * (dd/mm/yyyy)</label>
                    <input type="text" id="dob" name="dob"
                           placeholder="dd/mm/yyyy"
                           value="<?php echo $fields['dob']; ?>"
                           <?php echo err_class('dob', $errors); ?>>
                    <?php field_error('dob', $errors); ?>
                </div>
 
                <!-- row: Email + Phone -->
                <div class="form-row">
                    <div class="form-field">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email"
                               placeholder="name@example.com"
                               value="<?php echo $fields['email']; ?>"
                               <?php echo err_class('email', $errors); ?>>
                        <?php field_error('email', $errors); ?>
                    </div>
                    <div class="form-field">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone"
                               placeholder="0412345678"
                               value="<?php echo $fields['phone']; ?>"
                               <?php echo err_class('phone', $errors); ?>>
                        <?php field_error('phone', $errors); ?>
                    </div>
                </div>
 
                <!-- Gender -->
                <fieldset <?php echo !empty($errors['gender']) ? 'style="border-color:#c0392b;"' : ''; ?>>
                    <legend>Gender *</legend>
 
                    <input type="radio" id="male" name="gender" value="male"
                           <?php echo $fields['gender'] === 'male' ? 'checked' : ''; ?>>
                    <label class="radio-label" for="male">Male</label>
 
                    <input type="radio" id="female" name="gender" value="female"
                           <?php echo $fields['gender'] === 'female' ? 'checked' : ''; ?>>
                    <label class="radio-label" for="female">Female</label>
 
                    <input type="radio" id="other" name="gender" value="other"
                           <?php echo $fields['gender'] === 'other' ? 'checked' : ''; ?>>
                    <label class="radio-label" for="other">Other</label>
 
                    <input type="radio" id="prefernot" name="gender" value="prefer-not"
                           <?php echo $fields['gender'] === 'prefer-not' ? 'checked' : ''; ?>>
                    <label class="radio-label" for="prefernot">Prefer not to say</label>
 
                    <?php field_error('gender', $errors); ?>
                </fieldset>
 
            </fieldset>
 
            <!-- Address -->
            <fieldset>
                <legend>Address</legend>
 
                <div class="form-field">
                    <label for="street">Street Address *</label>
                    <input type="text" id="street" name="street"
                           placeholder="123 Main Street"
                           maxlength="40"
                           value="<?php echo $fields['street']; ?>"
                           <?php echo err_class('street', $errors); ?>>
                    <?php field_error('street', $errors); ?>
                </div>
 
                <div class="form-field">
                    <label for="suburb">Suburb / Town *</label>
                    <input type="text" id="suburb" name="suburb"
                           placeholder="Melbourne"
                           maxlength="40"
                           value="<?php echo $fields['suburb']; ?>"
                           <?php echo err_class('suburb', $errors); ?>>
                    <?php field_error('suburb', $errors); ?>
                </div>
 
                <!-- row: State + Postcode -->
                <div class="form-row">
                    <div class="form-field">
                        <label for="state">State *</label>
                        <select id="state" name="state"
                                <?php echo err_class('state', $errors); ?>>
                            <option value="">-- Select --</option>
                            <?php foreach (['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'] as $s): ?>
                                <option value="<?php echo $s; ?>"
                                    <?php echo $fields['state'] === $s ? 'selected' : ''; ?>>
                                    <?php echo $s; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php field_error('state', $errors); ?>
                    </div>
                    <div class="form-field">
                        <label for="postcode">Postcode *</label>
                        <input type="text" id="postcode" name="postcode"
                               placeholder="3000"
                               maxlength="4"
                               value="<?php echo $fields['postcode']; ?>"
                               <?php echo err_class('postcode', $errors); ?>>
                        <?php field_error('postcode', $errors); ?>
                    </div>
                </div>
 
            </fieldset>
 
            <!-- Skills -->
            <fieldset>
                <legend>Skills &amp; Experience</legend>
 
                <p>Relevant Skills (select all that apply)</p>
 
                <?php
                $skill_options = [
                    'skill_frontend' => ['frontend',     'Frontend'],
                    'skill_backend'  => ['backend',      'Backend'],
                    'skill_ecom'     => ['ecommerce',    'E-Commerce Platforms'],
                    'skill_seo'      => ['marketing',    'Marketing'],
                    'skill_pm'       => ['product-mgmt', 'Product Management'],
                    'skill_cx'       => ['customer-exp', 'Customer Experience'],
                ];
                foreach ($skill_options as $id => [$val, $label]):
                ?>
                <input type="checkbox" id="<?php echo $id; ?>" name="skills[]"
                       value="<?php echo $val; ?>"
                       <?php echo in_array($val, $fields['skills']) ? 'checked' : ''; ?>>
                <label class="checkbox-label" for="<?php echo $id; ?>"><?php echo $label; ?></label><br>
                <?php endforeach; ?>
 
                <div class="form-field">
                    <label for="other_skills">Other Skills (optional)</label>
                    <textarea id="other_skills" name="other_skills"
                              placeholder="List any other relevant skills or experience..."><?php echo $fields['other_skills']; ?></textarea>
                </div>
 
            </fieldset>
 
            <input type="submit" value="Submit Application">
 
        </form>
 
    </article>
 
    <?php include 'footer.inc'; ?>
 
</body>
</html>