<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/!important.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/!color-palette.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/panel.css?v=<?php echo time(); ?>">

</head>

<body>
    <header>
        <div class="d-flex align-center">
            <form role="search">
                <input class="form-control" type="search" placeholder="Buscar">
            </form>
            <ul class="nav p" style="margin: auto 0;">
                <li>
                    <a href="#">⚙️</a>
                </li>
                <li>
                    <a href="#">✉️</a>
                </li>
                <li>
                    <a href="#">➕</a>
                </li>
                <li>
                    <a href="#">🗑️</a>
                </li>
                <li>
                    <a href="#" onclick="refreshPage()">⭮</a>
                </li>
                <li>
                    <a href="#" id="prevButton" onclick="changeTable(-1)">&#60;</a>
                </li>
                <li>
                    <span id="pageIndicator"></span>
                </li>
                <li>
                    <a href="#" id="nextButton" onclick="changeTable(1)">&#62;</a>
                </li>
            </ul>
        </div>
    </header>