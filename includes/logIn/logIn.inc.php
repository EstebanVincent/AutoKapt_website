<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');

if (isset($_POST["logIn-submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once __ROOT__.'includes/functions.inc.php';

    logInUser($conn, $username, $password);

} else {
    die(header("location:".__ROOT__."pages/logIn/logIn.php"));

}