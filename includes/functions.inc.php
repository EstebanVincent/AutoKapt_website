<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
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
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");/* pour les erreurs apres */
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
function createUser($conn, $username, $email, $password, $gender, $birth, $access) {
    $sql = "INSERT INTO users (usersUsername, usersEmail, usersPassword, usersGender, usersBirth, usersAccess) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        die(header("location: ". HTTP_SERVER ."pages/logIn/signUp.php/?error=stmtfailed"));
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssi", $username, $email, $hashedPassword , $gender, $birth, $access);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    die(header("location:". HTTP_SERVER ."/home.php/?error=accountcreationsuccess"));
}


/* session start et on fixe les valeurs SESSION userId et userUsername */
function logInUser($conn, $username, $password){
    $usernameExists = usernameExists($conn, $username, $username);/* 2 fois car comme ça check pas mail */
    if($usernameExists === false){
        die(header("location:". HTTP_SERVER ."pages/logIn/logIn.php/?error=wronglogin"));
    }
    $passwordHashed =  $usernameExists["usersPassword"];
    $checkPassword = password_verify($password, $passwordHashed);

    if (!$checkPassword){
        die(header("location:". HTTP_SERVER ."pages/logIn/logIn.php/?error=wrongpassword"));
    } else if ($checkPassword === true){
        $_SESSION["userId"] = $usernameExists["usersId"];
        $_SESSION["userUsername"] = $usernameExists["usersUsername"];
        $_SESSION["userAccess"] = $usernameExists["usersAccess"];
        die(header("location:". HTTP_SERVER ."home.php/?error=loginSuccess"));
    }
}


/* send le mail a l'adresse donné, les token sont concerver dans la bbd pwdreset avec un temps d'expiration de 30 min*/
function passwordRecoveryEmail($conn, $selector, $token){
    $url = HTTP_SERVER."pages/logIn/createNewPassword.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

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
    header("location: ". HTTP_SERVER ."pages/logIn/passwordRecovery.php?reset=success");
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
                                header("location: ". HTTP_SERVER ."pages/logIn/logIn.php?newPassword=passwordupdated");
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
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");/* pour les erreurs apres */
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "i", $sessionId);
    mysqli_stmt_execute($stmt);  

    $result =mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $currentPasswordHashed = $row["usersPassword"];
    $checkPassword = password_verify($currentPassword, $currentPasswordHashed);

    if (!$checkPassword){
        die(header("location: ". HTTP_SERVER ."pages/profile/changePassword.php/?error=wrongpassword"));
    } else if ($checkPassword === true) {
        $sql = "UPDATE users SET usersPassword=? WHERE usersId=?;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");/* pour les erreurs apres */
            exit(); 
        }
        $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
        
        mysqli_stmt_bind_param($stmt, "si", $newPasswordHashed, $sessionId);
        mysqli_stmt_execute($stmt);  

        die(header("location: ". HTTP_SERVER ."pages/profile/myProfile.php/?change=updatepasswordsuccess"));
    }
}
/* same et on change la valeur de l'username de la session en plus */
function changeUsername($conn, $verifyPassword, $newUsername) {
    $sessionId = $_SESSION["userId"];
    $sql = "SELECT usersPassword FROM users WHERE usersId=?;";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");/* pour les erreurs apres */
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "i", $sessionId);
    mysqli_stmt_execute($stmt);  

    $result =mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $currentPasswordHashed = $row["usersPassword"];
    $checkPassword = password_verify($verifyPassword, $currentPasswordHashed);

    if (!$checkPassword){
        die(header("location: " . $_SERVER['HTTP_REFERER'] . "?error=wrongpassword"));
    } else if ($checkPassword === true) {
        $sql = "UPDATE users SET usersUsername=? WHERE usersId=?;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");/* pour les erreurs apres */
            exit(); 
        }
        
        mysqli_stmt_bind_param($stmt, "si", $newUsername, $sessionId);
        mysqli_stmt_execute($stmt);  

        $_SESSION["userUsername"] = $newUsername;
        die(header("location: ". HTTP_SERVER ."pages/profile/myProfile.php/?change=updateusernamesuccess"));
    }
}
/* same et peut être faire une confirmation par mail jsp ca a l'air compliqué */
function changeEmail($conn, $verifyPassword, $newEmail) {
    $sessionId = $_SESSION["userId"];
    $sql = "SELECT usersPassword FROM users WHERE usersId=?;";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");/* pour les erreurs apres */
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "i", $sessionId);
    mysqli_stmt_execute($stmt);  

    $result =mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $currentPasswordHashed = $row["usersPassword"];
    $checkPassword = password_verify($verifyPassword, $currentPasswordHashed);

    if (!$checkPassword){
        die(header("location: ". HTTP_SERVER ."pages/profile/changePassword.php/?change=wrongpassword"));
    } else if ($checkPassword === true) {
        $sql = "UPDATE users SET usersEmail=? WHERE usersId=?;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");/* pour les erreurs apres */
            exit(); 
        }
        
        mysqli_stmt_bind_param($stmt, "si", $newEmail, $sessionId);
        $a = mysqli_stmt_execute($stmt);  
        

        die(header("location: ". HTTP_SERVER ."pages/profile/myProfile.php/?error=updatemailsuccess"));
    }
}

