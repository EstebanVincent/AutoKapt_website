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
        case 1:/* stress, bpm */
            $typ = "9";
            $short_trame = $tra.$obj.$req.$typ.$num.$ans;
            $trame = $short_trame . createChk($short_trame);
            break;
        case 2:/* memoire */
            $typ = "5";
            $short_trame = $tra.$obj.$req.$typ.$num.$ans;
            $trame = $short_trame . createChk($short_trame);
            break;
        case 3:/* son */
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
    return $url;
}

/* sendTrame(createTrame(3)); */

/* fonctions finies */

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

/* renvoie les valeurs de température et ECG */
function getStressResult(){
    $ch = curl_init("http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G9Ee");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    $data_tab = str_split($data,33);

    $bool = true;
    $i = 0;
    while($bool){
        $trame1 = $data_tab[count($data_tab)-(2+2*$i)];
        $trame2 = $data_tab[count($data_tab)-(4+2*$i)];
        $array1 = trame2array($trame1);
        $array2 = trame2array($trame2);
        $typ1 = $array1['type'];
        $typ2 = $array2['type'];

        if (($typ1 == 3 && $typ2 == 9) || ($typ1 == 9 && $typ2 == 3)){
            if ($typ1 == 3){
                $tempValue = $array1['value'];
                $bpmValue = $array2['value'];
            } else {
                $tempValue = $array2['value'];
                $bpmValue = $array1['value'];
            }
            $bool = false;
        }
        $i += 1;
    }
    $result = array(
        'stressBPM' => getBPM($bpmValue),
        'stressTemp' => getTemp($tempValue),
    );
    return $result;
}

/* créer une ligne dans test et la ligne correspondante dans stress */
function stress2bdd($conn, $stressBPM, $stressTemp){
    $testType = 0;
    $usersId = $_SESSION['userId'];


    $sql = "INSERT INTO test (testType, usersId) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $testType, $usersId);
        mysqli_stmt_execute($stmt);
    }

    $sql = "SELECT max(testId) FROM test;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else {
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

function getData($test){
    $ch = curl_init("http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G9Ee");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    $data_tab = str_split($data,33);
    $newest_trame = $data_tab[count($data_tab)-2];
    $array = trame2array($newest_trame);
    switch ($test) {
        case 3:
            $value = getTemp($array['value']);
            $date = $array['time'];
            $typ = $array['type'];
            if ($typ == $test){
                echo json_encode(array(
                    'value' => $value, 
                ));;
            } else {
                echo json_encode(array(
                    'value' => 'error',  
                ));;
            }
            break;
        case 9:
            $value = getBPM($array['value']);
            $date = $array['time'];
            $typ = $array['type'];
            if ($typ == $test){
                echo json_encode(array(
                    'value' => $value, 
                ));;
            } else {
                echo json_encode(array(
                    'value' => 'error',  
                ));;
            }
            break;
    }
}

/* return la température en °C à partir de la valeur en HEX */
function getTemp($val){
    return $val/100;
}
function getBPM($val){
    return hexdec($val);
}
