<?php
$path = getenv("HTTP_SERVER_PATH");

require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/util/functions.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';


if(isset($_GET['q'])){
    $search = strtolower($_GET['q']);

    $resultList = array();

    $what = array("name","serialNum");
    $data = getData($what,"inventory","",$GLOBALS['maindb']);


    foreach($data as $item){
        if(strpos(strtolower($item['name']),$search)>-1){
            if(!checkList($item['name'], $resultList)){
                array_push($resultList,$item);
            }
        }
    }

    //move to css

    foreach($resultList as $item){
        echo "<button id='instSearchItem' name='instSelection' style='width:250px' value='".$item['serialNum']."' type='submit' form='instSearch'>".$item['name']."</button><br>";
    }
}

function checkList($n,$h){
    foreach ($h as $value) {
        if($value['name'] == $n) return TRUE;
    }
    return FALSE;
}
?>