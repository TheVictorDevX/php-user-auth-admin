<?php
    if(!isset($_SESSION["loggedin"])){
        header("Location: http://localhost/website/login");
    }
    if($_SESSION["is_admin"] == FALSE){
        header("Location: http://localhost/website/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>You have logged in!</h1>
    <h2>You are an admin!</h2>
    <p><?php echo "your email is: {$_SESSION["email"]}" ?></p>
    <a href="/website/logout">Logout Now!</a>
</body>
</html>