<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'Model/functions.inc.php';

if(isset($_POST["createManager-submit"])){
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    createManagerEmail($conn, $selector, $token);

} 
else if(isset($_POST["createUser-submit"])){
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    createUserEmail($conn, $selector, $token);
} 
else {
  die(header("location: ". HTTP_SERVER ."home.php"));
}