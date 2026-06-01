<?php
session_start();
require_once("settings.php");
$conn = mysqli_connect($host, $user, $password, $database);

$eoi_result = mysqli_query($conn, "SELECT * FROM eoi");
$eois = mysqli_fetch_all($eoi_result, MYSQLI_ASSOC);

// Check if user is logged in, if not then redirect back to login page
if (empty($_SESSION['user'])) {
    header("Location: loginpage.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: loginpage.php");
    exit();
}

if (isset($_POST['delete_job_ref'])) {
    $job_ref = $_POST['job_ref'];
    $stmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE job_ref = ?");
    mysqli_stmt_bind_param($stmt, "s", $job_ref);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if (isset($_POST['change_status'], $_POST['eoi_id'], $_POST['new_status'])) {
    $eoi_id = $_POST['eoi_id'];
    $new_status = $_POST['new_status'];
    $status_query = "UPDATE eoi SET status = '$new_status' WHERE EOInumber = $eoi_id";
    $status_result = mysqli_query($conn, $status_query);
}

if (isset($_POST['sort_submit'], $_POST['sort_method'], $_POST['filter'])) {
    $allowed_columns = ['EOInumber', 'job_ref', 'first_name', 'last_name', 'email', 'phone', 'gender', 'street', 'suburb', 'state', 'postcode', 'skills'];
    
    $sort_method = $_POST['sort_method'];
    $filter = mysqli_real_escape_string($conn, $_POST['filter']);

   if (in_array($sort_method, $allowed_columns)) {
        $eoi_result = mysqli_query($conn, "SELECT * FROM eoi WHERE $sort_method LIKE '%$filter%'");
        $eois = mysqli_fetch_all($eoi_result, MYSQLI_ASSOC); // overwrites the original $eois
    }
}

if (isset($_POST['list_by_name'])) {
    $filter = $_POST['list_name_choice'];

    if ($filter == 'first_name'):
        $query = "SELECT * FROM eoi ORDER BY first_name ASC";
    elseif ($filter == 'last_name'):
        $query = "SELECT * FROM eoi ORDER BY last_name ASC";
    else:
        $query = "SELECT * FROM eoi ORDER BY last_name ASC, first_name ASC";
    endif;
    $eoi_result = mysqli_query($conn, $query);
    $eois = mysqli_fetch_all($eoi_result, MYSQLI_ASSOC);
}

if (isset($_POST['list_by_job_ref'])) {
    $query = "SELECT * FROM eoi ORDER BY job_ref ASC";
    $eoi_result = mysqli_query($conn, $query);
    $eois = mysqli_fetch_all($eoi_result, MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <?php include "header.inc"; ?>
        <style>
            header {
                background-image: url('images/purple_banner.jpg');
                background-size: cover;
                background-position: center;
            }
            #login {
                font-size: large;
                color: #d4a017;
                background-color: #2d1b4e;
                border-radius: 10px;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="images/cartx_logo.png" alt="CartX company logo">
            <h1>CartX</h1>
            <p class="slogan">Manager Dashboard</p>
        </header>
        <nav>
            <p class="menu"><a href="index.php">Home</a></p>
            <p class="menu"><a href="jobs.php">Jobs</a></p>
            <p class="menu"><a href="apply.php">Apply</a></p>
            <p class="menu"><a href="about.php">About Us</a></p>
            <p class="menu" style="float: right;"><a href="manage.php?logout=true">Logout</a></p>
        </nav>
        <br>

        <h2>List Options</h2>

        <h3>List All </h3>
        <form method="POST">
            List All:
            <input type ="submit" name="list_all" value="List All">
        </form>

        <h3>List by Name</h3>
        <form method="POST">
            List by: 
            <select name = "list_name_choice">
                <option value= "first_name">First Name</option>
                <option value="last_name">Last Name</option>
                <option value="last_name ASC, first_name">Both</option>
            </select>
            <input type="submit" name="list_by_name" value="List by Name">
        </form>

        <h3>List by Job Reference</h3>
        <form method="POST">
            List by:
            <input type="submit" name="list_by_job_ref" value="List by Job Reference">
        </form>

        <br>
        <h2>Sort EOI's</h2>
        <form method = "POST">
            Sort Method:
            <select name = "sort_method">
                <option value="EOInumber">EOI ID</option>
                <option value="job_ref">Job Reference</option>
                <option value="first_name">First Name</option>
                <option value="last_name">Last Name</option>
                <option value="email">Email</option>
                <option value="phone">Phone</option>
                <option value="gender">Gender</option>
                <option value="street">Street</option>
                <option value="suburb">Suburb</option>
                <option value="state">State</option>
                <option value="postcode">Postcode</option>
                <option value="skills">Skills</option>
            </select>
            by
            <input type="text" name="filter">
            <input type="submit" name="sort_submit" value="Sort">
        </form>
        <br>

        <h2>Delete All EOI's by Job Reference</h2>
        <form method="POST">
            Job Reference: <input type = "text" name = "job_ref" pattern = "[A-Za-z0-9]{5}" required>
            <input type="submit" name = "delete_job_ref" value="Delete">
        </form>
        <br>

        <?php if (!empty($eois)): ?>
            <h2>EOI List</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Job Ref</th>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Street</th>
                    <th>Suburb</th>
                    <th>State</th>
                    <th>Postcode</th>
                    <th>Skills</th>
                    <th>Other Skills</th>
                    <th>Status</th>
                    <th>Change Status</th>
                </tr>
                <?php foreach ($eois as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['EOInumber']); ?></td>
                    <td><?= htmlspecialchars($row['job_ref']); ?></td>
                    <td><?= htmlspecialchars($row['first_name']); ?></td>
                    <td><?= htmlspecialchars($row['last_name']); ?></td>
                    <td><?= htmlspecialchars($row['dob']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['phone']); ?></td>
                    <td><?= htmlspecialchars($row['gender']); ?></td>
                    <td><?= htmlspecialchars($row['street']); ?></td>
                    <td><?= htmlspecialchars($row['suburb']); ?></td>
                    <td><?= htmlspecialchars($row['state']); ?></td>
                    <td><?= htmlspecialchars($row['postcode']); ?></td>
                    <td><?= htmlspecialchars($row['skills']); ?></td>
                    <td><?= htmlspecialchars($row['other_skills']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="eoi_id" value="<?=  $row['EOInumber'] ?>">
                            <select name="new_status">
                                <option value="New">New</option>
                                <option value="Current">Current</option>
                                <option value="Final">Final</option>
                            </select>
                            <input type="submit" name="change_status" value="Update">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No EOI's found<p>
            <?php print_r($eois); ?>
        <?php endif; ?>
    </body>
    <footer>
        <?php include "footer.inc"; ?>
    </footer>

</html>