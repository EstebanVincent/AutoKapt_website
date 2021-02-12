<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once 'dataBaseHeader.inc.php';
    require_once 'functions.inc.php';

    logInUser($conn, $username, $password);

} else {
    header("location: ../pages/logIn/logIn.php");
    exit();
}