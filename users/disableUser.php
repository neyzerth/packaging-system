<?php
    require_once("../config.php");
    require_once("userFun.php");

    if (validateUser("ADMIN") && isset($_GET['num'])) {
        $num = $_GET['num'];
        
        if (disableUser($num)) {
            echo "usuario desactivado correctamente.";
        } else {
            echo "Error al desactivar el usuario.";
        }

        header("Location: listProduct.php");
        exit();
    } else {
        echo "Código de usuario no proporcionado.";
    }
?>