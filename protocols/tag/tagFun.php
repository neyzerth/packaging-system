<?php
    require_once "../../config.php";

    //funcion para tag_type

    function getTagByNumber($num) {
        $db = connectdb();
        $query = "SELECT * FROM tag WHERE num = $num";
        $result = mysqli_query($db, $query);
        $tag = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $tag;
    }

    function getTags() {
        $db = connectdb();
        $query = "SELECT * FROM tag";

        return $result = mysqli_query($db, $query);
    }

    function getTagTypes(){
        $db = connectdb();
        $query = "SELECT * FROM tag_type";

        return $result = mysqli_query($db, $query);
    }

    function addTag($date, $tag_type, $destination){
        $db = connectdb();

        $stmt = $db->prepare("CALL addTag(?,?,?)");

        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
        }
        $stmt->bind_param("sss", $date, $tag_type, $destination);

        $result = $stmt->execute();
        $stmt->close();
        $db->close();
    
        return $result;
    }

    function updateTag($num, $date, $tag_type, $destination) {
        $db = connectdb();
    
        $stmt = $db->prepare("CALL UpdateTag(?,?,?,?)");
        if ($stmt === false) {
            die('Error in preparing the query: ' . htmlspecialchars($db->error));
        }
    
        $stmt->bind_param("isss", $num, $date, $tag_type, $destination);
    
        $result = $stmt->execute();
    
        if (!$result) {
            echo "Execution error: " . htmlspecialchars($stmt->error);
        }
    
        $stmt->close();
        $db->close();
    
        return $result;
    }
    
?>