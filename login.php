<?php
include("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $myusername = mysqli_real_escape_string($conn, $_POST['username']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT id FROM hrteam WHERE Username = '$myusername' and Passcode = '$mypassword'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['login_user'] = $myusername;

        header("location: hr.php");
    } else {
        echo "<script>alert('Incorrect Username or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/28e3060a5c.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="logindiv">
        <a href="index.php"><img class="logo" src="Images/logo.png" alt="Logo"></a>
    </div>
    <div class="loginput">
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete=off required>
            <label for="pword">Password</label>
            <input type="password" name="password" id="pword" required>
            <button type="submit" value="login">Login</button>
        </form>
    </div>

</body>

</html>