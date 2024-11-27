<?php
    require_once("../../config.php");
    require_once("protocolFun.php");

    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        
        if (disableProtocol($num)) {
            echo "Protocol deactivated correctly.";
        } else {
            echo "Error disabling protocol.";
        }

        header("Location: index.php");
        exit();
    } else {
        echo "Protocol code not provided.";
    }
?>