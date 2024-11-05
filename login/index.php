<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../styles/!important.css">
    <link rel="stylesheet" href="../styles/!color-palette.css">
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body class="d-flex">
    <main class="d-flex m-auto">
        <div id="leftDiv">
            <a class="d-contents" href="#" id="link">
                <img class="p mb rounded-circle" src="../structures/svg/padlock-unlocked.svg" alt="" id="toggleImage">
            </a>
            <strong id="toggleText">¿Has olvidado la contraseña?</strong>
            <p id="paragraph">Selecciona el icono para solicitar instrucciones.</p>
        </div>
        <form action="#" id="rightDiv">
            <strong style="font-size: 20px;">¡Hola de nuevo!</strong>
            <p>¡Nos alegramos de volver a verte!</p>
            <input class="form-control" type="text" required placeholder="Usuario">
            <input class="form-control" type="text" required placeholder="Password">
            <button class="btn-primary">Iniciar sesión</button>
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>