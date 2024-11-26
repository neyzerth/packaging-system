<?php
    require_once __DIR__."/../config.php";
    function addBox($height, $width, $length, $weight) {
        $db = connectdb();
        $stmt = $db->prepare("CALL addBox (?,?,?,?)");
        if ($stmt === false) {
            die('Error'.htmlspecialchars($db->error));
        }
        $stmt->bind_param("dddd", $height, $width, $length, $weight);

        $result = $stmt->execute();
        $stmt->close();
        $db->close();

        return $result;
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

    function getBoxesByVol($volMin) {
        $db = connectdb();
        $query = "SELECT * FROM box WHERE active = 1 AND volume >= $volMin;";
        return mysqli_query($db, $query);
    }
 
    //num, height, width, length, volume, weight, active
    function updateBox($num, $height, $width, $length, $weight) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL UpdateBox(?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die('Error: ' . htmlspecialchars($db->error));
        }
    
        // Vincular los parámetros
        $stmt->bind_param("idddd", $num, $height, $width, $length, $weight);
        
        // Ejecutar el procedimiento
        if ($stmt->execute()) {
            $result = true; 
        } else {
            $result = false;
            echo "Error: " . htmlspecialchars($stmt->error); 
        }
        
        $stmt->close();
        $db->close();
        
        return $result; 
    }

    function disableBox($num) {
            $db = connectdb();
            
            $stmt = $db->prepare("CALL dropBox(?)");
            
            if ($stmt === false) {
                die('Error: ' . htmlspecialchars($db->error));
            }
        
            $stmt->bind_param("i", $num);
            
            // Ejecutar el procedimiento
            if ($stmt->execute()) {
                $result = true; 
            } else {
                $result = false;
                echo "Error in execution: " . htmlspecialchars($stmt->error); 
            }
            
            $stmt->close();
            $db->close();
            
            return $result; 
        }
?>