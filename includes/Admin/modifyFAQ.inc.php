<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'includes/functions.inc.php';

if (isset($_POST["addQuestion-submit"])){
    $question = $_POST["question"];
    $answer = $_POST["answer"];
    $language = $_POST["language"];

    addQuestionFAQ($conn, $question, $answer, $language);
}
else if (isset($_POST["modifyQuestion-submit"])){
    $newQuestion = $_POST["newQuestion"];
    $newAnswer = $_POST["newAnswer"];
    $faqId = $_POST["faqId"];

    modifyQuestionFAQ($conn, $faqId, $newQuestion, $newAnswer);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=bite');
    exit();
}