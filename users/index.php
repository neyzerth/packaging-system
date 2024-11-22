<?php 
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    require_once "../config.php";
    include HEAD;
    
    crudRedirect($action,
        "listUsers.php", "addUser.php", "editUser.php"
    );

    include FOOT;
?>