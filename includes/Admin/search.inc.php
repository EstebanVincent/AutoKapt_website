<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'includes/functions.inc.php';

if(isset($_POST["search-submit"])){
    $likeUsername = $_POST["likeUsername"];

    $sql = "SELECT * FROM users WHERE usersEmail NOT LIKE '%@bot.fr' AND usersUsername LIKE '%". $likeUsername ."%' ORDER BY usersAccess;";
    /* get all users but the bot accounts */
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);
    $allUsers = resultToArray($result);
	$likeUsers = json_encode($allUsers);
}