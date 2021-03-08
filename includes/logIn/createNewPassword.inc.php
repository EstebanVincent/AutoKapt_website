<?php

if (isset($_POST["createNewPassword-submit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    require_once '../dataBaseHandler.inc.php';
    require_once '../functions.inc.php';

    if (!pwdMatch($password, $passwordRepeat)){
        /* l'url précédent, on concerve ainsi les tokens */
        die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=pwdsdontmatch'));
    }
    if (!pwdLongEnough($password)){
        /* l'url précédent, on concerve ainsi les tokens */
        die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=password<8char'));
    }

    changePasswordFromEmail($conn, $selector, $validator, $password, $passwordRepeat);
    
} else {
    header("location: ../../home.php?error=bite");
    exit();
}