/* send le mail a l'adresse donné, les token sont concerver dans la bbd pwdreset avec un temps d'expiration de 1 semaine*/
function createUserEmail($conn, $selector, $token){
    $url = HTTP_SERVER."pages/User/signUpUser.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 604800; /* 1 semaine en secondes */

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
    $url = HTTP_SERVER."pages/Manager/signUpManager.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 604800; /* 1 semaine en secondes */

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

    $headers = "From: Infinite Mesures <Infinite_Measures@gmail.com>\r\n";
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
            echo "Time given for account creation is over";
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

/* Affiche toute les lignes de la FAQ */
function showFAQ($conn, $language){
    $sql = "SELECT * FROM faq WHERE faqLanguage=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $language);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);


    while ($rows = mysqli_fetch_assoc($result)){
        echo '
        <div class="accordion-item bg-secondary text-white-50">
				<h2 class="accordion-header pt-0" id="heading' .$rows['faqId'] . '">
				<button class="accordion-button dark2 text-white-50" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' .$rows['faqId'] . '" aria-expanded="false" aria-controls="collapse' .$rows['faqId'] . '">
                    ' . $rows['faqQuestion'] . '
				</button>
				</h2>
				<div id="collapse' .$rows['faqId'] . '" class="accordion-collapse collapse" aria-labelledby="heading' .$rows['faqId'] . '" data-bs-parent="#accordionFAQ">
				<div class="accordion-body">
                ' . $rows['faqAnswer'] . '
				</div>
				</div>
			</div>
        ';
    }
}

/* return le résultat sous forme d'array */
function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}


