<?php
    require_once("../../config.php");
    require_once("protocolFun.php");

    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        
        if (disableProtocol($num)) {
            $_SESSION['message'] = [
                'text' => 'Protocol successfully disabled',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error deactivating protocol',
                'type' => 'error'
            ];
        }
    } else {
        $_SESSION['message'] = [
            'text' => 'Protocol code not provided',
            'type' => 'error'
        ];
    }

    header("Location: /protocols/protocol/");
    exit();
?>