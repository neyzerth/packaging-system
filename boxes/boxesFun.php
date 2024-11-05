<?php

require_once "../config.php";

function addBox(
    $height, $width,
    $lenght, $weight
){
    $db = connectdb();

    $query = "sp_addBox(".
        "$height, $width, $lenght, $weight".
    ")";

    $result = mysqli_query($db, $query);
}

function getBoxes(){
    $db = connectdb();

    $query = "SELECT num, height, width, length, volume, weight FROM vw_box_info;";

    return mysqli_query($db, $query);
}