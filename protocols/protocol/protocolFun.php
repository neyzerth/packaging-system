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
                $query = "CALL addPackagingProtocol(?, ?)";
                error_log("QUERY ADD PROTOCOL: $query | $name | $file_name");
                $stmt = $db->prepare($query);
                if ($stmt === false) {
                    error_log("Error preparing statement");
                    return false;
                }
                error_log("Prepare query successfully");
                $stmt->bind_param("ss", $name, $file_name);
                if (!$stmt->execute()) {
                    error_log("Error executing statement");
                    return false;
                }
                error_log("Execute query successfully");
                $stmt->close();
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("FATAL ERROR: ".$e->getMessage());
            return false;
        }
        return true;
    }
    
    function getProtocols() {
        try {
            $db = connectdb();
            $stmt = $db->prepare("SELECT * FROM vw_packaging_protocol_info;");
            
            if ($stmt === false) {
                return false;
            }
        
            if (!$stmt->execute()) {
                return false;
            }
        
            $result = $stmt->get_result();
            $stmt->close();
            
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    function getProtocolByNumber($num) {
        try {
            $db = connectdb();
            $stmt = $db->prepare("SELECT * FROM vw_packaging_protocol_info WHERE num = ?");
            
            if ($stmt === false) {
                return false;
            }
        
            $stmt->bind_param("i", $num);
            $stmt->execute();
            $result = $stmt->get_result();
            $protocol = $result->fetch_assoc();
            $stmt->close();
            
            return $protocol;
        } catch (Exception $e) {
            return false;
        }
    }

        //num, name, file_name, active
        function updateProtocol($num, $name, $file_name, $file) {
            $nullFile = empty($file['name']);

            if(!$nullFile && !addPdf($file)){
                return false;
            }
            $db = connectdb();
            try {
                $file_name = $nullFile ? $file_name : $file['name'];
                
                $query = "CALL UpdateProtocol(?, ?, ?)";
                error_log("QUERY: $query [$num | $name | $file_name]");

                $stmt = $db->prepare($query);
                
                error_log("Query prepared succesfully");
                if ($stmt === false) {
                    error_log('Error in query preparation: ' . htmlspecialchars($db->error));
                }
        
                $stmt->bind_param("iss", $num, $name, $file_name);
                error_log("Params prepared succesfully");
                
                if (!$stmt->execute()) {
                    error_log("Execution error: " . htmlspecialchars($stmt->error));
                }
                
                
                $result = true; 
            } catch (Exception $e) {
                $result = false;
                echo $e->getMessage();
            } finally {
                error_log("updated succesfully");

            }
            
            return $result; 
        }

        function addPdf($file){
            try{

                error_log("File Have information? ".isset($file));
                error_log(print_r($file));
                $file_name = $file['name'];
                $destination = PDFDIR . "/$file_name";
                $tempDest = $file['tmp_name'];

                error_log("Moving file [$file_name] to destination: $destination");
                
                if(move_uploaded_file($tempDest, $destination)){
                    error_log("PDF uploaded succesfully");
                    return true;
                } else {
                    error_log("Error uploading PDF");
                    return false;
                }
            } catch(Exception $e){
                error_log("Error adding pdf: ".$e->getMessage());
                return false;
            }
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