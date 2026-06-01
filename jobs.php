<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.inc'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Browse open roles at CartX including developer, management, and operations positions. View full job details, salary, responsibilities, and apply directly.">
    <meta name="keywords" content="HTML, jobs">
    <meta name="author" content="Karco, Tom Holiday">
    <title>CartX Careers</title>
    <style>
        header {
            background-image: url('images/purple_banner.jpg');
            background-size: cover;
            background-position: center;
        }
        .applyhere {
            display: flex;
            background-color: #d4a017;
            width: 25%;
            align-items: right;
            justify-content: right;
            font-size: 1.5em;
            border: solid #2d1b4e;
            margin: 5% 5% 5% 5%;
            padding: 5% 5% 5% 5%;
        }
        #job-search-form {
            margin: 1em 2em;
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

<?php
require_once 'settings.php';
require_once 'create_jobs_table.php';

// default job values, hardcoded, from project 1
$row_count_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jobs");
$row_count_row    = mysqli_fetch_assoc($row_count_result);

if ((int)$row_count_row['total'] === 0) {
    $jobs_to_seed = [
        [
            'job_ref'     => 'FED10',
            'title'       => 'HTML Developer',
            'description' => 'We are seeking a dedicated HTML developer to join our growing CartX team. You will collaborate with renowned designers to create responsive, accessible and effective website layouts. You will also work directly with a number of clients and take direction from them. Your duties will include working on HTML and CSS files, as well as communication with clients around design.',
            'salary'      => '$110,000 annually',
            'reporting'   => 'Senior Developer|Head of Development Team|Product Manager|CEO',
            'responsibilities' => 'Complete, end-to-end construction of websites for clients|Create maintainable and collaborative websites based on client requests|Ensure cross-platform functionality, accessibility and satisfaction are high|Test other developers websites for issues',
            'essential'   => 'Strong ability in HTML, CSS and JavaScript|Strong familiarity with source control systems like Git|Strong accessibility, responsive design and multi-browser design with proof',
            'preferred'   => 'Knowledge of PHP or MySQL|Graphic Design ability will greatly increase interview chances|Familiarity with web security is much preferred, but this can be trained'
        ],
        [
            'job_ref'     => 'OFC39',
            'title'       => 'Full-Time Office Cleaner',
            'description' => 'We are seeking a full-time office cleaner for our Melbourne location. You will maintain a healthy, hygienic and professional workspace for the developers and designers that work in house. In this role, you are expected to dust, sweep, mop and vacuum based on the job. Deep cleaning is performed once a month, and detailed cleaning tasks may occur as needed. We offer a high hourly rate compared to other similar jobs in the area.',
            'salary'      => '$30 an hour',
            'reporting'   => 'Head of Cleaning Team|Human Resources|CEO',
            'responsibilities' => 'Maintain a safe, healthy and clean workspace|Empty office bins|Clear lunch area|Wipe down desks, monitors and keyboards each night',
            'essential'   => '2+ Professional references|Ability to bend over without pain|Heavy lifting may be required',
            'preferred'   => '>1 year of work experience as a cleaner'
        ],
        [
            'job_ref'     => 'PRM44',
            'title'       => 'Project Manager',
            'description' => 'We are seeking an experienced project manager for our Melbourne location.',
            'salary'      => '$150,000 annually',
            'reporting'   => 'CEO',
            'responsibilities' => 'Communicate with your team of developers to create a product for our customers|Manage schedules of your team|Oversee workflow and adjust course through the process of creation',
            'essential'   => '2+ years of experience as a project manager|Bachelor of Business or a related degree|Strong leadership, communication and risk management skills',
            'preferred'   => 'Experience working with HTML and CSS|Budgeting skills|Other certificates in relevant fields'
        ]
    ];

    // Searched from stackoverflow: 7537377, PHP 8.2 or above
    $seed_sql = "INSERT INTO jobs (job_ref, title, description, salary, reporting_line, key_responsibilities, essential_requirements, preferred_requirements)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    foreach ($jobs_to_seed as $job_data) {
        mysqli_execute_query($conn, $seed_sql, [
            $job_data['job_ref'], $job_data['title'], $job_data['description'], $job_data['salary'],
            $job_data['reporting'], $job_data['responsibilities'], $job_data['essential'], $job_data['preferred']
        ]);
    }
}

