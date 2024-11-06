<?php
require_once "../config.php";
require "logFun.php";

$msg = "Put your credentials.";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        header("Location: /");
        exit();
    } else {
        $msg = 'Username or password incorrect.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administar Cajas</title>
    <link rel="stylesheet" href="<?php echo STYLE . "!important.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "!color-palette.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "login.css" ?>">
</head>

<body class="d-flex">
    <main class="d-flex m-auto">
        <div id="leftDiv">
            <a class="d-contents" href="#" id="link">
                <img class="p mb rounded-circle" src=<?php echo SVG . "svg/padlock-unlocked.svg" ?> alt="" id="toggleImage">
            </a>
            <strong id="toggleText">¿Forgot your password?</strong>
            <p id="paragraph">Select the icon to request instructions.</p>
        </div>
        <form action="\GitHub\packaking-system/boxes/index.php" id="rightDiv" method="post">
            <strong style="font-size: 20px;">Hello again!</strong>
            <p><?php echo $msg ?></p>
            <input id="username" name="username" class="form-control" type="text"  autocomplete="off" required placeholder="User">
            <input id="password" name="password" class="form-control" type="password" autocomplete="off" required placeholder="Password">
            <button type="submit" class="btn-primary">Login</button>
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>