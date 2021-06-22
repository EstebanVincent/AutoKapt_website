<?php
// On récup les la trame envoyer depuis la carte tiva.
/* $ch = curl_init();
curl_setopt(
$ch,
CURLOPT_URL,
"http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G9Ee");
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch); */


// On découpe la chaine de caractère en proportion de 33 caractère.
/* $data_tab = str_split($data,33);
echo "Tabular Data: ". count($data_tab) ." <br />";
for($i=0, $size=count($data_tab); $i<$size-1; $i++){
echo "Trame $i: $data_tab[$i]<br />";
echo "test $i: ". json_encode(trame2array($data_tab[$i]))."<br />";
} */
define("SEND", "http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=G9Ee&TRAME=");


function createTrame($testType){
    $tra = "1";
    $obj = "G9Ee";
    $req = "1";
    $num = "01";
    $ans = "0000";
    
    switch ($testType) {/* bpm c 9 */
        case 0:/* stress, température */
            $typ = "3";
            $short_trame = $tra.$obj.$req.$typ.$num.$ans;
            $trame = $short_trame . createChk($short_trame);
            break;
        case 1:/* reflex */
            $typ = "9";
            $short_trame = $tra.$obj.$req.$typ.$num.$ans;
            $trame = $short_trame . createChk($short_trame);
            break;
        case 2:/* memoire */
            $typ = "5";
            $short_trame = $tra.$obj.$req.$typ.$num.$ans;
            $trame = $short_trame . createChk($short_trame);
            break;
        case 3:/* audition */
            $typ = "7";
            $short_trame = $tra.$obj.$req.$typ.$num.$ans;
            $trame = $short_trame . createChk($short_trame);
            break;
    }
    return $trame;
}

function sendTrame($trame){
    $url = SEND . $trame;
    /* die(header('Location: ' . $url)); */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
}

/* sendTrame(createTrame(3)); */

/* fonctions finies */

/* renvoie true si la trame est bonne et faulse si corrompu */
function checksum($trame){
    $resultDec = 0;
    $check = substr($trame,17,19);
    /* on parcours la trame sans le chk */
    for ($i = 0; $i < 17; $i++){
        $resultDec += ord(substr($trame,$i,1));
    }
    $resultHex = dechex($resultDec);
    $len = strlen($resultHex);
    $toCheck = substr($resultHex,$len-2,$len);
    
    if($toCheck == $check){
        return true;
    }
    return false;
}

/* renvoie le chk de la trame en cours de création */
function createChk($short_trame){
    $resultDec = 0;
    for ($i = 0; $i < 17; $i++){
        $resultDec += ord(substr($short_trame,$i,1));
    }
    $resultHex = dechex($resultDec);
    $len = strlen($resultHex);
    $chk = substr($resultHex,$len-2,$len);
    return $chk;
}

/* renvoi un array avec la date, la valeur, et le type de la trame donnée */
function trame2array($trame){
    /* data de la trame */
    $tra = substr($trame,0,1);
    $obj = substr($trame,1,4);
    $req = substr($trame,5,1);
    $typ = substr($trame,6,1);
    $num = substr($trame,7,2);
    $val = substr($trame,9,4);
    $tim = substr($trame,13,4);
    $chk = substr($trame,17,2);

    /* timestamp */
    $y = substr($trame,19,4);
    $mth = substr($trame,23,2);
    $d = substr($trame,25,2);
    $h = substr($trame,27,2);
    $min = substr($trame,29,2);
    $s = substr($trame,31,2);

    $timestamp = new datetime($y.'-'.$mth.'-'.$d.' '.$h.':'.$min.':'.$s);

    return array(
        'time' => $timestamp,
        'value' => $val,
        'type' => $typ
    );
}

/* créer une ligne dans test et la ligne correspondante dans stress */
function stress2bdd($conn, $arrayTemp, $arrayBPM){
    $testDate = $arrayTemp['time'];
    $testType = 0;
    $usersId = $_SESSION['userId'];

    $stressTemp = getTemp($arrayTemp['value']);
    $stressBPM = $arrayBPM['value'];

    $sql = "INSERT INTO test (testDate, testType, usersId) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sii", $testDate, $testType, $usersId);
        mysqli_stmt_execute($stmt);
    }

    $sql = "SELECT testId FROM test WHERE testDate=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $testDate);
        mysqli_stmt_execute($stmt);
    }
    $result =mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $testId = $row["testId"];

    $sql = "INSERT INTO stress (testId, stressTemp, stressBPM) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "iss", $testId, $stressTemp, $stressBPM);
        mysqli_stmt_execute($stmt);
    }
}

/* return la température en °C à partir de la valeur en HEX */
function getTemp($val){
    return $val/100;
}
