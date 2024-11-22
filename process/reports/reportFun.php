<?php
    require_once "../../config.php";

    function addIncident($date, $description,           $traceability)  {
        $db = connectdb();
        $query = "CALL addIncident("."'$date',
        '$description', '$traceability'".");";

        echo "<p>$query</p>";
        return $db->query($query);
    }
    function getIncident() {
        $db = connectdb();
        $query = "SELECT num ,date, description, traceability FROM vw_incident_info";
        $result = mysqli_query($db, $query);
        $incidents = [];
        while ($row = mysqli_fetch_assoc($result)) {
                $incidents[] = $row;
            }
        mysqli_close($db);
        return $incidents;
    }

    function getTraceabilityIncident() {
        $db = connectdb();
        $query = "SELECT * FROM vw_traceability_info";
        $result = mysqli_query($db, $query);
        if (!$result) {
            die('Error en la consulta: ' . mysqli_error($db));
        }
    
        $traceabilities = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $traceabilities[] = $row;
        }
    
        mysqli_close($db);
        return $result;
    }
    
    function getIncidentByNumber($num) {
        $db = connectdb();
        $query = "SELECT * FROM vw_incident_info WHERE num = '$num';";
        $result = mysqli_query($db, $query);
        $incident = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $incident;
    }

    //num, date, description, traceability
    function updateIncident($num, $date, $description, $traceability) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL UpdateIncident(?, ?, ?, ?)");
        
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
        }
    
        // Vincular los parámetros
        $stmt->bind_param("issi", $num, $date, $description, $traceability);
        
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