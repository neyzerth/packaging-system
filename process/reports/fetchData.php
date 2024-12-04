<?php
require_once "../../config.php";

if (isset($_GET['view'])) {
    $view = $_GET['view'];
    $db = connectdb();

    try {
        $query = "SELECT * FROM $view";
        $result = mysqli_query($db, $query);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        mysqli_close($db);
        echo json_encode($data);

    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to fetch data: " . $e->getMessage()]);
    }
}
?>
