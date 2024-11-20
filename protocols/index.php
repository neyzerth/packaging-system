<?php 
    $form = "/protocols/addProtocol.php";
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    require_once "../config.php";
    include HEAD;

    switch($action){
        
        case 'add': include "addProtocol.php";
            break;
        
        case 'edit': include "editProtocol.php";
            break;
        
        default: include "listProtocols.php";
        break;
    }
    include FOOT;
?>