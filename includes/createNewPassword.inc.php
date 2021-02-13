<?php

if(isset($_POST["createNewPassword-submit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    if(empty($password) || empty($passwordRepeat)){
        header("location: ../home.php?newPassword=empty");
        exit();
    } elseif ($password != $passwordRepeat){
        header("location: ../home.php?newPassword=pwdnotsame");
        exit();
    }

    $currentDate = sate("U");

    require_once 'dataBaseHandler.inc.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)){
            echo "u need to re-submit your reset request";
            exit();
        } else  {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"];

            if($tokenCheck === false) {
                echo "u need to re-submit your reset request";
                exit();
            } elseif ($tokenCheck === true){

                $tokenEmail = $row["pwdResetEmail"];

                $sql = "SELECT * FROM users WHERE usersEmail=?;";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "error";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(!$row = mysqli_fetch_assoc($result)){
                        echo "was error";
                        exit();
                    } else {
                        $sql = "UPDATE users SET usersPassword=? WHERE usersEmail=?;";
                        $stmt = mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "error";
                            exit();
                        } else {
                            $newPasswordHashed = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPasswordHashed, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "error 2";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("location: ../pages/logIn/logIn.php?newPassword=passwordupdated");
                            }

                        }
                    }
                }
            }
        }
    }


} else {
    header("location: ../home.php");
    exit();
}