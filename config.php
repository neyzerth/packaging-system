<?php
    define("URL", "http://{$_SERVER['HTTP_HOST']}/");
    define("ROOT", "{$_SERVER['DOCUMENT_ROOT']}/");
    define("HEAD", ROOT . "home/head.php");
    define("ASIDE", ROOT . "home/aside.php");
    define("HOME", ROOT . "home/home.php");
    define("FOOT", ROOT . "home/foot.php");
    define("HEADER", ROOT . "home/header.php");
    define("FOOTER", ROOT . "home/footer.php");
    define("JS", "/src/js/");
    define("CSS", "/src/css/");
    define("SVG", "/src/svg/");
    define("IMG", "/src/img/");
    function connectdb() {
        try {
            $db = mysqli_connect("localhost", "root", "", "packaging");
            //echo "<p>Conectado<p>";
            return $db;
        } catch (Exception $e) {
            echo "<p>Conection Error: {$e->getMessage()}<p>";
            return false;
        }
    }
    function validateSession() {
        session_start();
        if(!isset($_SESSION['num'])){
            head("Location: /login/");
            exit();
        }
    }
    function nullDb($param) {
        return $param == '' ? "NULL" : $param;
    }
?>