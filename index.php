<?php
session_start();

if(isset($_COOKIE["remember_me"])){
    $_SESSION["loggedin"] = true;
    $_SESSION["email"]=$_COOKIE["email"];
    if(isset($_COOKIE["is_admin"])){
        $_SESSION["is_admin"] = true;
    }
}

$requestUri=$_SERVER["REQUEST_URI"];
$newRequestUri = str_replace("/website", "", $requestUri);

switch ($newRequestUri) {
    case '/':
        include"home.php";
        break;
    case '/register':
        include"register.php";
        break;
    case '/login':
        include"login.php";
        break;
    case '/logout':
        include"logout.php";
        break;
    case '/admin':
        include"admin.php";
        break;
    default:
        include"not_found.php";
        break;
}