<?php 
    $form = "addZone.php";
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    require_once "../../../config.php";
    include HEAD;
    
    switch($action){
        
        case 'add': include "addZone.php";
            break;
        
        case 'edit': include "editZone.php";
            break;
        
        default: include "listZones.php";
        break;
    }

    include FOOT;
?>