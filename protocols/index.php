<?php 
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    require_once "../config.php";
    include HEAD;

    crudRedirect($action, 
        "listProtocols.php", "addProtocol.php", "editProtocol.php"
    );
    include FOOT;
?>