/* renvoie un array avec le BPM et le timestamp de l'user */
function getBPMHistoryUser($conn, $sessionId){
    $sql = "SELECT testDate AS x, stressBPM AS y FROM test INNER JOIN stress USING (testId) WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $sessionId);
        mysqli_stmt_execute($stmt);
    }
    $results = mysqli_stmt_get_result($stmt);

    return resultToArray($results);
}
/* renvoie un array de deux array avec les BPM globaux et de l'user */
function getBPMTotal($conn, $sessionId){
    $sql = "SELECT stressBPM AS x FROM stress;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $resultTotal = mysqli_stmt_get_result($stmt);

    $sql = "SELECT stressBPM AS x FROM test INNER JOIN stress USING (testId) WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $sessionId);
        mysqli_stmt_execute($stmt);
    }
    $resultPerso = mysqli_stmt_get_result($stmt);

    return [resultToArray($resultTotal), resultToArray($resultPerso)];
}
/* on considere les BPM de 50 à 150 avec un écart de 5 entre chaque */
function BPMTotal2Chart($BPM){
    $array = array();
    /* on créer un array à 2 dimensions avec chaque ligne =  (maxBPM, pourcentage de test compris entre ce max et le précédent) */
    for ($i = 1; $i < 21; $i++) {
        $array[] = array(50 + 5*$i, 0);
    }
    for ($i = 0; $i < count($BPM); $i++) { /* on parcours les BPM donné */
        for ($j = 0; $j < count($array); $j++){/* on parcours les maxBPM */
            if ($BPM[$i]['x'] <= $array[$j][0]){/* si le ième bpm est inf ou égal au bpmMax j */
                $array[$j][1] += (1/count($BPM))*100;/* le pourcentage de test de j augmente de 1/nbTotal */
                break;/* on sort du for j et on passe au i suivant */
            }
        }
    }
    /*on donne des keys a l'array pour le graphe  */
    $arrayFinal = array();
    for ($i = 0; $i < 20; $i++) {
        $arrayFinal[] = array("x" => $array[$i][0],  "y" => $array[$i][1]);
    }
    return $arrayFinal;
}

/* renvoie un array avec le BPM et le timestamp de l'user */
function getTempHistoryUser($conn, $sessionId){
    $sql = "SELECT testDate AS x, stressTemp AS y FROM test INNER JOIN stress USING (testId) WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $sessionId);
        mysqli_stmt_execute($stmt);
    }
    $results = mysqli_stmt_get_result($stmt);

    return resultToArray($results);
}
/* renvoie un array avec le BPM et le timestamp de l'user */
function getTempTotal($conn, $sessionId){
    $sql = "SELECT stressTemp AS x FROM stress;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $resultTotal = mysqli_stmt_get_result($stmt);

    $sql = "SELECT stressTemp AS x FROM test INNER JOIN stress USING (testId) WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $sessionId);
        mysqli_stmt_execute($stmt);
    }
    $resultPerso = mysqli_stmt_get_result($stmt);

    return [resultToArray($resultTotal), resultToArray($resultPerso)];
}
/* on considere les températures de 35 à 40°C avec un écart de 0.25 entre chaque */
function TempTotal2Chart($Temp){
    $array = array();
    /* on créer un array à 2 dimensions avec chaque ligne =  (maxTemp, pourcentage de test compris entre ce max et le précédent) */
    for ($i = 1; $i < 21; $i++) {
        $array[] = array(35 + 0.25*$i, 0);
    }
    for ($i = 0; $i < count($Temp); $i++) { /* on parcours les BPM donné */
        for ($j = 0; $j < count($array); $j++){/* on parcours les maxBPM */
            if ($Temp[$i]['x'] <= $array[$j][0]){
                $array[$j][1] += (1/count($Temp))*100;/* le pourcentage de test de j augmente de 1/nbTotal */
                break;/* on sort du for j et on passe au i suivant */
            }
        }
    }
    /*on donne des keys a l'array pour le graphe  */
    $arrayFinal = array();
    for ($i = 0; $i < 20; $i++) {
        $arrayFinal[] = array("x" => $array[$i][0],  "y" => $array[$i][1]);
    }
    return $arrayFinal;
}


