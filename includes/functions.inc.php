<?php
function pwdMatch($password, $pwdRepeat) {
    $result;
    if($password !== $pwdRepeat){
        $result =true;
    } else {
        $result = false;
    }
    return $result;
}
function usernameExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../?error=stmtfailed");/* pour les erreurs apres */
        exit(); 
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function createUser($conn, $username, $email, $password, $gender, $age) {
    $sql = "INSERT INTO users (usersUsername, usersEmail, usersPassword, usersGender, usersAge) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../pages/logIn/signUp.php/?error=stmtfailed");/* pour les erreurs apres */
        exit(); 
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashedPassword, $gender, $age);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../home.php/?error=none");/* pour les erreurs apres */ 
    exit(); 
}