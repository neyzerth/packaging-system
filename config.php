<?php
define("URL","{$_SERVER['HTTP_HOST']}");
define("ROOT","{$_SERVER['DOCUMENT_ROOT']}");
define("STYLE","/styles/");
define("HEADER","/structures/header.php");
define("FOOTER","/structures/footer.php");
define("SIDEBAR","/structures/sidebar.php");
define("IMAGES","/structures/images/");

function connectdb(){

    try {
        $db = mysqli_connect("localhost", "root", "", "packaging");
        //echo "<p>Conectado<p>";
        return $db;
    } catch (Exception $e) {
        echo "<p>Conection Error: {$e->getMessage()}<p>";
        return false;
    }
}

function nullDb($param){
    return $param == '' ? "NULL" : $param;
}
