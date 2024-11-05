<?php
define("URL","{$_SERVER['HTTP_HOST']}");
define("ROOT","{$_SERVER['DOCUMENT_ROOT']}/packaging-system/");
define("STYLE","../styles/");
define("HEADER",ROOT."/structures/header.php");
define("FOOTER",ROOT."/structures/footer.php");
define("SIDEBAR",ROOT."/structures/sidebar.php");
define("SVG","/structures/svg/");
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
