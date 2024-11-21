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
                die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
            }
        
            // Vincular los parámetros
            $stmt->bind_param("issi", $num, $name, $file_name, $active);
            
            // Ejecutar el procedimiento
            if ($stmt->execute()) {
                $result = true; 
            } else {
                $result = false;
                echo "Error en la ejecución: " . htmlspecialchars($stmt->error); 
            }
            
            $stmt->close();
            $db->close();
            
            return $result; 
        }

    function disableProtocol($num) {
            $db = connectdb();
            
            $stmt = $db->prepare("CALL dropProtocol(?)");
            
            if ($stmt === false) {
                die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
            }
        
            $stmt->bind_param("i", $num);
            
            // Ejecutar el procedimiento
            if ($stmt->execute()) {
                $result = true; 
            } else {
                $result = false;
                echo "Error en la ejecución: " . htmlspecialchars($stmt->error); 
            }
            
            $stmt->close();
            $db->close();
            
            return $result; 
        }
?>