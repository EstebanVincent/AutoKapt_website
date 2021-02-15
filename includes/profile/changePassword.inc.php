<?php

if(isset($_POST["change-password-submit"])){
  $currentPassword = $_POST["currentPassword"];
  $newPassword = $_POST["newPassword"];
  $verifyNewPassword = $_POST["verifyNewPassword"];

  require_once '../dataBaseHandler.inc.php';
  require_once '../functions.inc.php';

  if (!pwdMatch($newPassword, $verifyNewPassword)){
    die(header("location: ../../pages/profile/changePassword.php/?error=pwdsdontmatch"));
  }
  if (!pwdLongEnough($newPassword)){
    die(header("location: ../../pages/profile/changePassword.php/?error=password<8char"));
  }
  changePassword($conn, $currentPassword, $newPassword);

} else {
  die(header("location: ../pages/profile/changePassword.php"));

}