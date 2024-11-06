<?php
    session_start();
    if(!isset($_SESSION['num'])){
        header("Location: /login/");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packakings</title>
    <link rel="stylesheet" href="<?php echo STYLE . "!important.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "!color-palette.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "header.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "home.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "sidebar.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "table.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "forms.css" ?>">
    
</head>

<body class="d-flex">
    <?php include SIDEBAR; ?> 
    <main>