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

    function addOut($date, $exit_quantity) {
        $db = connectdb();
        
        try {
            $query = "CALL addOutbound ('$date', '$exit_quantity')";
            return $db->query($query);
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            mysqli_close($db);
        }
    }

    function getOutboundByNum($num) {
        $db = connectdb();
    
        try {
            $query = "SELECT * FROM vw_outbound_info WHERE num = '$num';";
            $result = mysqli_query($db, $query);
    
            if ($result === false) {
                throw new Exception('Query execution error: ' . htmlspecialchars(mysqli_error($db)));
            }
    
            $out = mysqli_fetch_assoc($result);
            return $out;
    
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
    
        } finally {
            mysqli_close($db);
        }
    }

    function updateOutbound($num, $date, $exit_quantity, $active) {
        $db = connectdb();
    
        try {
            $stmt = $db->prepare("CALL UpdateOutBound(?, ?, ?, ?)");
            
            if ($stmt === false) {
                throw new Exception('Query preparation error: ' . htmlspecialchars($db->error));
            }
    
            $stmt->bind_param("isii", $num, $date, $exit_quantity, $active);
    
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

    /*function searchOut($search){
        $db = connectdb();
        
        $search = $db->real_escape_string($search);

        $query = "SELECT * FROM outbound WHERE num = $search";
        $result = $db->query($query);
        
        $outs = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $outs[] = $row;
            }
        }
        
        return $outs;
    }*/
?>