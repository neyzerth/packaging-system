<?php
    require_once("../config.php");
    require_once("userFun.php");

    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        
        if (disableProduct($num)) {
            echo "Producto desactivado correctamente.";
        } else {
            echo "Error al desactivar el producto.";
        }

        header("Location: listProduct.php");
        exit();
    } else {
        echo "Código de producto no proporcionado.";
    }
?>