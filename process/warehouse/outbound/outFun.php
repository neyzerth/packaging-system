<?php
    require_once "../../../config.php";

    function getOuts() {
        $db = connectdb();
        $query = "SELECT * FROM vw_outbound_info";
        $result = mysqli_query($db, $query);
        $outs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $outs[] = $row;
            }
            mysqli_close($db);
            return $outs;
    }
?>