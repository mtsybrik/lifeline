<?php

require 'Libs/connect.php';
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
// Define $username and $password
        $username=trim(strip_tags($_POST['username']));
        $password=trim($_POST['password']);
// To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($link,$username);
        $password = mysqli_real_escape_string($link,$password);

// SQL query to fetch information of registerd users and finds user match.
        $query = mysqli_query($link,"select * from user where password='$password' AND login='$username'");
        $rows = mysqli_num_rows($query);
        if ($rows == 1) {

            $_SESSION['login_user'] = $username; // Initializing Session
            header("location: index.php"); // Redirecting To Other Page
      } else {
            $error = "Username or Password is invalid";
        }
        mysqli_close($link); // Closing Connection
    }
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="css/main.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<!-- Заголовок сайта -->
<div id="main">
    <form class="box login" method="post">
        <fieldset class="boxBody">
            <input type="text" tabindex="1" placeholder="Username" id="name" name="username" required>
            <input id="password" name="password" type="password" tabindex="2" placeholder="Password" required>
            <a href="#" class="rLink" tabindex="5">Forget your password?</a>
        </fieldset>
        <footer>
            <label><input type="checkbox" tabindex="3">Keep me logged in</label>
            <input type="submit" class="btnLogin" name="submit" value="Login" tabindex="4">
        </footer>
        <span><?php echo $error; ?></span>
    </form>
</div>
<!-- Конец основного раздела сайта -->
<!-- Футер сайта -->
<div id="footer">

</div>
<!-- Конец футера -->
</body>
</html>