<?php
    require_once "../config.php";
    function addBox($height, $width, $length, $weight) {
        $db = connectdb();
        $query = "call addBox(" . "$height, $width," . "$length, $weight, " . ");";
        try {
            return mysqli_query($db, $query);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    function getBoxes() {
        $db = connectdb();
        $query = "SELECT num, height, width, length, volume, weight FROM vw_box_info;";
        return mysqli_query($db, $query);
    }
?>