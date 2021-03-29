<?php

if (isset($_POST["addQuestion-submit"])){
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    require_once '../dataBaseHandler.inc.php';
    require_once '../functions.inc.php';

    addQuestionFAQ($conn, $question, $answer);
}
else if (isset($_POST["modifyQuestion-submit"])){
    $newQuestion = $_POST["newQuestion"];
    $newAnswer = $_POST["newAnswer"];
    $faqId = $_POST["faqId"];

    require_once '../dataBaseHandler.inc.php';
    require_once '../functions.inc.php';

    modifyQuestionFAQ($conn, $faqId, $newQuestion, $newAnswer);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=bite');
    exit();
}