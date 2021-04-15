<?php

    require_once 'includes/dataBaseHandler.inc.php';
    require_once 'includes/functions.inc.php';

    
//--->get all users > start
if(isset($_GET['call_type']) && $_GET['call_type'] =="get")
{
	$sql = "SELECT * FROM users ORDER BY usersAccess;";
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

//--->update a whole row  > start
if(isset($_POST['call_type']) && $_POST['call_type'] =="row_entry")
{	

    $id         = $_POST['row_id'];
	$username   = $_POST['usersUsername'];
    $email 	    = $_POST['usersEmail'];	
    $gender     = $_POST['usersGender'];	
    $birth 	    = $_POST['usersBirth'];	
    $access     = $_POST['usersAccess'];	
	
	$sql = "SELECT * FROM users WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        //no record found in the database
		echo json_encode(array(
			'status' => 'error', 
			'msg' => 'no entries were found', 
		));
		die();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);
    $results = resultToArray($result);
	
    $sql = "UPDATE users SET usersUsername=?, usersEmail=?, usersGender=?, usersBirth=?, usersAccess=? WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        /* echo "error3";
        exit(); */die(header("location: ../../pages/profile/myProfile.php/?change=updatepasswordsuccess"));
    } else {
        mysqli_stmt_bind_param($stmt, "ssssii", $username, $email, $gender, $birth, $access, $id);
        mysqli_stmt_execute($stmt);
    }	
    echo json_encode(array(
        'status' => 'success', 
        'msg' => 'updated row entry', 
    ));
    die();
}
//--->update a whole row > end

//--->delete row entry  > start
if(isset($_POST['call_type']) && $_POST['call_type'] =="delete_row_entry")
{	

	$row_id 	= $_POST['row_id'];	 
	
    $sql = "DELETE FROM users WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
       
		echo json_encode(array(
			'status' => 'error', 
			'msg' => 'invalid request', 
		));
		die();
    }
    mysqli_stmt_bind_param($stmt, "i", $row_id);
    mysqli_stmt_execute($stmt);
    

    echo json_encode(array(
        'status' => 'success', 
        'msg' => 'deleted entry', 
));
    die();
	 
}
//--->delete row entry  > end