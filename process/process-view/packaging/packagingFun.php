<?php
    require_once "../../config.php";
    require_once __DIR__."/../../../materials/material/materialFun.php";
    require_once __DIR__."/../../../materials/material/materialFun.php";
    require_once __DIR__."/../tracFun.php";

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

    function addPackagesQuan($quantity){
        $db = connectdb();

        $packaging = getTraceabilityByID($_SESSION['trac'])['Packaging_ID'];
        $query = "UPDATE packaging SET package_quantity = $quantity WHERE num = $packaging;";

        try {
            return $result = $db->query($query);
        } catch (\Throwable $th) {
            error_log("ERROR: ".$th->getMessage());
            return false;
        }
    }

    function addMaterialToPackaging($material, $packaging, $quantity){
        $db = connectdb();
        $query = "call addMaterialToPackage('$material', $packaging, $quantity)";
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