// if search is set, get search value, else ''
$search_term = isset($_GET['search_job']) ? trim($_GET['search_job']) : '';

if ($search_term !== '') {
    $search_sql     = "SELECT * FROM jobs WHERE title LIKE ? OR description LIKE ? OR job_ref LIKE ?";
    $search_pattern = '%' . $search_term . '%';
    $query_result   = mysqli_execute_query($conn, $search_sql, [$search_pattern, $search_pattern, $search_pattern]);
} else {
    $query_result = mysqli_query($conn, "SELECT * FROM jobs");
}

$jobs_list = [];
while ($job_row = mysqli_fetch_assoc($query_result)) {
    $jobs_list[] = $job_row;
}

mysqli_close($conn);

// Split a pipes string into an array for rendering lists
function split_list($text) {
    return array_filter(array_map('trim', explode('|', $text)));
}
?>

    <h2 id="topofjobs">Jobs</h2>

    <form id="job-search-form" action="jobs.php" method="get" role="search">
        <label for="search_job">Search jobs:</label>
        <input type="search" id="search_job" name="search_job"
               placeholder="e.g. Developer, FED10..."
               value="<?php echo htmlspecialchars($search_term); ?>">
        <input type="submit" value="Search">
        <?php if ($search_term !== ''): ?>
            <a href="jobs.php">Clear search</a>
        <?php endif; ?>
    </form>

    <?php if ($search_term !== ''): ?>
        <p style="margin-left: 2em;">
            <?php echo count($jobs_list); ?> result(s) for
            "<strong><?php echo htmlspecialchars($search_term); ?></strong>"
        </p>
    <?php endif; ?>

    <?php if (empty($jobs_list)): ?>
        <p style="margin-left: 2em;">No jobs found. <a href="jobs.php">View all jobs.</a></p>

    <?php else: foreach ($jobs_list as $job_row): ?>

    <section>
        <fieldset>
            <h2><?php echo htmlspecialchars($job_row['title']); ?></h2>
            <p><?php echo htmlspecialchars($job_row['title']); ?> : <?php echo htmlspecialchars($job_row['job_ref']); ?></p>
            <p><?php echo htmlspecialchars($job_row['description']); ?></p>
            <p>
                <img src="images/money_graphic.png" alt="money graphic" class="moneygraphic" loading="lazy">
                &nbsp;&nbsp;<?php echo htmlspecialchars($job_row['salary']); ?>
            </p>

            <div class="container">
                <div>
                    <p>REPORTING LINE</p>
                    <ol>
                        <?php foreach (split_list($job_row['reporting_line']) as $list_item): ?>
                            <li><?php echo htmlspecialchars($list_item); ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
                <div>
                    <p>KEY RESPONSIBILITIES</p>
                    <ul>
                        <?php foreach (split_list($job_row['key_responsibilities']) as $list_item): ?>
                            <li><?php echo htmlspecialchars($list_item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <p>ESSENTIAL REQUIREMENTS</p>
                    <ul>
                        <?php foreach (split_list($job_row['essential_requirements']) as $list_item): ?>
                            <li><?php echo htmlspecialchars($list_item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="end">
                    <p>PREFERRED REQUIREMENTS</p>
                    <ul>
                        <?php foreach (split_list($job_row['preferred_requirements']) as $list_item): ?>
                            <li><?php echo htmlspecialchars($list_item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <aside class="applyhere">
                <a href="apply.php?job_ref=<?php echo urlencode($job_row['job_ref']); ?>">APPLY HERE</a>
            </aside>
        </fieldset>
    </section>

    <?php endforeach; endif; ?>

    <?php include 'footer.inc'; ?>

</body>
</html>