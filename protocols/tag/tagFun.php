<?php
    require_once "../../../config.php";

    //funcion para tag_type

    function getTags() {
        $db = connectdb();
        $query = "SELECT * FROM tag";

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
?>