/* renvoie un array avec le reflexe visuel et le timestamp de l'user */
function getVisualHistoryUser($conn, $sessionId){
    $sql = "SELECT testDate AS x, reflexVisual AS y FROM test INNER JOIN reflex USING (testId) WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $sessionId);
        mysqli_stmt_execute($stmt);
    }
    $results = mysqli_stmt_get_result($stmt);

    return resultToArray($results);
}
/* renvoie un array de deux array avec les reflexes visuels globaux et de l'user */
function getVisualTotal($conn, $sessionId){
    $sql = "SELECT reflexVisual AS x FROM reflex;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $resultTotal = mysqli_stmt_get_result($stmt);

    $sql = "SELECT reflexVisual AS x FROM test INNER JOIN reflex USING (testId) WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $sessionId);
        mysqli_stmt_execute($stmt);
    }
    $resultPerso = mysqli_stmt_get_result($stmt);

    return [resultToArray($resultTotal), resultToArray($resultPerso)];
}
/* on considere les BPM de 50 à 150 avec un écart de 5 entre chaque */
function VisualTotal2Chart($Visual){
    $array = array();
    /* on créer un array à 2 dimensions avec chaque ligne =  (maxVisual en ms, pourcentage de test compris entre ce max et le précédent) */
    for ($i = 1; $i < 21; $i++) {
        $array[] = array(0 + 25*$i, 0);
    }
    for ($i = 0; $i < count($Visual); $i++) { /* on parcours les BPM donné */
        for ($j = 0; $j < count($array); $j++){/* on parcours les maxBPM */
            if ($Visual[$i]['x'] <= $array[$j][0]){/* si le ième bpm est inf ou égal au bpmMax j */
                $array[$j][1] += (1/count($Visual))*100;/* le pourcentage de test de j augmente de 1/nbTotal */
                break;/* on sort du for j et on passe au i suivant */
            }
        }
    }
    /*on donne des keys a l'array pour le graphe  */
    $arrayFinal = array();
    for ($i = 0; $i < 20; $i++) {
        $arrayFinal[] = array("x" => $array[$i][0],  "y" => $array[$i][1]);
    }
    return $arrayFinal;
}

/* renvoie un array avec le reflexe sound et le timestamp de l'user */
function getSoundHistoryUser($conn, $sessionId){
    $sql = "SELECT testDate AS x, reflexSound AS y FROM test INNER JOIN reflex USING (testId) WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $sessionId);
        mysqli_stmt_execute($stmt);
    }
    $results = mysqli_stmt_get_result($stmt);

    return resultToArray($results);
}
/* renvoie un array de deux array avec les reflexes sound globaux et de l'user */
function getSoundTotal($conn, $sessionId){
    $sql = "SELECT reflexSound AS x FROM reflex;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $resultTotal = mysqli_stmt_get_result($stmt);

    $sql = "SELECT reflexSound AS x FROM test INNER JOIN reflex USING (testId) WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $sessionId);
        mysqli_stmt_execute($stmt);
    }
    $resultPerso = mysqli_stmt_get_result($stmt);

    return [resultToArray($resultTotal), resultToArray($resultPerso)];
}
/* */
function SoundTotal2Chart($Sound){
    $array = array();
    /* on créer un array à 2 dimensions avec chaque ligne =  (maxVisual en ms, pourcentage de test compris entre ce max et le précédent) */
    for ($i = 1; $i < 21; $i++) {
        $array[] = array(0 + 25*$i, 0);
    }
    for ($i = 0; $i < count($Sound); $i++) { /* on parcours les BPM donné */
        for ($j = 0; $j < count($array); $j++){/* on parcours les maxBPM */
            if ($Sound[$i]['x'] <= $array[$j][0]){/* si le ième bpm est inf ou égal au bpmMax j */
                $array[$j][1] += (1/count($Sound))*100;/* le pourcentage de test de j augmente de 1/nbTotal */
                break;/* on sort du for j et on passe au i suivant */
            }
        }
    }
    /*on donne des keys a l'array pour le graphe  */
    $arrayFinal = array();
    for ($i = 0; $i < 20; $i++) {
        $arrayFinal[] = array("x" => $array[$i][0],  "y" => $array[$i][1]);
    }
    return $arrayFinal;
}

/* $data est le résult d'une fonction history User */
function moyenne($conn, $data){
    $size = count($data);
    $total = 0;
    for ($i = 0; $i < count($data); $i++) { /* on parcours les données */
        $total += $data[$i]['y'];
    }
    $moy = $total/$size;
    return $moy;
}

