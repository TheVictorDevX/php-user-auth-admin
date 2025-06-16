<?php
if(!isset($_SESSION["loggedin"])){
    header("Location: http://localhost/website/login");
}else{
    session_destroy();
    setcookie("remember_me","",-1);
    setcookie("remember_me_time","",-1);
    setcookie("email","",-1);
    if(isset($_SESSION["is_admin"])){
        setcookie("is_admin","",-1);
    }
    header("Location: http://localhost/website/login");
}