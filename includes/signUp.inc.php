<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];

    require_once 'dataBaseHeader.inc.php';
    require_once 'functions.inc.php';

    if (pwdMatch($password, $pwdRepeat) !== false){
        header("location: ../pages/logIn/signUp.php/?error=pwdsdontmatch");
        exit(); 
    }
    if (usernameExists($conn, $username, $email) !== false){
        header("location: ../pages/logIn/signUp.php/?error=usernameoremailtaken");
        exit(); 
    }
    /* maybe longueur password > 8 */
    createUser($conn, $username, $email, $password, $gender, $age);

} else {
    /* header("location: ../");
    exit(); */
}