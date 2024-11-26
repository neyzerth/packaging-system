<?php
    require_once "../../config.php";

    function getReports() {
        $db = connectdb();
        $query = "SELECT * FROM report";
        $result = mysqli_query($db, $query);
        $reports = [];
        while($row = mysqli_fetch_assoc($result)){
            $reports[] = $row;
        }
        mysqli_close($db);
        return $reports;
    }

    function getTraceabilities(){
        $db = connectdb();
        $query = "SELECT * FROM traceability";
        $result = mysqli_query($db, $query);
        return $result;
    }

    function addReport($start_date, $end_date, $report_date, $packed_products, $observations, $traceability) {
        $db = connectdb();
        $stmt = $db->prepare("CALL addReport(?,?,?,?,?,?)");
        if ($stmt === false) {
            die('Query preparation error: '. htmlspecialchars($db->error));
        }
        $stmt->bind_param("sssisi", $start_date, $end_date, $report_date, $packed_products, $observations, $traceability);

        $result = $stmt->execute();
        $stmt->close();
        $db->close();
    
        return $result;
    }

    function searchReport($search){
        $db = connectdb();
        
        $search = $db->real_escape_string($search);

        $query = "SELECT * FROM report WHERE folio = $search";
        $result = $db->query($query);
        
        $reports = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reports[] = $row;
            }
        }
        
        return $reports;
    }
?>