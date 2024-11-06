<?php
function getProtocols(){
    $db = connectdb();
    $query = "SELECT num, name, file_name".
        " FROM packaging_protocol;";

        //echo $query;
    return $result = mysqli_query($db, $query);
}