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
        $query = "SELECT num ,date, description, traceability FROM incident";
        $result = mysqli_query($db, $query);
        $incidents = [];
        while ($row = mysqli_fetch_assoc($result)) {
                $materials[] = $row;
            }
        mysqli_close($db);
        return $incidents;
    }
    
?>