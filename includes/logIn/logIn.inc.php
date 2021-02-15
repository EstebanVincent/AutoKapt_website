<?php

if (isset($_POST["logIn-submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once '../dataBaseHandler.inc.php';
    require_once '../functions.inc.php';

    logInUser($conn, $username, $password);

} else {
    die(header("location: ../../pages/logIn/logIn.php"));

}