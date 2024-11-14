<?php
    session_start(); 
    require_once "../config.php";
    require "logFun.php";
    $msg = "We're so excited to see you again!";
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
        <link rel="stylesheet" href="<?php echo CSS . "global.css" ?>">
        <link rel="stylesheet" href="<?php echo CSS . "login.css" ?>">
    </head>
<body>
    <div id="msg" data-msg="<?php echo htmlspecialchars($msg); ?>"></div>
    <div class="container">
        <div class="login row">
            <div class="division col-6" id="leftDiv">
                <a class="div-link" href="#" id="link">
                    <img class="bi" src="<?php echo SVG . "closed-lock.svg"; ?>" id="toggleImage">
                </a>
                <h4 id="toggleText">Forgot password?</h4>
                <p id="paragraph">Select the icon for more information</p>
            </div>
            <div class="division col-6" id="rightDiv">
                <form action="#" method="post">
                    <h2>Welcome back!</h2>
                    <p id="msgDisplay"><?php echo $msg ?></p>
                    <input id="username" name="username" class="form-control" type="text" autocomplete="off" required placeholder="User">
                    <input id="password" name="password" class="form-control" type="password" autocomplete="off" required placeholder="Password">
                    <button type="submit" class="btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo JS . "login.js" ?>"></script>
</body>
</html>



<!--
    <div class="container" style="margin: auto;">
        <main class="login row">
            <div class="division col-6" id="leftDiv">
                <a class="div-link" href="#" id="link">
                    <img class="bi" src="<?php echo SVG . "closed-lock.svg"; ?>" id="toggleImage">
                </a>
                <h4 id="toggleText">Forgot password?</h4>
                <p id="paragraph">Select the icon for more information</p>
            </div>
            <div class="division col-6" id="rightDiv">
                <form action="#" method="post">
                    <h2>Welcome back!</h2>
                    <p id="msgDisplay"><?php echo $msg ?></p>
                    <input id="username" name="username" class="form-control" type="text" autocomplete="off" required placeholder="User">
                    <input id="password" name="password" class="form-control" type="password" autocomplete="off" required placeholder="Password">
                    <button type="submit" class="btn-primary">Login</button>
                </form>
            </div>
        </main>
    </div>






















    <main class="login">
        <div class="division" id="leftDiv">
                <a class="div-link" href="#" id="link">
                    <img class="bi" src="<?php echo SVG . "closed-lock.svg"; ?>" id="toggleImage">
                </a>
            <h4 id="toggleText">Forgot password?</h4>
            <p id="paragraph">Select the icon for more information</p>
        </div>
        <div class="division" id="rightDiv">
            <form action="#" method="post">
                <h2>Welcome back!</h2>
                <p id="msgDisplay"><?php echo $msg ?></p>
                <input id="username" name="username" class="form-control" type="text" autocomplete="off" required placeholder="User">
                <input id="password" name="password" class="form-control" type="password" autocomplete="off" required placeholder="Password">
                <button type="submit" class="btn-primary">Login</button>
            </form>
        </div>
    </main>
-->