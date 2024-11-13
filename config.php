<?php
define("URL", "http://{$_SERVER['HTTP_HOST']}/");
define("ROOT", "{$_SERVER['DOCUMENT_ROOT']}/");

define("STYLE", "/styles/");

define("HEAD", ROOT . "home/head.php");
define("HEADER", ROOT . "home/header.php");
define("FOOTER", ROOT . "home/footer.php");
define("SIDEBAR", ROOT . "structures/sidebar.php");
define("SVG", "/structures/svg/");
define("IMG", "/structures/img/");

include 'dbconfig.php';

function connectdb()
{

    try {
        $db = mysqli_connect(DBHOST, DBUSER, DBPASSW, DBNAME);
        //echo "<p>Conectado<p>";
        return $db;
    } catch (Exception $e) {
        echo "<p>Conection Error: {$e->getMessage()}<p>";
        return false;
    }
}
function validateSession(){
    session_start();
    if(!isset($_SESSION['num'])){
        header("Location: /login/");
        exit();
    }
}
function nullDb($param)
{
    return $param == '' ? "NULL" : $param;
}
