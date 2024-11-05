<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
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
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Nombre</th>
                    <th>Fecha de nacimiento</th>
                    <th>Tipo de personal</th>
                </tr>
            </thead>
            <tbody>
                <!--JavaScript + PHP-->

                <!--Ejemplo de la estructura HTML-->
                <tr>
                    <!--Información principal-->
                    <td><input type="checkbox"></td>
                    <td>^</td>
                    <td>1</td>
                    <td>Monarrez</td>
                    <td>Barron</td>
                    <td>Polo</td>
                    <td>07-06-2005</td>
                    <td>Administrador</td>
                </tr>
                <!--Información que se va desplegar-->
                <tr>
                    <td>Usuario: <span>POLOK8039</span></td>
                    <td>Contraseña: <span>****</span></td>
                    <td>Correo electronico: <span>anonymous.pamb@gmail.com</span></td>
                    <td>Teléfono: <span>664 481 6725</span></td>
                    <td>Direacción: <span>El laurel #1 22256 25556</span></td>
                    <td>Estado: <span>Activo</span></td>
                    <td>Supervisor: <span>2</span></td>
                </tr>
                <!--Ejemplo de la estructura HTML-->
            </tbody>
        </table>
    </main>
    <script src=""></script>
</body>

</html>
<!--
                    :::Administrar Usuarios:::
            Tablas:
                - usuario:
                    - num           (PK)
                    - nombreUsuario
                    - contrasena
                    - nombre
                    - apellidoPa
                    - apellidoMa
                    - fecNac
                    - colonia
                    - calle
                    - cp
                    - telefono
                    - email
                    - activo
                    - tipo_usuario  (FK)
                    - supervisor    (FK)

            Datos requeridos:
                - Información principal:
                    - usuario:
                        - num           (PK)
                        - nombre
                        - apellidoPa
                        - apellidoMa
                        - fecNac
                        - tipo_usuario  (FK)

                - Información que se va desplegar:
                    - usuario:
                        - nombreUsuario
                        - contrasena
                        - email
                        - telefono
                        :::Concatenado:::
                        - colonia
                        - calle
                        - cp
                        :::Concatenado:::
                        - activo
                        - supervisor    (FK)
    -->