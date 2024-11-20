<?php 
    $form = "/users/addUser.php";
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    require_once "../config.php";
    include HEAD;
    
    switch($action){
        
        case 'add': include "addUser.php";
            break;
        
        case 'edit': include "editUser.php";
            break;
        
        default: include "listUsers.php";
        break;
    }

    include FOOT;
?>