<?php
    require_once "../../../config.php";

    function getOuts() {
        $db = connectdb();
        $query = "SELECT * FROM outbound WHERE active = 1";
        $result = mysqli_query($db, $query);
        $outs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $outs[] = $row;
            }
            mysqli_close($db);
            return $outs;
    }

    function addOut($date, $exit_quantity) {
        $db = connectdb();
        try {
            $query = "CALL addOutbound ('$date', '$exit_quantity')";
            return $db->query($query);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function getOutboundByNum($num) {
        $db = connectdb();
        $query = "SELECT * FROM vw_outbound_info WHERE num = '$num';";
        $result = mysqli_query($db, $query);
        $out = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $out;
    }

    function updateOutbound($num, $date, $exit_quantity, $active) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL UpdateOutBound(?, ?, ?, ?)");
        
        if ($stmt === false) {
            die('Query preparation error: ' . htmlspecialchars($db->error));
        }
    
        // Vincular los parámetros
        $stmt->bind_param("isii", $num, $date, $exit_quantity, $active);
        
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

    function disableOutbound($num) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL dropOutBound(?)");
        
        if ($stmt === false) {
            die('Query preparation error: ' . htmlspecialchars($db->error));
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