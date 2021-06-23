<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'Model/integration.inc.php';

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'bpmAsk':
            bpmAsk();
            break;
        case 'tempAsk':
            tempAsk();
            break;
        case 'saveStress':
            saveStress();
            break;
    }
}

function bpmAsk() {
    sendTrame(createTrame(1));/* demande de test de stress, bpm */
}

function tempAsk() {
    sendTrame(createTrame(0));/* demande de test de stress, bpm */
}
function saveStress(){
    $array = getStressResult();
    $stressBPM = $array['stressBPM'];
    $stressTemp = $array['stressTemp'];
    stress2bdd($conn, $stressBPM, $stressTemp);
}

if (isset($_POST['test'])) {
    switch ($_POST['test']) {
        case 'temp':
            getData(3);
            break;
        case 'bpm':
            getData(9);
            break;
    }
}

?>