<?php
    if(isset($_SESSION["loggedin"])){
        header("Location: http://localhost/website/");
    }

    if(isset($_POST["register_new_account"])){
        $email=$_POST["email"];
        $password=$_POST["password"];
        
        if(checkIfUserIsValid($email,$password)){
            addNewUser($email, $password);
        }else{
            echo "user is not valid! <br>";
        }
    }

    function getDatabaseConnection(){
        $host="localhost";
        $dbname="test";
        $username="root";

        $dsn="mysql:host=$host;dbname=$dbname";

        return new PDO($dsn, $username);
    }

    function addNewUser($email, $password){
        $pdo=getDatabaseConnection();
        
        $password=hashPassword($password);

        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);

        $stmt->execute();

        echo "a new user successfully added! <br>";
    }

    function checkDupeEmail($email){
        $pdo=getDatabaseConnection();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $results = $stmt->fetchAll();

        if(count($results) > 0){
            return true;
        }else{
            return false;
        }
    }
    
    function checkEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function checkPassword($password){
        if(empty($password)){
            return false;
        }
        return true;
    }

    function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function checkIfUserIsValid($email, $password){
        $isValidEmail=false;
        $isDupeEmail=true;
        $isValidPassword=false;

        if(checkEmail($email)){
            $isValidEmail=true;
        }else{
            echo "your email is not valid! <br>";
        }

        if(checkDupeEmail($email)){
            echo "your email is already taken! <br>";
        }else{
            $isDupeEmail=false;
        }

        if(checkPassword($password)){
            $isValidPassword=true;
        }else{
            echo "your password can't be empty! <br>";
        }

        if($isValidEmail && $isValidPassword && !$isDupeEmail){
            return true;
        }else{
            return false;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form action="/website/register" method="post">
        <input type="text" placeholder="email" name="email">
        <br>
        <input type="text" placeholder="password" name="password">
        <br>
        <input type="submit" value="Register New Account" name="register_new_account">
    </form>
    already have an account? <a href="/website/login">Login!</a>
    <br>
</body>
</html>
