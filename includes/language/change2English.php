<?php
/* on enleve la query avant de rediriger afin d'éviter d'avoir plusieurs query */
$url = $_SERVER['HTTP_REFERER'];
$bool = str_contains($_SERVER['HTTP_REFERER'],'?');

if($bool){
    die(header("location: " . $url . "&lang=en"));
} else {
    die(header("location: " . $url . "?lang=en"));
}
?>