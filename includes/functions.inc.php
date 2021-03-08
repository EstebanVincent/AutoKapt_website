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
/* verifie si l'username et l'email de sont pas déja dans la bdd users */
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


/* crée l'user dans la bdd users */
function createUser($conn, $username, $email, $password, $gender, $age, $access) {
    $sql = "INSERT INTO users (usersUsername, usersEmail, usersPassword, usersGender, usersAge, usersAccess) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        die(header("location: ../../pages/logIn/signUp.php/?error=stmtfailed"));
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssii", $username, $email, $hashedPassword , $gender, $age, $access);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    die(header("location: ../home.php/?error=accountcreationsuccess"));
}


/* session start et on fixe les valeurs SESSION userId et userUsername */
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
        $_SESSION["userAccess"] = $usernameExists["usersAccess"];
        die(header("location: ../../home.php/?error=loginSuccess"));
    }
}


/* send le mail a l'adresse donné, les token sont concerver dans la bbd pwdreset avec un temps d'expiration de 30 min*/
function passwordRecoveryEmail($conn, $selector, $token){
    $url = "localhost/AutoKapt/pages/logIn/createNewPassword.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    require_once '../dataBaseHandler.inc.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }


    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    $subject = "Reset your password for AutoKapt";

    $message = '<p>We received a password reset request. The link to reset your password is below.
    If you did not make this request, you can ignore this email</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: AutoKapt <AutoKapt@gmail.com>\r\n";
    $headers .= "Reply-To: AutoKapt@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
    header("location: ../../pages/logIn/passwordRecovery.php?reset=success");
}
/* correspond au forget password en cliquant sur le lien du mail, donc utilisation de token pour eviter le hack, utilise les bdd users et pwdreset*/
function changePasswordFromEmail($conn, $selector, $validator, $password, $passwordRepeat){
    /* date à l'instant t */
    $currentDate = date("U");

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
}


/* deja dans le compte et verification du mdp donc deja secure */
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

        die(header("location: ../../pages/profile/myProfile.php/?change=updatepasswordsuccess"));
    }
}
/* same et on change la valeur de l'username de la session en plus */
function changeUsername($conn, $verifyPassword, $newUsername) {
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
    $checkPassword = password_verify($verifyPassword, $currentPasswordHashed);

    if (!$checkPassword){
        die(header("location: ../../pages/profile/changePassword.php/?error=wrongpassword"));
    } else if ($checkPassword === true) {
        $sql = "UPDATE users SET usersUsername=? WHERE usersId=?;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../?error=stmtfailed");/* pour les erreurs apres */
            exit(); 
        }
        
        mysqli_stmt_bind_param($stmt, "si", $newUsername, $sessionId);
        mysqli_stmt_execute($stmt);  

        $_SESSION["userUsername"] = $newUsername;
        die(header("location: ../../pages/profile/myProfile.php/?change=updateusernamesuccess"));
    }
}
/* same et peut être faire une confirmation par mail jsp ca a l'air compliqué */
function changeEmail($conn, $verifyPassword, $newEmail) {
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
    $checkPassword = password_verify($verifyPassword, $currentPasswordHashed);

    if (!$checkPassword){
        die(header("location: ../../pages/profile/changePassword.php/?change=wrongpassword"));
    } else if ($checkPassword === true) {
        $sql = "UPDATE users SET usersEmail=? WHERE usersId=?;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../?error=stmtfailed");/* pour les erreurs apres */
            exit(); 
        }
        
        mysqli_stmt_bind_param($stmt, "si", $newEmail, $sessionId);
        mysqli_stmt_execute($stmt);  

        die(header("location: ../../pages/profile/myProfile.php/?error=updateemailsuccess"));
    }
}


/* send le mail a l'adresse donné, les token sont concerver dans la bbd pwdreset avec un temps d'expiration de 1 semaine*/
function createUserEmail($conn, $selector, $token){
    $url = "localhost/AutoKapt/pages/User/signUpUser.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 604800; /* 1 semaine en secondes */

    /* require_once '../dataBaseHandler.inc.php'; */

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }


    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    $subject = "Create your account for Infinite Mesures";

    $message = '<p>Your Manager created an account for you.
    If you did not make this request, you can ignore this email</p>';
    $message .= '<p>Here is your account creation link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: Infinite Mesures <Infinite_Mesures@gmail.com>\r\n";
    $headers .= "Reply-To: Infinite_Mesures@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?mail=user-sent');
}
/* send le mail a l'adresse donné, les token sont concerver dans la bbd pwdreset avec un temps d'expiration de 1 semaine*/
function createManagerEmail($conn, $selector, $token){
    $url = "localhost/AutoKapt/pages/Manager/signUpManager.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 604800; /* 1 semaine en secondes */

    /* require_once '../dataBaseHandler.inc.php'; */

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }


    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    $subject = "Create your account for Infinite Mesures";

    $message = '<p>The admin created a Manager account for you.
    If you did not make this request, you can ignore this email</p>';
    $message .= '<p>Here is your account creation link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: Infinite Mesures <Infinite_Mesures@gmail.com>\r\n";
    $headers .= "Reply-To: Infinite_Mesures@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?mail=manager-sent');
}


/* return l'email correspondant au selector et token dans bdd resetPwd */
function getEmail($conn, $selector, $validator){
    /* date à l'instant t */
    $currentDate = date("U");

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
                $email = $row["pwdResetEmail"];

                return $email;


                
            }
        }
    }
}
