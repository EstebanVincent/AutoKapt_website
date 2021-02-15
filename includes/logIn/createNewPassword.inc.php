<?php

if(isset($_POST["createNewPassword-submit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    if ($password != $passwordRepeat){
        header("location: ../pages/logIn/createNewPassword.php?newPassword=pwdnotsame");
        exit();
    }

    /* date à l'instant t */
    $currentDate = date("U");

    require_once '../dataBaseHandler.inc.php';

    /* On selectionne tout de la ligne de la bdd pwdreset qui contient le selector ET dont la date d'expiration est supérieur à l'insatant t */
    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;";
    $stmt = mysqli_stmt_init($conn);

    /* on test si la communication avec la bdd est possible */
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        /* on remplace dans $sql par les variables donné au lieu de ? */
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        /* on execute le stmt */
        mysqli_stmt_execute($stmt);

        /* on recupere le résultat */
        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)){ /* transforme le résultat en array */
            echo "u need to re-submit your reset request";
            exit();
        } else  {
            /* le token validator est passé en binaire */
            $tokenBin = hex2bin($validator); 
            /* booleen qui check si le token de l'url est le meme que celui de la bdd */
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]); 

            if($tokenCheck === false) {
                echo "u need to re-submit your reset request";
                exit();
            } elseif ($tokenCheck === true){
                /* on recupere la valeur de l'email dans ma bdd pwdreset */
                $tokenEmail = $row["pwdResetEmail"];

                /* on selectionne tout de la ligne de la bdd users qui contient le mail donné */
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
                        /* on change dans la bdd users le mdp de la ligne qui contient le mail donné */
                        $sql = "UPDATE users SET usersPassword=? WHERE usersEmail=?;";
                        $stmt = mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "error";
                            exit();
                        } else {
                            $newPasswordHashed = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPasswordHashed, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            /* on supprime de la bdd pwdreset la ligne qui pontient le mail donné */
                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "error 2";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("location: ../../pages/logIn/logIn.php?newPassword=passwordupdated");
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