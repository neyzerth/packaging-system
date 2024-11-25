<?php

$action = isset($_GET['a']) ? $_GET['a'] : null;

include $_SERVER['DOCUMENT_ROOT']."/config.php";
include HEAD;

$page = "";
switch($action){

    case 'addPackage': $page = 'package/addPackage.php';
    break;
    case 'addPackaging': $page = 'packaging/addPackaging.php';
    break;
    case 'addWarehouse': $page = 'warehouse/addWarehouse.php';
    break;
    
    default: $page = 'home.php';
}

include $page;

include FOOT;