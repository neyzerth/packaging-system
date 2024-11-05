<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Materiales</title>
    <link rel="stylesheet" href="../styles/!important.css">
    <link rel="stylesheet" href="../styles/!color-palette.css">
    <link rel="stylesheet" href="../styles/table.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <style>

    </style>
</head>

<body class="d-flex">
    <?php
    include("../structures/index.php")
    ?>
    <main>
        <?php
        include("../structures/index.php")
        ?>
        <div>
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th> </th>
                        <th>#</th>
                        <th>Material</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <!--JavaScript + PHP-->

                    <!--Ejemplo de la estructura HTML-->
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>^</td>
                        <td>1</td>
                        <td>Plastico envolvente</td>
                        <td>Protege el producto</td>
                        <td>25556</td>
                    </tr>
                    <!--Ejemplo de la estructura HTML-->
                </tbody>
            </table>
        </div>
    </main>
    <script src="script.js"></script>
</body>

</html>
<!--
                    :::Administrar materiales:::
            Tablas:
                - material:
                    - codigo        (PK)
                    - nombre_material
                    - descripción
                    - cantidad_disponible
                    - unidad_medida (FK)

            Datos requeridos:
                - material:
                    - codigo        (PK)
                    - nombre_material
                    - descripción
                    - cantidad_disponible
    -->