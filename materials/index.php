<?php
$action = isset($_GET['a']) ? $_GET['a'] : null;

require_once "../config.php";
include HEAD;

crudRedirect($action, "listMaterial.php", 
    "addMaterial.php", "editMaterial.php"
);

include FOOT;
?>