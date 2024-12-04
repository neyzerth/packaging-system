<?php
    require_once("../config.php");
    require_once("boxFun.php");

    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        
        if (disableBox($num)) {
            $_SESSION['message'] = [
                'text' => 'Box successfully disabled',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error deactivating box',
                'type' => 'error'
            ];
        }

        header("Location: index.php");
        exit();
    } else {
        $_SESSION['message'] = [
            'text' => 'Box code not provided',
            'type' => 'error'
        ];
    }
?>