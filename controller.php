<?php

require_once 'api.php';
require_once 'endpoint.php';

if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}
try{
    $api = new EndPoint($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $api->processAPI();
}catch (Exception $e){
    echo json_encode(array('error'=>$e->getMessage()));
}
