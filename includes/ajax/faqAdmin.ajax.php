<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'Model/functions.inc.php';

//--->get all faq > start
if(isset($_GET['call_type']) && $_GET['call_type'] =="get_faq")
{
	$sql = "SELECT * FROM faq ORDER BY faqLanguage;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        $a = mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    $allFAQ = resultToArray($result);
	echo json_encode($allFAQ);
}
//--->get all faq > end

//--->update a whole row  > start
if(isset($_POST['call_type']) && $_POST['call_type'] =="question_entry")
{	
    $id         = $_POST['row_id'];
	$question   = $_POST['faqQuestion'];
    $answer 	= $_POST['faqAnswer'];	
    $language   = $_POST['faqLanguage'];	
	
	$sql = "SELECT * FROM faq WHERE faqId=?;";
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
	
    $sql = "UPDATE faq SET faqQuestion=?, faqAnswer=?, faqLanguage=? WHERE faqId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sssi", $question, $answer, $language, $id);
        mysqli_stmt_execute($stmt);
    }	
    echo json_encode(array(
        'status' => 'success', 
        'msg' => 'Successfully updated selected row', 
    ));
    die();
}
//--->update a whole row > end

//--->delete row entry  > start
if(isset($_POST['call_type']) && $_POST['call_type'] =="delete_question_entry")
{	

	$row_id 	= $_POST['row_id'];	 
	
    $sql = "DELETE FROM faq WHERE faqId=?;";
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
    if (!$success) {
        echo json_encode(array(
            'status' => 'error', 
            'msg' => 'requete refusé par database : '. $error, 
        ));
        die();
    } else {
        echo json_encode(array(
            'status' => 'success', 
            'msg' => 'Successfully deleted selected row', 
        ));
        die();
    }
	 
}
//--->delete row entry  > end

//--->new row entry  > start
if(isset($_POST['call_type']) && $_POST['call_type'] =="new_question_entry")
{	

	
    $id         = $_POST['row_id'];
	$question   = $_POST['faqQuestion'];
    $answer 	= $_POST['faqAnswer'];	
    $language   = $_POST['faqLanguage'];
	
	$sql = "SELECT * FROM faq WHERE faqId=?;";
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
        $result = mysqli_stmt_get_result($stmt);
        $nb_row = mysqli_num_rows($result);
    }
	if($nb_row == 0) /* signifie que l'id n'est pas deja utilisé */
	{
		$sql = "INSERT INTO faq (faqQuestion, faqAnswer, faqLanguage) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "error3";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $question, $answer, $language);
            $success = mysqli_stmt_execute($stmt);
            $error = mysqli_stmt_error($stmt);
        }	
        if($success){
            echo json_encode(array(
                'status' => 'success', 
                'msg' => 'Successfully added new row', 
            ));
            die();
        } else {
            echo json_encode(array(
                'status' => 'success', 
                'msg' => 'requete refusé par database : '. $error, 
            ));
            die();
        }
		
	} else {
        echo json_encode(array(
			'status' => 'error', 
			'msg' => 'This id is already in use',
		));
		die();
    } 
}
//--->new row entry  > end

//--->get max faq id > start
if(isset($_GET['call_type']) && $_GET['call_type'] =="get_max_faqId")
{
	$sql = "SELECT MAX(faqId)+1 AS id FROM faq;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    $id2Add =  $result->fetch_assoc();
    /* $id2Add = mysql_fetch_assoc($result); */
	/* echo json_encode($allFAQ); */
    echo json_encode($id2Add);
}
//--->get max faq id > end