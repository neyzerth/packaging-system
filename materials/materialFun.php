<?php
    require_once "../config.php";

    function addMaterial($code, $material_name, $description, $available_quantity, $unit_of_measure){
        $db = connectdb();

        $query = "call sp_insertMaterial("."
        '$code','$material_name'"."
        '$description','$available_quantity'"."
        '$unit_of_measure'"." 
        );";

        echo "<p>$query</p>";

        try {
            $response = mysqli_query($db, $query);
            return "Material registrado con exito";
        } catch (Exception $e) {
            return "". $e->getMessage();
        }
    } 

    function getMaterial(){
        $db = connectdb();
        $query = "SELECT num, material_name, description, available_quantity, unit_of_measure FROM vw_material_info;";
        $result = mysqli_query($db, $query);

        $materials = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $materials[] = $row;
        }

        mysqli_close($db);

        return $materials;
    }

    function getUnitMeasure(){
        $db = connectdb();
        $query = "SELECT code, description FROM unit_of_measure;";
    
        return mysqli_query($db, $query);
    }
?>