<?php
    define('__ROOT__',$_SERVER['DOCUMENT_ROOT'].'/AutoKapt/');
    define('SERVER_NAME', $_SERVER['HTTP_HOST']);
    define('WEBSITE_NAME',"AutoKapt");  
    define('HTTP_SERVER', '//' . SERVER_NAME . '/' . WEBSITE_NAME . '/');
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "autokapt";  

    $conn = mysqli_connect(SERVER_NAME, $dBUsername, $dBPassword, $dBName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>