<?php
    require_once "../../config.php";

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
        } catch (mysqli_sql_exception $e) {
            $db->close();
            return [
                'success' => 0,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ];
        }
    }

?>