<?php
    require_once "../../config.php";
    function addMaterial($code, $name, $description, $available_quantity, $unit_of_measure) {
        $db = connectdb();

        $stmt = $db->prepare("CALL addMaterial(?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Error: ' . htmlspecialchars($db->error));
        }
        $stmt->bind_param("sssis", $code, $name, $description, $available_quantity, $unit_of_measure);
        $result = $stmt->execute();
        $stmt->close();
        $db->close();
        return $result;
    }

    function getMaterial() {
        $db = connectdb();
        $query = "SELECT * FROM material WHERE active = 1;";
        $result = mysqli_query($db, $query);
        $materials = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $materials[] = $row;
        }
        mysqli_close($db);
        return $materials;
    }
    function getUnitMeasure() {
        $db = connectdb();
        $query = "SELECT code, description FROM unit_of_measure;";
        return mysqli_query($db, $query);
    }

    function getMaterialByCode($code) {
        $db = connectdb();
        $query = "SELECT * FROM material WHERE code = '$code';";
        $result = mysqli_query($db, $query);
        $material = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $material;
    }

    function updateMaterial($code, $name, $description, $available_quantity, $active, $unit_of_measure) {
        $db = connectdb();
        try {
            $stmt = $db->prepare("CALL UpdateMaterial(?, ?, ?, ?, ?, ?)");
            
            if ($stmt === false) {
                throw new Exception('Query preparation error: ' . htmlspecialchars($db->error));
            }
            
            $stmt->bind_param("sssiis", $code, $name, $description, $available_quantity, $active, $unit_of_measure);
            
            $result = $stmt->execute();
            
            if ($result) {
                $resultMessage = $stmt->get_result();
                if ($resultMessage) {
                    $row = $resultMessage->fetch_assoc();
                    return [
                        'success' => $row['success'],
                        'message' => $row['message']
                    ];
                } else {
                    return [
                        'success' => 0,
                        'message' => 'No response was obtained from the procedure.'
                    ];
                }
            } else {
                return [
                    'success' => 0,
                    'message' => 'Error in the execution of the procedure.'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        } finally {
            $stmt->close();
            $db->close();
        }
    }

    function disableMaterial($code) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL dropMaterial(?)");
        
        if ($stmt === false) {
            die('Query preparation error: ' . htmlspecialchars($db->error));
        }
    
        $stmt->bind_param("s", $code);
        
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

    function searchMaterial($search){
        $db = connectdb();
        
        $search = $db->real_escape_string($search);

        $query = "SELECT * FROM material WHERE code LIKE '%$search%'";
        $result = $db->query($query);
        
        $materials = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $materials[] = $row;
            }
        }
        
        return $materials;
    }
?>