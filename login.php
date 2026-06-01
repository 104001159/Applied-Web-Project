<?php
    session_start();
    require_once("settings.php");

    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    // Get user input
    $username = trim($_POST['user']);
    $password = trim($_POST['pass']);

    #$password = hash('sha1', $password);
    
    // Prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: manage.php");
        exit();
    } 
    else {
        echo "❌ Incorrect username or password.";
        session_destroy();
        #echo $password;
    }
?>