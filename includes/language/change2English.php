<?php
/* on enleve la query avant de rediriger afin d'éviter d'avoir plusieurs query */
$bits = explode('?',$_SERVER['HTTP_REFERER']);
$redirect = $bits[0];
echo $redirect;

die(header("location: " . $redirect . "?lang=en"));
?>