<?php
    session_start();
    require_once("settings.php");

    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    // Get user input
    $username = trim($_POST['user']);
    $password = trim($_POST['pass']);

    #$password = hash('sha1', $password);
    
    // Simple query to check credentials
    $query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user'] = $user;
        var_dump($_SESSION);
        header("Location: manage.php");
        exit();
    } 
    else {
        echo "❌ Incorrect username or password.";
        session_destroy();
        #echo $password;
    }
?>
