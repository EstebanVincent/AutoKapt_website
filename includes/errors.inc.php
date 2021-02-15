<?php
if(isset($_GET["error"])) {
    if($_GET["error"] == "pwdsdontmatch"){
        echo"<p>Passwords don't match!</p>";
    }
    if($_GET["error"] == "usernameoremailtaken"){
        echo"<p>Username or Email already taken!</p>";
    }
    if($_GET["error"] == "password<8char"){
        echo"<p>Password must be over 8 characters!</p>";
    }
    if($_GET["error"] == "wronglogin"){
        echo"<p>Inexistent username!</p>";
    }
    if($_GET["error"] == "wrongpassword"){
        echo"<p>Wrong password!</p>";
    }
}
if(isset($_GET["reset"])) {
    if($_GET["reset"] == "success"){
        echo"<p>Check your e-mail!</p>";
    }
}
if(isset($_GET["newPassword"])) {
    if($_GET["newPassword"] == "passwordupdated"){
        echo"<p>Your password has been reset!</p>";
    }
    if($_GET["newPassword"] == "pwdnotsame"){
        echo"<p>Passwords are different!</p>";
    }
}

?>