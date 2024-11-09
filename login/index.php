<?php
session_start(); 
session_unset();
session_destroy(); 
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
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo STYLE . "!color-palette.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "body.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "login.css" ?>">
</head>

<body>
    <div class="overlay">
        <svg width="120" height="120" class="bi" viewBox="0 0 16 16">
            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
        </svg>
        <h3>Content blurred due to screen resolution.</h3>
    </div>
    <main class="login">
        <div class="division" id="leftDiv">
                <a class="div-link" href="#" id="link">
                    <svg width="160" height="160" class="bi" viewBox="0 0 16 16" id="toggleImage">
                        <path d="M5.5 7V4.5a2.5 2.5 0 1 1 5 0V7H11a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h.5zm1-2.5V7h3V4.5a1.5 1.5 0 0 0-3 0zm1.5 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>
                    </svg>
                </a>
            <h4 id="toggleText">Forgot password?</h4>
            <p id="paragraph">Select the icon for more information</p>
        </div>
        <div class="division" id="rightDiv">
            <form action="#" method="post">
                <h2>Welcome back!</h2>
                <p><?php echo $msg ?></p>
                <input id="username" name="username" class="form-control" type="text" autocomplete="off" required placeholder="User">
                <input id="password" name="password" class="form-control" type="password" autocomplete="off" required placeholder="Password">
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>
    </main>
    <script src="script.js"></script>
</body>

</html>