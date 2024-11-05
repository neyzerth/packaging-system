<?php
    require("../config.php");
    require HEADER;
    require "logFun.php";

    $msg = "Put your credentials.";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(login($username,$password)){
            header("Location: /"); 
            exit();
        } else {
            $msg = 'Username or password incorrect.';
        }
    }
?>

<body class="d-flex">
    <main class="d-flex m-auto">
        <div id="leftDiv">
            <a class="d-contents" href="#" id="link">
                <img class="p mb rounded-circle" src=<?php echo SVG."padlock-unlocked.svg" ?> alt="" id="toggleImage">
            </a>
            <strong id="toggleText">¿Forgot your password?</strong>
            <p id="paragraph">Select yhe icon to see instructions.</p>
        </div>
        <form action="/login/" id="rightDiv" method="post">
            <strong style="font-size: 20px;">Hello again!</strong>
            <p><?php echo $msg ?></p>
            <input id="username" name="username" class="form-control" type="text" required placeholder="User">
            <input id="password" name="password" class="form-control" type="password" required placeholder="Password">
            <button type="submit" class="btn-primary">Login</button>
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>