<?php
    require_once "../../config.php";

    function getPackagings() {
        $db = connectdb();
        $query = "SELECT * FROM packaging";
        $result = $db->query($query);
        $packagings = [];
        while ($row = $result->fetch_assoc()) {
            $packagings[] = $row;
        }
        mysqli_close($db);
        return $packagings;
    }

    function addPackaging($code, $height, $width, $length, $weight, $package_quantity, $zone, $tag) {
        $db = connectdb();
        try {
            $stmt = $db->prepare("CALL addPackaging(?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                throw new Exception("Error preparing statement: " . htmlspecialchars($db->error));
            }
            $stmt->bind_param("sddddisi", $code, $height, $width, $length, $weight, $package_quantity, $zone, $tag);
            $stmt->execute();
            
            $result = $stmt->get_result();
            if ($result) {
                $row = $result->fetch_assoc();
                $stmt->close();
                $db->close();
                return [
                    'success' => $row['success'],
                    'message' => $row['message']
                ];
            } else {
                throw new Exception("No result returned from procedure.");
            }
        } catch (Exception $e) {
            $db->close();
            return [
                'success' => 0,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
    

    function getZones() {
        $db = connectdb();
        $query = "SELECT * FROM zone";

        return $result = mysqli_query($db, $query);
    }

    function getTags() {
        $db = connectdb();
        $query = "SELECT * FROM tag";

        return $result = mysqli_query($db, $query);
    }

    function getOuts() {
        $db = connectdb();
        $query = "SELECT * FROM outbound";

        return $result = mysqli_query($db, $query);
    }
?>