<?php

if(isset($_POST["createNewPassword-submit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    if (!pwdMatch($password, $passwordRepeat)){
        die(header("location: ../../pages/logIn/createNewPassword.php?error=pwdsdontmatch"));
    }
    if (!pwdLongEnough($password)){
        die(header("location: ../../pages/logIn/createNewPassword.php?error=password<8char"));
    }
    

    require_once '../dataBaseHandler.inc.php';
    require_once '../functions.inc.php';

    changePasswordFromEmail($conn, $selector, $validator, $password, $passwordRepeat);
    
} else {
    header("location: ../home.php");
    exit();
}