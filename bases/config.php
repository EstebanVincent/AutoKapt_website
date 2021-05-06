<?php
/* fichier inclut dans tout les fichiers php
il est inclu de base dans head
lui même inclu dans header

donc l'inclure dans les fichiers includes car head et header pas appelé dans ce dossier
en gros les fichiers en background

Il définit l'absolute path, le path serveur, la connection avec la base de donnée et initialise la session */


    /* on défini les constantes */
    define('__ROOT__',$_SERVER['DOCUMENT_ROOT'].'/AutoKapt/');
    define('SERVER_NAME', $_SERVER['HTTP_HOST']);
    define('WEBSITE_NAME',"AutoKapt");  
    define('HTTP_SERVER', '//' . SERVER_NAME . '/' . WEBSITE_NAME . '/');

    /* connection avec la base de donnée */
    $dBServer = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "autokapt";  

    $conn = mysqli_connect($dBServer, $dBUsername, $dBPassword, $dBName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    /* start la session */
    session_start();

    /* on défini la langue */
    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "fr";
    else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])){
        if ($_GET['lang'] == "fr")
            $_SESSION['lang'] = "fr";
        else if ($_GET['lang'] == "en")
        $_SESSION['lang'] = "en";
    }

    require_once __ROOT__.'languages/' . $_SESSION['lang'] . '.php';
?>