<?php
    require_once "../../../config.php";

    function getOuts() {
        $db = connectdb();
        
        try {
            $query = "SELECT * FROM vw_outbound_info;";
            $result = mysqli_query($db, $query);
    
            if ($result === false) {
                throw new Exception('Query execution error: ' . htmlspecialchars(mysqli_error($db)));
            }
    
            $outs = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $outs[] = $row;
            }
            
            return $outs;
    
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
    
        } finally {
            mysqli_close($db);
        }
    }

    function getOutboundByNum($num) {
        $db = connectdb();
    
        try {
            echo "num: " . htmlspecialchars($num) . "<br>";
    
            // Cambia la consulta a la tabla 'packaging' donde se busca por 'outbound'
            $query = "SELECT num, package_quantity, zone 
                      FROM packaging 
                      WHERE outbound = '$num';";
            $result = mysqli_query($db, $query);
    
            if ($result === false) {
                throw new Exception('Query execution error: ' . htmlspecialchars(mysqli_error($db)));
            }
    
            $packaging = [];
            while ($pkg_row = mysqli_fetch_assoc($result)) {
                $packaging[] = $pkg_row;
            }
    
            if (empty($packaging)) {
                echo "No packaging found for this outbound.";
            }
    
            return $packaging;
    
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
    
        } finally {
            mysqli_close($db);
        }
    }
    
    

    function updateOutbound($num, $date, $packaging = []) {
        $db = connectdb();
    
        try {
            // 1. Actualizar la fecha del outbound
            $stmt = $db->prepare("UPDATE outbound SET date = ? WHERE num = ?");
            if ($stmt === false) {
                throw new Exception('Query preparation error: ' . htmlspecialchars($db->error));
            }
    
            $stmt->bind_param("si", $date, $num);
            if (!$stmt->execute()) {
                throw new Exception('Execution error: ' . htmlspecialchars($stmt->error)); 
            }
    
            // 2. Remover el `outbound` de los embalajes que ya no están seleccionados
            if (!empty($packaging)) {
                // Primero, remueve el outbound de los embalajes que no están seleccionados
                $placeholders = implode(',', array_fill(0, count($packaging), '?'));
                $update_query = "UPDATE packaging SET outbound = NULL WHERE outbound = ? AND num NOT IN ($placeholders)";
                $update_stmt = $db->prepare($update_query);
    
                if ($update_stmt === false) {
                    throw new Exception('Update preparation error: ' . htmlspecialchars($db->error));
                }
    
                $params = array_merge([$num], $packaging);
                $types = str_repeat('i', count($params));
                $update_stmt->bind_param($types, ...$params);
    
                if (!$update_stmt->execute()) {
                    throw new Exception('Update execution error: ' . htmlspecialchars($update_stmt->error));
                }
    
                // 3. Asignar el outbound a los nuevos embalajes seleccionados
                foreach ($packaging as $pkg_num) {
                    $update_query = "UPDATE packaging SET outbound = ? WHERE num = ?";
                    $update_stmt = $db->prepare($update_query);
                    if ($update_stmt === false) {
                        throw new Exception('Update preparation error: ' . htmlspecialchars($db->error));
                    }
    
                    $update_stmt->bind_param("ii", $num, $pkg_num);
                    if (!$update_stmt->execute()) {
                        throw new Exception('Update execution error: ' . htmlspecialchars($update_stmt->error));
                    }
                }
            }
    
            return true;
    
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
    
        } finally {
            $stmt->close();
            mysqli_close($db);
        }
    }

    function disableOutbound($num) {
        $db = connectdb();
    
        try {
            $stmt = $db->prepare("CALL dropOutBound(?)");
            
            if ($stmt === false) {
                throw new Exception('Query preparation error: ' . htmlspecialchars($db->error));
            }
    
            $stmt->bind_param("i", $num);
    
            if (!$stmt->execute()) {
                throw new Exception('Execution error: ' . htmlspecialchars($stmt->error)); 
            }
    
            return true;
    
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
    
        } finally {
            $stmt->close();
            mysqli_close($db);
        }
    }

    function getZones() {
        $db = connectdb();
        
        try {
            $query = "SELECT DISTINCT zone FROM packaging WHERE zone IS NOT NULL AND zone != ''";
            $result = $db->query($query);
            if (!$result) {
                throw new Exception("Query Error: " . $db->error);
            }
    
            $zones = [];
            while ($row = $result->fetch_assoc()) {
                $zones[] = $row['zone'];
            }
            return $zones;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        } finally {
            $db->close();
        }
    }

    function packagingByZone($zone) {
        $db = connectdb();
    
        try {
            $query = "SELECT num, package_quantity FROM packaging WHERE zone = ? AND outbound IS NULL";
            $stmt = $db->prepare($query);
            if (!$stmt) {
                throw new Exception("Preparation Error: " . $db->error);
            }
    
            $stmt->bind_param('s', $zone);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $packaging = [];
            while ($row = $result->fetch_assoc()) {
                $packaging[] = $row;
            }
            return $packaging;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        } finally {
            $stmt->close();
            $db->close();
        }
    }

    function updatePackagingStatus($packaging_ids, $outbound_id) {
        $db = connectdb();
        $ids = implode(",", array_map('intval', $packaging_ids));
        $query = "UPDATE packaging SET outbound = ? WHERE num IN ($ids)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $outbound_id);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    function getPackagingByZoneAndOutbound($zone, $outbound_num) {
        $db = connectdb();
        $query = "SELECT p.num, p.package_quantity
                  FROM packaging p
                  WHERE p.zone = ? AND p.outbound = ?";
        
        $stmt = $db->prepare($query);
        $stmt->bind_param('si', $zone, $outbound_num);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $packaging = [];
        while ($row = $result->fetch_assoc()) {
            $packaging[] = $row;
        }
    
        $stmt->close();
        $db->close();
        return $packaging;
    }
?>