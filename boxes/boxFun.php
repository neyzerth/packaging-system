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
        $query = "SELECT * FROM box WHERE active = 1;";
        return mysqli_query($db, $query);
    }

    function getBoxByNumber($num) {
        $db = connectdb();
        $query = "SELECT * FROM box WHERE num = '$num';";
        $result = mysqli_query($db, $query);
        $protocol = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $protocol;
    }

    //num, height, width, length, volume, weight, active
    function updateBox($num, $height, $width, $length, $weight) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL UpdateBox(?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
        }
    
        // Vincular los parámetros
        $stmt->bind_param("idddd", $num, $height, $width, $length, $weight);
        
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

    function disableBox($num) {
            $db = connectdb();
            
            $stmt = $db->prepare("CALL dropBox(?)");
            
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