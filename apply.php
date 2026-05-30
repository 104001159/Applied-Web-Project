<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.inc'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Application - CartX">
    <meta name="author" content="CartX Group G05">
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
    </style>
</head>
<body>

    <header>
        <img src="cartx_logo.png" alt="CartX company logo">
        <h1>CartX</h1>
        <p class="slogan">E-Commerce &amp; Digital Retail Platform</p>
    </header>

    <nav>
        <p class="menu"><a href="index.php">Home</a></p>
        <p class="menu"><a href="jobs.php">Jobs</a></p>
        <p class="menu"><a href="apply.php">Apply</a></p>
        <p class="menu"><a href="about.php">About Us</a></p>
    </nav>

    <article style="max-width: 700px;">

        <h2>Job Application Form</h2>
        <p>Apply for a position at CartX. All fields with * are required </p>

        <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">

            <!-- Position -->
            <fieldset>
                <legend>Position</legend>
                <div class="form-field">
                    <label for="job_ref">Job Reference Number *</label>
                    <input type="text" id="job_ref" name="job_ref"
                           placeholder="e.g. FED10"
                           maxlength="5"
                           pattern="[A-Za-z0-9]{5}"
                           required>
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
                               pattern="[A-Za-z]{1,20}"
                               required>
                    </div>
                    <div class="form-field">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name"
                               placeholder="Smith"
                               maxlength="20"
                               pattern="[A-Za-z]{1,20}"
                               required>
                    </div>
                </div>

                <!-- DOB -->
                <div class="form-field">
                    <label for="dob">Date of Birth * (dd/mm/yyyy)</label>
                    <input type="text" id="dob" name="dob"
                           placeholder="dd/mm/yyyy"
                           pattern="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/[0-9]{4}"
                           required>
                </div>

                <!-- row: Email + Phone -->
                <div class="form-row">
                    <div class="form-field">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email"
                               placeholder="name@example.com"
                               required>
                    </div>
                    <div class="form-field">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone"
                               placeholder="0412345678"
                               pattern="[0-9]{8,12}"
                               required>
                    </div>
                </div>

                <!-- Gender -->
                <fieldset>
                    <legend>Gender *</legend>
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label class="radio-label" for="male">Male</label>

                    <input type="radio" id="female" name="gender" value="female">
                    <label class="radio-label" for="female">Female</label>

                    <input type="radio" id="other" name="gender" value="other">
                    <label class="radio-label" for="other">Other</label>

                    <input type="radio" id="prefernot" name="gender" value="prefer-not">
                    <label class="radio-label" for="prefernot">Prefer not to say</label>
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
                           required>
                </div>

                <div class="form-field">
                    <label for="suburb">Suburb / Town *</label>
                    <input type="text" id="suburb" name="suburb"
                           placeholder="Melbourne"
                           maxlength="40"
                           required>
                </div>

                <!-- row: State + Postcode -->
                <div class="form-row">
                    <div class="form-field">
                        <label for="state">State *</label>
                        <select id="state" name="state" required>
                            <option value="">-- Select --</option>
                            <option value="VIC">VIC</option>
                            <option value="NSW">NSW</option>
                            <option value="QLD">QLD</option>
                            <option value="NT">NT</option>
                            <option value="WA">WA</option>
                            <option value="SA">SA</option>
                            <option value="TAS">TAS</option>
                            <option value="ACT">ACT</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="postcode">Postcode *</label>
                        <input type="text" id="postcode" name="postcode"
                               placeholder="3000"
                               maxlength="4"
                               pattern="[0-9]{4}"
                               required>
                    </div>
                </div>

            </fieldset>

            <!-- Skills -->
            <fieldset>
                <legend>Skills &amp; Experience</legend>

                <p>Relevant Skills (select all that apply)</p>

                <input type="checkbox" id="skill_frontend" name="skills[]" value="frontend">
                <label class="checkbox-label" for="skill_frontend">Frontend</label><br>

                <input type="checkbox" id="skill_backend" name="skills[]" value="backend">
                <label class="checkbox-label" for="skill_backend">Backend</label><br>

                <input type="checkbox" id="skill_ecom" name="skills[]" value="ecommerce">
                <label class="checkbox-label" for="skill_ecom">E-Commerce Platforms</label><br>

                <input type="checkbox" id="skill_seo" name="skills[]" value="marketing">
                <label class="checkbox-label" for="skill_seo">Marketing</label><br>

                <input type="checkbox" id="skill_pm" name="skills[]" value="product-mgmt">
                <label class="checkbox-label" for="skill_pm">Product Management</label><br>

                <input type="checkbox" id="skill_cx" name="skills[]" value="customer-exp">
                <label class="checkbox-label" for="skill_cx">Customer Experience</label><br>

                <div class="form-field">
                    <label for="other_skills">Other Skills (optional)</label>
                    <textarea id="other_skills" name="other_skills"
                              placeholder="List any other relevant skills or experience..."></textarea>
                </div>

            </fieldset>

            <input type="submit" value="Submit Application">

        </form>

    </article>

    <footer>
        <p><a href="https://your-jira-board-link.atlassian.net" target="_blank" rel="noopener noreferrer">Jira Board</a></p>
        <p><a href="https://github.com/104001159/Applied-Web-Project.git" target="_blank" rel="noopener noreferrer">GitHub Repository</a></p>
        <p><a href="mailto:info@cartx.com.au">info@cartx.com.au</a></p>
    </footer>

</body>
</html>
