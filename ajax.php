<?php

    require_once 'includes/dataBaseHandler.inc.php';
    require_once 'includes/functions.inc.php';

    
//--->get all users > start
if(isset($_GET['call_type']) && $_GET['call_type'] =="get")
{
	$sql = "SELECT * FROM users;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);
    $allUsers = resultToArray($result);
	echo json_encode($allUsers);
}
//--->get all users > end

