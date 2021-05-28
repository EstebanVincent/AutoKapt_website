<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
    session_unset();
    session_destroy();
    header("location: ". HTTP_SERVER ."home.php/?error=logOutSuccess");
    exit();