/* Affiche le tablo des lignes de test de l'user */
function showActivity($conn, $userId){
    global $lang; /* on récupere la var global donné par config */

    $sql = "SELECT testType, testDate FROM test WHERE usersId=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);
    $array = resultToArray($result);
    
    /* on replace les valeurs de 0 à 3 en type correspondant */
    for ($i = 0; $i < count($array); $i++) {
        switch ($array[$i]['testType']) {
            case 0:
                $array[$i]['testType'] = '<a href="/AutoKapt/pages/User/play/p.stress.php"><i class="fas fa-brain"></i></a> Stress';
                break;
            case 1:
                $array[$i]['testType'] = '<a href="/AutoKapt/pages/User/play/p.reflex.php"><i class="fas fa-music"></i></a> '. $lang["dashboard-reflex"];
                break;
            case 2:
                $array[$i]['testType'] = '<a href="/AutoKapt/pages/User/play/p.reflex.php"><i class="fas fa-music"></i></a> '. $lang["dashboard-memory"];
                break;
            case 3:
                $array[$i]['testType'] = '<a href="/AutoKapt/pages/User/play/p.reflex.php"><i class="fas fa-music"></i></a> '. $lang["dashboard-hearing"];
                break;
        }
    }
    /* on parcours le tablo de la requete sql en partant de la fin */
    for ($i = count($array) - 1; $i >= 0; $i--) {
        /* temps écoulé depuis le test en question */
        $time_ago = time_elapsed_string($array[$i]['testDate'], $lang["ago"]);
        $split_time = preg_split("/[\s]/", $array[$i]['testDate']);
        $time = $split_time[0] . $lang["at"] . $split_time[1];
            echo '
            <tr>
                <td class="align-middle"><h4>'. $array[$i]['testType'] .'</h4></td>
                <td><p class="text-danger my-0">'. $time_ago .'</p><p class="my-0">'. $time .'</p></td>
            </tr>
            ';
            
    } 
}

/* fonction venant de stackoverflow */
/* https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago/18602474#18602474 */
function time_elapsed_string($datetime, $after, $full = false) {
    global $lang; /* on récupere la var global donné par config */
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => $lang["y"],
        'm' => $lang["m"],
        'w' => $lang["w"],
        'd' => $lang["d"],
        'h' => $lang["h"],
        'i' => $lang["i"],
        's' => $lang["s"],
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    if ($lang["ago"] == "ago")
        return $string ? implode(', ', $string) . ' ' . $after : 'just now';
    else {
        return $string ? $after  . ' ' . implode(', ', $string) : "à l'instant";
    }
}

/* Affiche le tablo de tout les users ayant l'acces demandé */
function showUsers($conn, $access){
    $sql = "SELECT usersUsername, usersEmail, usersGender, usersBirth, usersAccess FROM users WHERE usersAccess=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error3";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $access);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);
    $array = resultToArray($result);
    
    /* on parcours le tablo de la requete sql */
    for ($i = 0; $i < count($array); $i++) {
        echo '
        <tr>
            <td class="align-middle"><h4>'. $array[$i]['usersUsername'] .'</h4></td>
            <td class="align-middle"><h4>'. $array[$i]['usersEmail'] .'</h4></td>
            <td class="align-middle"><h4>'. $array[$i]['usersGender'] .'</h4></td>
            <td class="align-middle"><h4>'. time_elapsed_string($array[$i]['usersBirth'], ' old') .'</h4></td>
        </tr>
        ';
            
    } 
}

function showDatalistUsername($conn){
    $sql = "SELECT usersUsername FROM users WHERE usersEmail NOT LIKE '%@bot.fr'";
    $result = mysqli_query($conn, $sql);
    echo '
    <label for="searchUsername" class="form-label">Search users by username</label>
    <input name="likeUsername" class="form-control" list="datalistOptions" id="searchUsername" placeholder="Type username to search...">
    <datalist id="datalistOptions">
    ';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value=' . $row["usersUsername"] . '>';
     }
    echo '
    </datalist>
    ';
}
