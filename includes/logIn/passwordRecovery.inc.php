<?php

if(isset($_POST["password-recovery-submit"])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    require_once '../dataBaseHandler.inc.php';
    require_once '../functions.inc.php';

    passwordRecoveryEmail($conn, $selector, $token);
} else {
    die(header("location: ../../home.php"));
}