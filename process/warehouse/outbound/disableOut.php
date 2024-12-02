<?php
    require_once("../../../config.php");
    require_once("outFun.php");

    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        
        if (disableOutbound($num)) {
            echo "Outbound disabled successfully.";
        } else {
            echo "Error disabling output.";
        }

        header("Location: /warehouse/outbound");
        exit();
    } else {
        echo "Outbound number not provided.";
    }
?>