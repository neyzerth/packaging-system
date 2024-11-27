<?php
    require_once "../../config.php";

    function getPackagings() {
        $db = connectdb();
        $packagings = [];
        
        try {
            $query = "SELECT * FROM vw_packaging_info";
            $result = $db->query($query);
            
            if ($result === false) {
                throw new Exception("Error executing query: " . $db->error);
            }
            
            while ($row = $result->fetch_assoc()) {
                $packagings[] = $row;
            }
        } catch (Exception $e) {
            echo "Error occurred: " . $e->getMessage();
        } finally {
            mysqli_close($db);
        }
    
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
                return [
                    'success' => $row['success'],
                    'message' => $row['message']
                ];
            } else {
                throw new Exception("No result returned from procedure.");
            }
        } catch (Exception $e) {
            return [
                'success' => 0,
                'message' => 'Error: ' . $e->getMessage()
            ];
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            mysqli_close($db);
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
    
        try {
            $query = "SELECT * FROM vw_outbound_info";
            $result = mysqli_query($db, $query);
            
            if (!$result) {
                throw new Exception("Database Query Error: " . mysqli_error($db));
            }
    
            $outs = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $outs[] = $row;
            }
    
            return $outs;
        } catch (Exception $e) {
            return [
                'success' => 0,
                'message' => 'Error: ' . $e->getMessage()
            ];
        } finally {
            mysqli_close($db);
        }
    }
?>