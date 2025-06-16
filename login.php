<?php
    if(isset($_SESSION["loggedin"])){
        header("Location: http://localhost/website/");
    }
    
    if(isset($_POST["login_now"])){
        $email=$_POST["email"];
        $password=$_POST["password"];
        
        if(checkIfUserIsValid($email,$password)){
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;

            // if(checkIfUserIsAdmin($email)){
            //     $_SESSION["is_admin"] = true;
            //     header("Location: http://localhost/website/admin");
            // }else{
            //     header("Location: http://localhost/website/");
            // }
            if(checkIfUserIsAdmin($email)){
                $_SESSION["is_admin"] = true;
            }
            if(isset($_POST["remember_me"])){
                setcookie("remember_me",true,time()+ 60);
                setcookie("remember_me_time",time()+ 60,time()+ 60);
                setcookie("email",$email,time()+ 60);
                if(isset($_SESSION["is_admin"])){
                    setcookie("is_admin",true,time()+ 60);
                }
            }
            if(isset($_SESSION["is_admin"])){
                header("Location: http://localhost/website/admin");
            }else{
                header("Location: http://localhost/website/");
            }
        }else{
            echo "user account is not valid! <br>";
        }
    }

    function checkIfUserIsAdmin($email){
        $pdo=getDatabaseConnection();

        $sql="SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch();

        if($user["is_admin"] == 1){
            return true;
        }else{
            return false;
        }
    }

    function checkIfUserIsValid($email, $password){
        $isValidEmail=false;
        $isValidPassword=false;
        $isValidAccount=false;

        if(checkEmail($email)){
            $isValidEmail=true;
        }else{
            echo "your email is not valid! <br>";
        }

        if(checkPassword($password)){
            $isValidPassword=true;
        }else{
            echo "your password can't be empty! <br>";
        }

        if($isValidEmail && $isValidPassword){
            if(verifyPassword($email,$password)){
            $isValidAccount=true;
            }else{
                echo "your password is not valid! <br>";
            }
        }

        if($isValidEmail && $isValidPassword && $isValidAccount){
            return true;
        }else{
            return false;
        }
    }

    function getDatabaseConnection(){
        $host="localhost";
        $dbname="test";
        $username="root";

        $dsn="mysql:host=$host;dbname=$dbname";

        return new PDO($dsn, $username);
    }

    function checkEmail($email){
        $pdo=getDatabaseConnection();

        $sql="SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $result = $stmt->fetchAll();

        if(count($result)> 0){
            return true;
        }else{
            return false;
        }
    }

    function verifyPassword($email, $password){
        $pdo=getDatabaseConnection();

        $sql= "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch();
        
        $hashedPassword=$user["password"];
        
        if(password_verify($password,$hashedPassword)){
            return true;
        }else{
            return false;
        }
    }

    function checkPassword($password){
        if(empty($password)){
            return false;
        }
        return true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form action="/website/login" method="post">
        <input type="text" placeholder="email" name="email">
        <br>
        <input type="text" placeholder="password" name="password">
        <br>
        <input type="submit" value="Login Now" name="login_now">
        <br>
        <input id="remember_me" type="checkbox" name="remember_me">
        <label for="remember_me">Remember Me</label>
    </form>
    not yet have an account? <a href="/website/register">Register!</a>
    <br>
</body>
</html>