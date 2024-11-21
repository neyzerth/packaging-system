<?php
    require_once "../../../config.php";

    function getZones() {
        $db = connectdb();
        $query = "SELECT * FROM vw_zone_info";
        $result = mysqli_query($db, $query);
        $zones = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $zones[] = $row;
            }
            mysqli_close($db);
            return $zones;
    }
?>