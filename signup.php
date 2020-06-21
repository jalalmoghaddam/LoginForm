<?php

if (isset($_POST['save'])) {

    $server = "localhost";
    $username = "jalal";
    $password = "12345";
    $database = "MyData";
    $table = "users";

//connect to server
    $con = new mysqli($server, $username, $password);
    if (!$con) {
        die("Can not connect to server");
    }

    $creatDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $database
          CHARACTER SET utf8 COLLATE utf8_general_ci";

    $db = $con->query($creatDatabaseQuery);
    if (!$db)
        die ("Error in create database");

    $creatTableQuery = "CREATE TABLE IF NOT EXISTS $database.$table
          ( id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(20) NOT NULL,
            lastname VARCHAR(40) NOT NULL,
            username VARCHAR(30) NOT NULL UNIQUE,
            password VARCHAR(30) NOT NULL) ENGINE = InnoDB;";

    $tb = $con->query($creatTableQuery);
    if (!$tb) {
        echo $con->error;
        die ("Error in create table");
    }

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    $insertQuery = "INSERT INTO mydata.users(firstname, lastname, username, password)
                    values ('$fname','$lname','$uname','$pass')";

    $ins = $con->query($insertQuery);
    if($ins){
        echo "Yap";
    }else {
        echo "nop";
        echo $con->error;
    }

    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="signup.css" rel="stylesheet">
</head>

<body>

<div id="signupForm">
    <form method="post" action="signup.php">

        <label for="firstname"> FirstName</label>
        <input type="text" name="firstname" placeholder="james" id="firstname">

        <label for="lastname"> LastName</label>
        <input type="text" name="lastname" placeholder="gordon" id="lastname">
        <br> <br>

        <label for="username"> UserName</label>
        <input type="text" name="username" placeholder="example" id="username">
        <br>

        <label for="password"> Password </label>
        <input type="password" name="password" id="password">
        <br>

        <input type="submit" name="save" value="Save" id="save">

    </form>
</div>

</body>
</html>