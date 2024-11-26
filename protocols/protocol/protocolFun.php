<?php
    require_once "../../config.php";

    function addPackagingProtocol($name, $file) {

        error_log("Starting upload of pdf...");

        $file_name = $file['name'];
        $name = $name == "" ? pathinfo($file['name'], PATHINFO_FILENAME) : $name;
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
                error_log("Upload succesful of: ".$file_name);
                return true;
            } catch (Exception $e) {
                error_log($e->getMessage());
                return false;
            }

        } else {
            error_log("Error upload the pdf: ".$file_name);
            return false;
        }
        
    
        //echo "<p>$query</p>"; 
    
        
    }
    
    function getProtocols(){
        $db = connectdb();
        $query = "SELECT *".
            " FROM packaging_protocol WHERE active = 1;";
            //echo $query;
            return $result = mysqli_query($db, $query);
        }

    function getProtocolByNumber($num) {
            $db = connectdb();
            $query = "SELECT * FROM packaging_protocol WHERE num = '$num';";
            $result = mysqli_query($db, $query);
            $protocol = mysqli_fetch_assoc($result);
            mysqli_close($db);
            return $protocol;
        }

        //num, name, file_name, active
    function updateProtocol($num, $name, $file_name, $active) {
            $db = connectdb();
            
            $stmt = $db->prepare("CALL UpdateProtocol(?, ?, ?, ?)");
            
            if ($stmt === false) {
                die('Error in query preparation:' . htmlspecialchars($db->error));
            }
        
            // Vincular los parámetros
            $stmt->bind_param("issi", $num, $name, $file_name, $active);
            
            // Ejecutar el procedimiento
            if ($stmt->execute()) {
                $result = true; 
            } else {
                $result = false;
                echo "Execution error: " . htmlspecialchars($stmt->error); 
            }
            
            $stmt->close();
            $db->close();
            
            return $result; 
        }

    function disableProtocol($num) {
            $db = connectdb();
            
            $stmt = $db->prepare("CALL dropProtocol(?)");
            
            if ($stmt === false) {
                die('Error in query preparation:' . htmlspecialchars($db->error));
            }
        
            $stmt->bind_param("i", $num);
            
            // Ejecutar el procedimiento
            if ($stmt->execute()) {
                $result = true; 
            } else {
                $result = false;
                echo "Execution error: " . htmlspecialchars($stmt->error); 
            }
            
            $stmt->close();
            $db->close();
            
            return $result; 
        }
?>