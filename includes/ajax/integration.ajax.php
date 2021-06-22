<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/AutoKapt/bases/config.php');
require_once __ROOT__.'Model/integration.inc.php';
    if (isset($_POST['test'])) {
        switch ($_POST['test']) {
            case 'temp':
                getData(3);
                break;
            case 'bpm':
                getData(9);
                break;
            /* case 'select':
                select();
                break; */
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
                echo json_encode(array(
                    'value' => $value, 
                    'date' => $date, 
                ));;
                break;
            case 9:
                $value = $array['value'];
                $date = $array['time'];
                echo json_encode(array(
                    'value' => $value, 
                    'date' => $date, 
                ));;
                break;
        }
    }
    function loop($test){
        do {
        $ch = curl_init("http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G9Ee");
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        $data_tab = str_split($data,33);
        $newest_trame = $data_tab[count($data_tab)-2];
        $bool = substr($newest_trame,6,7);
        } while ($bool != $test);

        $array = trame2array($newest_trame);
        switch ($test) {
            case 3:
                $value = getTemp($array['value']);
                $date = $array['time'];
                echo json_encode(array(
                    'value' => $value, 
                    'date' => $date, 
                ));;
                break;
            case 9:
                break;
        }



        exit;
    }
?>