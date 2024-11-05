<?php
    require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administar Cajas</title>
    <link rel="stylesheet" href="<?php echo STYLE."!important.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE."!color-palette.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE."table.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE."sidebar.css" ?>">
</head>

<body class="d-flex">
    <?php
    include("../structures/sidebar/index.php")
    ?>
    <main>
        <?php
        include("../structures/header/index.php")
        ?>
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th> </th>
                    <th>#</th>
                    <th>Alto</th>
                    <th>Ancho</th>
                    <th>Largo</th>
                    <th>Volumen</th>
                    <th>Peso</th>
                </tr>
            </thead>
            <tbody>
                <!--JavaScript + PHP-->

                <!--Ejemplo de la estructura HTML-->
                <tr>
                    <td><input type="checkbox"></td>
                    <td>^</td>
                    <td>1</td>
                    <td>20cm</td>
                    <td>2cm</td>
                    <td>40cm</td>
                    <td>1600cm^3</td>
                    <td>10kg</td>
                </tr>
                <!--Ejemplo de la estructura HTML-->
            </tbody>
        </table>
    </main>
    <script src="script.js"></script>
</body>

</html>
<!--
                    :::Administrar Cajas:::
            Tablas:
                - caja:
                    - num (PK)
                    - alto
                    - ancho
                    - largo
                    - volumen
                    - peso

            Datos requeridos:
                - caja:
                    - num (PK)
                    - alto
                    - ancho
                    - largo
                    - volumen
                    - peso
    -->