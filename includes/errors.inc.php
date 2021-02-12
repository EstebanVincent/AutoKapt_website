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
?>