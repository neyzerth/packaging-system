<?php
    require_once "../../config.php";

    function addPackagingProtocol($name, $file) {
        try {
            $file_name = $file['name'];
            $name = $name == "" ? pathinfo($file['name'], PATHINFO_FILENAME) : $name;
            $destination = PDFDIR . "/$file_name";
            $tempDest = $file['tmp_name'];
    
            if (move_uploaded_file($tempDest, $destination)) {
                $db = connectdb(); 
                $stmt = $db->prepare("CALL addPackagingProtocol(?, ?)");
                if ($stmt === false) {
                    return false;
                }
                $stmt->bind_param("ss", $name, $file_name);
                if (!$stmt->execute()) {
                    return false;
                }
                $stmt->close();
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    
    function getProtocols() {
        $db = connectdb();
        $stmt = $db->prepare("SELECT * FROM packaging_protocol WHERE active = 1");
        
        if ($stmt === false) {
            return false;
        }
    
        if (!$stmt->execute()) {
            return false;
        }
    
        $result = $stmt->get_result();
        $stmt->close();
        
        return $result;
    }
    function getProtocolByNumber($num) {
        $db = connectdb();
        $stmt = $db->prepare("SELECT * FROM packaging_protocol WHERE num = ?");
        
        if ($stmt === false) {
            return false;
        }
    
        $stmt->bind_param("i", $num);
        $stmt->execute();
        $result = $stmt->get_result();
        $protocol = $result->fetch_assoc();
        $stmt->close();
        
        return $protocol;
    }

        //num, name, file_name, active
        function updateProtocol($num, $name, $file_name) {
            $db = connectdb();
            try {
                $stmt = $db->prepare("CALL UpdateProtocol(?, ?, ?)");
                
                if ($stmt === false) {
                    throw new Exception('Error in query preparation: ' . htmlspecialchars($db->error));
                }
        
                $stmt->bind_param("iss", $num, $name, $file_name);
                
                if (!$stmt->execute()) {
                    throw new Exception("Execution error: " . htmlspecialchars($stmt->error));
                }
                
                $result = true; 
            } catch (Exception $e) {
                $result = false;
                echo $e->getMessage();
            } finally {
                $stmt->close();
                $db->close();
            }
            
            return $result; 
        }

 function disableProtocol($num) {
    $db = connectdb();
    try {
        $stmt = $db->prepare("CALL dropProtocol(?)");
        
        if ($stmt === false) {
            throw new Exception('Error in query preparation: ' . htmlspecialchars($db->error));
        }
    
        $stmt->bind_param("i", $num);
        
        if (!$stmt->execute()) {
            throw new Exception("Execution error: " . htmlspecialchars($stmt->error));
        }
        
        $result = true; 
    } catch (Exception $e) {
        $result = false;
        echo $e->getMessage();
    } finally {
        $stmt->close();
        $db->close();
    }
    
    return $result; 
}

    
        /*function searchprotocol($search){
            $db = connectdb();
            
            $search = $db->real_escape_string($search);

            $query = "SELECT * FROM packaging_protocol WHERE num = $search";
            $result = $db->query($query);
            
            $protocols = [];
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $protocols[] = $row;
                }
            }
            
            return $protocols;
        }*/
?>