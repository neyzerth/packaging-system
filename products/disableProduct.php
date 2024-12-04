<?php
    require_once("../config.php");
    require_once("prodFun.php");

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        
        if (disableProduct($code)) {
            $_SESSION['message'] = [
                'text' => 'Product successfully disabled',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error deactivating product',
                'type' => 'error'
            ];
        }

        header("Location: /products");
        exit();
    } else {
        $_SESSION['message'] = [
            'text' => 'Product code not provided',
            'type' => 'error'
        ];
    }
?>