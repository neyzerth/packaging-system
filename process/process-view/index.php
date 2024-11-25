<?php

$action = isset($_GET['a']) ? $_GET['a'] : null;

include $_SERVER['DOCUMENT_ROOT']."/config.php";
include HEAD;

$page = "";
switch($action){

    case 'addProduct': $page = '../../products/listProducts.php';
    break;
    case 'addPackage': $page = 'package/addPackage.php';
    break;
    
    default: $page = 'home.php';
}

include $page;

include FOOT;