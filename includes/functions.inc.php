<?php
session_start();
/* return true si match false sinon */
function pwdMatch($password, $pwdRepeat) {
    $result;
    if($password !== $pwdRepeat){
        $result =false;
    } else {
        $result = true;
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
/* return true si assez long false sinon */
function pwdLongEnough($password) {
    $result;
    if(strlen($password) < 8){
        $result =false;
    } 
    else {
        $result = true;
    }
    return $result;
}
function createUser($conn, $username, $email, $password, $gender, $age) {
    $sql = "INSERT INTO users (usersUsername, usersEmail, usersPassword, usersGender, usersAge) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        die(header("location: ../../pages/logIn/signUp.php/?error=stmtfailed"));
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashedPassword , $gender, $age);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    die(header("location: ../../home.php/?error=accountcreationsuccess"));
}
function logInUser($conn, $username, $password){
    $usernameExists = usernameExists($conn, $username, $username);/* 2 fois car comme ça check pas mail */
    if($usernameExists === false){
        die(header("location: ../../pages/logIn/logIn.php/?error=wronglogin"));
    }
    $passwordHashed =  $usernameExists["usersPassword"];
    $checkPassword = password_verify($password, $passwordHashed);

    if (!$checkPassword){
        die(header("location: ../../pages/logIn/logIn.php/?error=wrongpassword"));
    } else if ($checkPassword === true){
        session_start();
        $_SESSION["userId"] = $usernameExists["usersId"];
        $_SESSION["userUsername"] = $usernameExists["usersUsername"];
        die(header("location: ../../home.php/?error=loginSuccess"));
    }
}
function changePassword($conn, $currentPassword, $newPassword){
    $sessionId = $_SESSION["userId"];
    $sql = "SELECT usersPassword FROM users WHERE usersId=?;";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../?error=stmtfailed");/* pour les erreurs apres */
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "i", $sessionId);
    mysqli_stmt_execute($stmt);  

    $result =mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $currentPasswordHashed = $row["usersPassword"];
    $checkPassword = password_verify($currentPassword, $currentPasswordHashed);

    if (!$checkPassword){
        die(header("location: ../../pages/profile/changePassword.php/?error=wrongpassword"));
    } else if ($checkPassword === true) {
        $sql = "UPDATE users SET usersPassword=? WHERE usersId=?;";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../?error=stmtfailed");/* pour les erreurs apres */
        exit(); 
    }
    $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "si", $newPasswordHashed, $sessionId);
    mysqli_stmt_execute($stmt);  

    die(header("location: ../../pages/profile/myProfile.php/?error=updatepasswordsuccess"));
    }
}