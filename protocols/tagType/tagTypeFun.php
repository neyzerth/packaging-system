<?php
    require_once "../../config.php";

    function getTagTypeByCode($code) {
        $db = connectdb();
        $query = "SELECT * FROM tag_type WHERE code = '$code'";
        $result = mysqli_query($db, $query);
        $tag = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $tag;
    }

    function getTagTypes() {
        $db = connectdb();
        $query = "SELECT * FROM tag_type";

        return $result = mysqli_query($db, $query);
    }

    function addTagType($code, $description){
        $db = connectdb();

        $stmt = $db->prepare("CALL addTagType(?,?)");

        if ($stmt === false) {
            die('Query preparation error: ' . htmlspecialchars($db->error));
        }
        $stmt->bind_param("ss", $code, $description);

        $result = $stmt->execute();
        $stmt->close();
        $db->close();
    
        return $result;
    }

    function updateTagType($code, $description){
        $db = connectdb();
        $stmt = $db->prepare("CALL UpdateTagType(?,?)");
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

    /*function searchTagType($search){
        $db = connectdb();
        
        $search = $db->real_escape_string($search);

        $query = "SELECT * FROM tag_type WHERE code LIKE '%$search%'";
        $result = $db->query($query);
        
        $tag_types = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tag_types[] = $row;
            }
        }
        
        return $tag_types;
    }*/
?>