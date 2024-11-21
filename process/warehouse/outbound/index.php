<?php 
    $form = "/outbound/addOut.php";
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    require_once "../../../config.php";
    include HEAD;
    
    switch($action){
        
        case 'add': include "addOut.php";
            break;
        
        case 'edit': include "editOut.php";
            break;
        
        default: include "listOuts.php";
        break;
    }

    include FOOT;
?>