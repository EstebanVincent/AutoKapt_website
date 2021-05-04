<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'includes/functions.inc.php';

//--->get all users > start
if(isset($_GET['call_type']) && $_GET['call_type'] =="get_users")
{
	$sql = "SELECT * FROM users WHERE usersEmail NOT LIKE '%@bot.fr' ORDER BY usersAccess;";
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
	echo json_encode($allUsers);
}
//--->get all users > end

if(isset($_POST["search-submit"]))
{
    $likeUsername = $_POST["likeUsername"];

    $sql = "SELECT * FROM users WHERE usersEmail NOT LIKE '%@bot.fr' AND usersUsername LIKE '%". $likeUsername ."%' ORDER BY usersAccess;";
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
        $success = mysqli_stmt_execute($stmt);
        $error = mysqli_stmt_error($stmt);
        if (!$success) {
            echo json_encode(array(
                'status' => 'error', 
                'msg' => 'requete refusé par database : '. $error, 
            ));
            die();
        }
    }

    $result = mysqli_stmt_get_result($stmt);
    $results = resultToArray($result);
	
    $sql = "UPDATE users SET usersUsername=?, usersEmail=?, usersGender=?, usersBirth=?, usersAccess=? WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ssssii", $username, $email, $gender, $birth, $access, $id);
        $success = mysqli_stmt_execute($stmt);
        $error = mysqli_stmt_error($stmt);
    }	
    if($success){
        echo json_encode(array(
            'status' => 'success', 
            'msg' => 'Successfully updated selected row', 
        ));
        die();
    } else {
        echo json_encode(array(
            'status' => 'success', 
            'msg' => 'requete refusé par database : '. $error, 
        ));
        die();
    }
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
    $success = mysqli_stmt_execute($stmt);
    $error = mysqli_stmt_error($stmt);
	
    if($success){
        echo json_encode(array(
            'status' => 'success', 
            'msg' => 'Successfully deleted selected row', 
        ));
        die();
    } else {
        echo json_encode(array(
            'status' => 'success', 
            'msg' => 'requete refusé par database : '. $error, 
        ));
        die();
    }
}
//--->delete row entry  > end