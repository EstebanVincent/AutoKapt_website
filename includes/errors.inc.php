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
    if($_GET["error"] == "wrongLogIn"){
        echo"<p>Inexistent username!</p>";
    }
    if($_GET["error"] == "wrongPassword"){
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
}

?>