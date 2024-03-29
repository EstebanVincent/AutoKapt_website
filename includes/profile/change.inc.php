<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
/* Change password */
if(isset($_POST["change-password-submit"])){
  $currentPassword = $_POST["verifyPassword"];
  $newPassword = $_POST["newPassword"];
  $verifyNewPassword = $_POST["verifyNewPassword"];

  require_once __ROOT__.'Model/functions.inc.php';

  if (!pwdMatch($newPassword, $verifyNewPassword)){
    die(header("location: ". HTTP_SERVER ."View/profile/myProfile.php/?error=".$newPassword.$verifyNewPassword));
  }
  if (!pwdLongEnough($newPassword)){
    die(header("location: ". HTTP_SERVER ."View/profile/myProfile.php/?error=password<8char"));
  }
  changePassword($conn, $currentPassword, $newPassword);

} 

/* Change username */
else if(isset($_POST["change-username-submit"])){
  $verifyPassword = $_POST["verifyPassword"];
  $newUsername = $_POST["newUsername"];
  $verifyNewUsername = $_POST["verifyNewUsername"];

  require_once __ROOT__.'Model/functions.inc.php';

  if (!pwdMatch($newUsername, $verifyNewUsername)){
    die(header("location: ". HTTP_SERVER ."View/profile/myProfile.php/?error=usernamesdontmatch"));
  }
  changeUsername($conn, $verifyPassword, $newUsername);

} 

/* Change email */
else if(isset($_POST["change-email-submit"])){
  $verifyPassword = $_POST["verifyPassword"];
  $newEmail = $_POST["newEmail"];
  $verifyNewEmail = $_POST["verifyNewEmail"];

  require_once __ROOT__.'Model/functions.inc.php';

  if (!pwdMatch($newEmail, $verifyNewEmail)){
    die(header("location: ". HTTP_SERVER ."View/profile/myProfile.php/?error=emailsdontmatch"));
  }
  changeEmail($conn, $verifyPassword, $newEmail);

} else {
  die(header("location: ". HTTP_SERVER ." View/profile/myProfile.php"));

}

