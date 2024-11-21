<?php 
    $form = "/products/addProduct.php";
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    require_once "../config.php";
    include HEAD;
    switch($action){
    
        case 'add': include "addProduct.php";
            break;
        
        case 'edit': include "editProduct.php";
            break;
        
        default: include "listProducts.php";
        break;
    }
    include FOOT;
?>