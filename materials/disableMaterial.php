<?php
    require_once("../config.php");
    require_once("materialFun.php");

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        
        // Llamar a la función para desactivar el material
        if (deactivateMaterial($code)) {
            echo "Material desactivado correctamente.";
        } else {
            echo "Error al desactivar el material.";
        }

        header("Location: listMaterial.php");
        exit();
    } else {
        echo "Código de material no proporcionado.";
    }
?>