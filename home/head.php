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
    <link rel="stylesheet" href="<?php echo STYLE . "global.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "sidebar.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "home.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "header.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "table.css" ?>">
    <link rel="stylesheet" href="<?php echo STYLE . "forms.css" ?>">
</head>

<body>
    <div class="overlay">
        <img src="<?php echo SVG . "hidden-eye.svg"; ?>">
        <h4>Content blurred due to screen resolution.</h4>
    </div>
    <?php include SIDEBAR; ?>