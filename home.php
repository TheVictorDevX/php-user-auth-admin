<?php
    if(!isset($_SESSION["loggedin"])){
        header("Location: http://localhost/website/login");
    }
    if(isset($_SESSION["is_admin"])){
        header("Location: http://localhost/website/admin");
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
    <p><?php echo "your email is: {$_SESSION["email"]}" ?></p>
    <a href="/website/logout">Logout Now!</a>
</body>
</html>