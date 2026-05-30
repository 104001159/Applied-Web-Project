<?php
session_start();
require_once("settings.php");
$conn = mysqli_connect($host, $user, $pwd, $sql_db);
// Check if the user is logged in, if
// not then redirect them back to the login page
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
    $job_ref = $_POST('job_ref');
    $del_query = "DELETE FROM eoi WHERE job_ref = ?";
    $del_result = mysqli_query($conn, $del_query);
}

if (isset($_POST['change_status'])) {
    $eoi_id = $_POST['EOInumber'];
    $new_status = $_POST['new_status'];
    $status_query = "UPDATE eoi SET status = ? WHERE eoi_id = ?";
    $status_result = mysqli_query($conn, $status_query);
}

$eoi_result = mysqli_query($conn, "SELECT * FROM eoi");
$eois = mysqli_fetch_all($eoi_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <?php include "header.inc"; ?>
        <style>
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
        <?php include "nav.inc"; ?>
        <h1>Manager Dashboard</h1>
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
                            <input type="hidden" name="eoi_id" value="<?php $row['EOInumber'] ?>">
                            <select name="new_status">
                                <option value="New">New</option>
                                <option value="Current">Current</option>
                                <option value="Final">Final</option>
                            </select>
                            <input type="submit" name="change_status" value="update">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No EOI's found<p>
        <?php endif; ?>
    </body>
    <footer>
        <a href="manage.php?logout=true" id="login">Logout</a>
        <?php include "footer.inc"; ?>
    </footer>

</html>
