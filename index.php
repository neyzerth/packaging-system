

<h1>AQUI DEBE SER EL HOME</h1>
<?php
include("config.php");

var_dump($_SERVER);
echo "<p>{$_SERVER['HTTP_HOST']}<p>";
echo "<p>{$_SERVER['REQUEST_URI']}<p>";
echo "<p>{$_SERVER['DOCUMENT_ROOT']}<p>";

echo "<p>".URL."<p>";
echo "<p>".HEADER."<p>";

include "config.php";
    if(!isset($_SESSION['num'])){
        echo'<p>NO LOGUEADO</p>';
        header("Location: /login/");
        exit();
    } else {
        echo'<p>LOGUEADO</p>';
    }
?>

<script>
    alert("AAAAAAAAAAAAA")
</script>
