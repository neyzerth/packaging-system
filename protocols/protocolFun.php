<?php
    require_once "../config.php";

    function addPackagingProtocol($name, $file_name) {
        $db = connectdb(); 
    
        $query = "CALL addPackagingProtocol(".
            "'$name',".
            "'$file_name'".
        ");";
    
        //echo "<p>$query</p>"; 
    
        try {
            return mysqli_query($db, $query);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
function getProtocols(){
    $db = connectdb();
    $query = "SELECT num, name, file_name".
        " FROM packaging_protocol;";

        //echo $query;
    return $result = mysqli_query($db, $query);
}