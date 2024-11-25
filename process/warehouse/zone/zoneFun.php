<?php
    require_once "../../../config.php";

    function getZones() {
        $db = connectdb();
        $query = "SELECT * FROM zone WHERE active = 1";
        $result = mysqli_query($db, $query);
        $zones = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $zones[] = $row;
            }
            mysqli_close($db);
            return $zones;
    }

    function addZone($code, $area, $available_capacity, $total_capacity) {
        $db = connectdb();
        try {
            $stmt = $db->prepare("CALL addZone(?, ?, ?, ?)");
            if ($stmt === false) {
                throw new Exception('Error in preparing the query: ' . htmlspecialchars($db->error));
            }
            $stmt->bind_param("ssii", $code, $area, $available_capacity, $total_capacity);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
    
            $stmt->close();
            $db->close();
    
            return [
                'success' => $row['success'],
                'message' => $row['message']
            ];
        } catch (Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }
    

    function getZoneByCode($code) {
        $db = connectdb();
        $query = "SELECT * FROM vw_zone_info WHERE code = '$code';";
        $result = mysqli_query($db, $query);
        $zone = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $zone;
    }

    function updateZone($code, $area, $available_capacity, $total_capacity, $active) {
        $db = connectdb();
        try {
            $stmt = $db->prepare("CALL UpdateZone(?, ?, ?, ?, ?)");
            if ($stmt === false) {
                throw new Exception('Error in preparing the query: ' . htmlspecialchars($db->error));
            }

            $stmt->bind_param("ssiii", $code, $area, $available_capacity, $total_capacity, $active);
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
    
            $stmt->close();
            $db->close();
    
            return [
                'success' => $row['success'],
                'message' => $row['message']
            ];
        } catch (Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }
    
    

    function disableZone($code) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL dropZone(?)");
        
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
        }
    
        $stmt->bind_param("s", $code);
        
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