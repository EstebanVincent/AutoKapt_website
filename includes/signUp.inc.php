<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'includes/functions.inc.php';

if (isset($_POST["signUpManager-submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];

    $username = $_POST["username"];
    $password = $_POST["password"];
    $pwdRepeat = $_POST["password-repeat"];
    $gender = $_POST["gender"];
    $birth = $_POST["birth"];

    $email = getEmail($conn, $selector, $validator);
    $a = pwdMatch($password, $pwdRepeat);

    if (!pwdMatch($password, $pwdRepeat)){
        die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=pwdsdontmatch'.$a.''));
    }
    if (usernameExists($conn, $username, $email) !== false){
        die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=usernameoremailtaken'));
    }
    if (!pwdLongEnough($password)){
        die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=password<8char'));
    }

    
    createUser($conn, $username, $email, $password, $gender, $birth, 1);
}

else if (isset($_POST["signUpUser-submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $pwdRepeat = $_POST["password-repeat"];
    $gender = $_POST["gender"];
    $birth = $_POST["birth"];

  $email = getEmail($conn, $selector, $validator);


  if (!pwdMatch($password, $pwdRepeat)){
      die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=pwdsdontmatch'));
  }
  if (usernameExists($conn, $username, $email) !== false){
      die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=usernameoremailtaken'));
  }
  if (!pwdLongEnough($password)){
      die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=password<8char'));
  }

  
  createUser($conn, $username, $email, $password, $gender, $birth, 2);
}
else {
    die(header("location: ". HTTP_SERVER ."pages/logIn/signUp.php"));
}