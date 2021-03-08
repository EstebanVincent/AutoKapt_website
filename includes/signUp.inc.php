<?php

if (isset($_POST["signUpManager-submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];

    $username = $_POST["username"];
    $password = $_POST["password"];
    $pwdRepeat = $_POST["password-repeat"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];

    require_once 'dataBaseHandler.inc.php';
    require_once 'functions.inc.php';

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

    
    createUser($conn, $username, $email, $password, $gender, $age, "1");
}

else if (isset($_POST["signUpUser-submit"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $pwdRepeat = $_POST["pwdRepeat"];
  $gender = $_POST["gender"];
  $age = $_POST["age"];

  require_once '../dataBaseHandler.inc.php';
  require_once '../functions.inc.php';

  if (!pwdMatch($password, $pwdRepeat)){
      die(header("location: ../../pages/logIn/signUp.php/?error=pwdsdontmatch"));
  }
  if (usernameExists($conn, $username, $email) !== false){
      die(header("location: ../../pages/logIn/signUp.php/?error=usernameoremailtaken"));
  }
  if (!pwdLongEnough($password)){
      die(header("location: ../../pages/logIn/signUp.php/?error=password<8char"));
  }
  createUser($conn, $username, $email, $password, $gender, $age);

}
else {
    die(header("location: ../../pages/logIn/signUp.php"));
}