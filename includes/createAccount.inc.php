<?php
if(isset($_POST["createManager-submit"])){
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    require_once 'dataBaseHandler.inc.php';
    require_once 'functions.inc.php';

    createManagerEmail($conn, $selector, $token);

} 
else if(isset($_POST["createUser-submit"])){
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    require_once 'dataBaseHandler.inc.php';
    require_once 'functions.inc.php';

    createUserEmail($conn, $selector, $token);
} 
else {
  die(header("location: ../../home.php"));
}