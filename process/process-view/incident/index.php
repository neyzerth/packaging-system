<?php
$action = isset($_GET['a']) ? $_GET['a'] : null;

require_once "../../config.php";
include HEAD;

crudRedirect($action,
    "listIncidents.php", "addIncident.php", "editIncident.php"
);

include FOOT;
?>