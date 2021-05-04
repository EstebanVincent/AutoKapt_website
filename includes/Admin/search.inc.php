<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'includes/functions.inc.php';

if(isset($_POST["search-submit"])){
    $likeUsername = $_POST["likeUsername"];
    
    die(header('Location: ' . HTTP_SERVER.'pages/Admin/modifyUsers.php?username=' . $likeUsername));
    
}
if(isset($_POST["adv-search-submit"])){
    $likeUsername = $_POST["likeUsername"];
    $likeEmail = $_POST["likeEmail"];
    $ageMin = $_POST["ageMin"];
    $ageMax = $_POST["ageMax"];
    $gender = $_POST["gender"];
    $access = $_POST["access"];

    $array = array(
        'username' => $likeUsername,
        'email' => $likeEmail,
        'ageMin' => $ageMin,
        'ageMax' => $ageMax,
        'gender' => $gender,
        'access' => $access,
    );
    
    die(header('Location: ' . HTTP_SERVER.'pages/Admin/modifyUsers.php?search='.serialize($array)));
    
}

if(isset($_POST["see-all-submit"])){   
    die(header('Location: ' . HTTP_SERVER.'pages/Admin/modifyUsers.php'));
}
