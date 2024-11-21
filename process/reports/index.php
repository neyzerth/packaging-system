<?php
$form = "addIncident.php";
$action = isset($_GET['a']) ? $_GET['a'] : null;

require_once "../../config.php";
include HEAD;

switch($action){

    case 'add': include "addIncident.php";
        break;
    
    case 'edit': include "editIncident.php";
        break;
    
    default: include "listIncidents.php";
    break;
}
include FOOT;
?>