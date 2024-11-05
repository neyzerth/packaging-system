<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Productos</title>
    <link rel="stylesheet" href="../styles/!important.css">
    <link rel="stylesheet" href="../styles/!color-palette.css">
    <link rel="stylesheet" href="../styles/table.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
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
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Peso</th>
                    <th>Alto</th>
                    <th>Ancho</th>
                    <th>Largo</th>
                    <th>#Paquete</th>
                </tr>
            </thead>
            <tbody>
                <!--JavaScript + PHP-->

                <!--Ejemplo de la estructura HTML-->
                <tr>
                    <td><input type="checkbox"></td>
                    <td>^</td>
                    <td>1</td>
                    <td>iPhone 15</td>
                    <td>Dispositivo de alta gama de ultima generación</td>
                    <td>0.556kg</td>
                    <td>16cm</td>
                    <td>0.8cm</td>
                    <td>5cm</td>
                    <td>556</td>
                </tr>
                <!--Ejemplo de la estructura HTML-->
            </tbody>
        </table>
    </main>
    <script src="script.js"></script>
</body>

</html>
<!--
                    :::Administrar productos:::
            Tablas:
                - producto:
                    - num                   (PK)
                    - nombre
                    - descripcion
                    - peso
                    - alto
                    - ancho
                    - largo
                    - paquete               (FK)
                    - protocolo_embalaje    (FK)

                - Datos requeridos:
                    - producto:
                        - num (PK)
                        - nombre
                        - descripcion
                        - peso
                        - alto
                        - ancho
                        - largo
                        - paquete           (FK)
    -->