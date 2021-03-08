<?php
if(isset($_GET["error"])) {
    if($_GET["error"] == "pwdsdontmatch"){
        echo"<p>Passwords don't match!</p>";
    }
    if($_GET["error"] == "emailsdontmatch"){
        echo"<p>Emails don't match!</p>";
    }
    if($_GET["error"] == "usernamesdontmatch"){
        echo"<p>Usernames don't match!</p>";
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
}
if(isset($_GET["mail"])) {
    if($_GET["mail"] == "manager-sent"){
        echo"<p>Email sent to new Manager!</p>";
    }
    if($_GET["mail"] == "user-sent"){
        echo"<p>Email sent to new User!</p>";
    }
}

?>