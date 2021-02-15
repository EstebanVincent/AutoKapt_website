<?php

if (isset($_POST["signUp-submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];

    require_once '../dataBaseHandler.inc.php';
    require_once '../functions.inc.php';

    if (!pwdMatch($password, $pwdRepeat)){
        die(header("location: ../../pages/logIn/signUp.php/?error=pwdsdontmatch"));
    }
    if (usernameExists($conn, $username, $email) !== false){
        die(header("location: ../../pages/logIn/signUp.php/?error=usernameoremailtaken"));
    }
    if (!pwdLongEnough($password)){
        die(header("location: ../../pages/logIn/signUp.php/?error=password<8char"));
    }
    createUser($conn, $username, $email, $password, $gender, $age);

} else {
    die(header("location: ../../pages/logIn/signUp.php"));
}