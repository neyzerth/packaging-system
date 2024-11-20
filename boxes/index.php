<?php 
    $form = "/boxes/addBox.php";
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    require_once "../config.php";
    include HEAD;

    switch($action){
        
        case 'add': include "addBox.php";
            break;
        
        case 'edit': include "editBox.php";
            break;
        
        default: include "listBoxes.php";
        break;
    }

    include FOOT;
?>