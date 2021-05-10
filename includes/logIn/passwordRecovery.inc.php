<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
if(isset($_POST["password-recovery-submit"])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);


    require_once __ROOT__.'includes/functions.inc.php';

    passwordRecoveryEmail($conn, $selector, $token);
} else {
    die(header("location: ". HTTP_SERVER ."home.php"));
}