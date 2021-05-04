<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'includes/functions.inc.php';

if(isset($_POST["search-submit"])){
    $likeUsername = $_POST["likeUsername"];
    $array = array('username' => $likeUsername);
    
    die(header('Location: ' . HTTP_SERVER.'pages/Admin/modifyUsers.php?search='.serialize($array)));
    
}

if(isset($_POST["see-all-submit"])){   
    die(header('Location: ' . HTTP_SERVER.'pages/Admin/modifyUsers.php'));
}
