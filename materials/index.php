<?php
$form = "/materials/addMaterial.php";
$action = isset($_GET['a']) ? $_GET['a'] : null;

require_once "../config.php";
include HEAD;

switch($action){
    
    case 'add': include "addMaterial.php";
        break;
    
    case 'edit': include "editMaterial.php";
        break;
    
    default: include "listMaterial.php";
    break;
}
include FOOT;
?>