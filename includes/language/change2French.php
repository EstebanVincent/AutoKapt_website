<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
/* on enleve la query avant de rediriger afin d'éviter d'avoir plusieurs query */
$url = $_SERVER['HTTP_REFERER'];
$bool = strpos($url,'?');

if($bool){
    die(header("location: " . $url . "&lang=fr"));
} else {
    die(header("location: " . $url . "?lang=fr"));
}
?>