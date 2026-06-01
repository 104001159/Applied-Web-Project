<!DOCTYPE html>
<html lang = "en">
<head>
    <?php include 'header.inc'; ?>
    <title>Login Form</title>
    <style>
        header {
            background-image: url('images/purple_banner.jpg');
            background-size: cover;
            background-position: center;
        }
        h1 {
            color: #2d1b4e;
        }
        body {
            background-color: #2d1b4e;
        }
        #form {
            background-color: white;
            width: 40%;
            margin: 120px auto;
            padding: 50px;
            box-shadow: 10px 10px 5px black;
            border-radius: 4px;
        }
        #btn {
            color: white;
            background-color: #2d1b4e;
            padding: 10px;
            font-size: large;
            border-radius: 10px;
        }

        @media screen and (max-width:700px){
            #form {
                width: 65%;
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <?php include "nav.inc"; ?>
    <div id="form">
        <h1>Login to Manager Page</h1>
        <form action =  "login.php" method = "POST" id = "logininfo">
            <label for="user">Username</label>
            <input type = "text" name = "user" id = "user" required><br><br>
            <label for="pass">Password</label>
            <input type = "password" name = "pass" id = "pass" required><br><br>
            <input type = "submit" value = "Log In" id = "btn" name = "submit">
        </form>
    </div>
</body>
<?php include "footer.inc"; ?>

</html>