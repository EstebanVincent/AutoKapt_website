<!-- 
    fichier inclut dans tout les fichiers php
    il est inclu de base dans head
    lui même inclu dans header

    donc l'inclure dans les fichiers includes car head et header pas appelé dans ce dossier
    en gros les fichiers en background

    Il définit l'absolute path, le path serveur, la connection avec la base de donnée et initialise la session
 -->
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
    session_start();
?>