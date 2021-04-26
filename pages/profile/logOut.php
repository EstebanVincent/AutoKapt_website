<?php
    session_start();
    session_unset();
    session_destroy();
    header("location: ". HTTP_SERVER ."home.php/?error=logOutSuccess");
    exit();