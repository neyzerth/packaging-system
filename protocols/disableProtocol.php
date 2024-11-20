<?php
    require_once("../config.php");
    require_once("protocolFun.php");

    if (isset($_GET['num'])) {
        $code = $_GET['num'];
        
        if (disableMaterial($code)) {
            echo "Protocolo desactivado correctamente.";
        } else {
            echo "Error al desactivar el protocolo.";
        }

        header("Location: index.php");
        exit();
    } else {
        echo "Código de protocolo no proporcionado.";
    }
?>