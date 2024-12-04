<?php
    require_once("../../config.php");
    require_once("materialFun.php");

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        
        if (disableMaterial($code)) {
            $_SESSION['message'] = [
                'text' => 'Material successfully disabled',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error deactivating material',
                'type' => 'error'
            ];
        }

        header("Location: /materials/material/");
        exit();
    } else {
        $_SESSION['message'] = [
            'text' => 'Material code not provided',
            'type' => 'error'
        ];
    }
?>