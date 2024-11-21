<?php
    require_once "../config.php";

    function addPackagingProtocol($name, $file) {

        error_log("Starting upload of pdf...");

        $file_name = $name == "" ? $file['name'] : $name.".pdf";
        $destination = PDFDIR . "/$file_name";
        $tempDest = $file['tmp_name'];

        error_log("name:  $file_name | destination: $destination | tempDest: $tempDest");

        if(move_uploaded_file($tempDest, $destination)){
            error_log("Moving...");
            $db = connectdb(); 
            $query = "CALL addPackagingProtocol(".
                "'$name',".
                "'$file_name'".
            ");";

            try {
                mysqli_query($db, $query);
                error_log("Se subio el archivo ".$file_name);
                return true;
            } catch (Exception $e) {
                error_log($e->getMessage());
                return false;
            }

        } else {
            error_log("Error al subir el archivo ".$file_name);
            return false;
        }
        
    
        //echo "<p>$query</p>"; 
    
        
    }
    
function getProtocols(){
    $db = connectdb();
    $query = "SELECT num, name, file_name".
        " FROM packaging_protocol;";
        //echo $query;
        return $result = mysqli_query($db, $query);
    }
?>