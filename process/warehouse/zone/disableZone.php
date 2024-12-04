<?php
    require_once("../../../config.php");
    require_once("zoneFun.php");

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        
        if (disableZone($code)) {
            $_SESSION['message'] = [
                'text' => 'Zone successfully disabled',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error deactivating zone',
                'type' => 'error'
            ];
        }

        header("Location: /process/warehouse/zone/");
        exit();
    } else {
        $_SESSION['message'] = [
            'text' => 'Zone code not provided',
            'type' => 'error'
        ];
    }
?>