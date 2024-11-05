<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                    <th>Nombre</th>
                    <th>Archivo</th>
                </tr>
            </thead>
            <tbody>
                <!--JavaScript + PHP-->

                <!--Ejemplo de la estructura HTML-->
                <tr>
                    <td><input type="checkbox"></td>
                    <td>^</td>
                    <td>1</td>
                    <td>Protocolo de embalaje</td>
                    <td>PE.pdf</td>
                </tr>
                <!--Ejemplo de la estructura HTML-->
            </tbody>
        </table>
    </main>
    <script src=""></script>
</body>

</html>
<!--
                    :::Administrar Protocolos:::
            Tablas:
                - protocolo_embalaje:
                    - num (PK)
                    - nombre
                    - nom_archivo

            Datos requeridos:
                - protocolo_embalaje:
                   - num (PK)
                   - nombre
                   - nom_archivo
    -->