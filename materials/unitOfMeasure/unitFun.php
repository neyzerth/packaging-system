<?php
    require_once "../../config.php";

    function getUnitByCode($code) {
        $db = connectdb();
        $query = "SELECT * FROM unit_of_measure WHERE code = '$code'";
        $result = mysqli_query($db, $query);
        $tag = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $tag;
    }

    function getUnits() {
        $db = connectdb();
        $query = "SELECT * FROM unit_of_measure";

        return $result = mysqli_query($db, $query);
    }

    function addUnit($code, $description){
        $db = connectdb();

        $stmt = $db->prepare("CALL addUnit_of_measure(?,?)");

        if ($stmt === false) {
            die('Query preparation error: '. htmlspecialchars($db->error));
        }
        $stmt->bind_param("ss", $code, $description);

        $result = $stmt->execute();
        $stmt->close();
        $db->close();
    
        return $result;
    }

    function updateUnit($code, $description){
        $db = connectdb();
        $stmt = $db->prepare("CALL updateUnit_of_measure(?,?)");
        if ($stmt === false) {
            die('Query preparation error: ' . htmlspecialchars($db->error));
            }
        $stmt->bind_param("ss", $code, $description);

        $result = $stmt->execute();
        if(!$result){
            echo "Execution error: ". htmlspecialchars($stmt->error);
        }
        $stmt->close();
        $db->close();
        return $result;
    }

    function searchUnit($search){
        $db = connectdb();
        
        $search = $db->real_escape_string($search);

        $query = "SELECT * FROM unit_of_measure WHERE code LIKE '%$search%'";
        $result = $db->query($query);
        
        $units = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $units[] = $row;
            }
        }
        
        return $units;
    }
?>