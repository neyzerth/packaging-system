<?php
    require_once("../../../config.php");
    require_once("outFun.php");

    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        
        if (disableOutbound($num)) {
            echo "Salida desactivada correctamente.";
        } else {
            echo "Error al desactivar la salida.";
        }

        header("Location: index.php");
        exit();
    } else {
        echo "Numero de salida no proporcionado.";
    }
?>