<?php
    require_once "../config.php";
    function addMaterial($code, $name, $description, $available_quantity, $unit_of_measure) {
        $db = connectdb();
        try {
            // Ejecutar el procedimiento almacenado
            $query = "CALL addMaterial('$code', '$name', '$description', $available_quantity, '$unit_of_measure');";
            $result = $db->query($query);
            if ($result) {
                $row = $result->fetch_assoc(); 
                return [
                    'success' => $row['success'],
                    'message' => $row['message']
                ];
            } else {
                return [
                    'success' => 0,
                    'message' => 'Error en la ejecución de la consulta.'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        } finally {
            $db->close();
        }
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
        
        $stmt = $db->prepare("CALL UpdateMaterial(?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
        }
    
        // Vincular los parámetros
        $stmt->bind_param("sssiis", $code, $name, $description, $available_quantity, $active, $unit_of_measure);
        
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

    function disableMaterial($code) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL dropMaterial(?)");
        
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