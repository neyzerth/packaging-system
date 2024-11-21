<?php
    require_once("../../config.php");
    require "reportFun.php";

    $traceabilities = getTraceabilityIncident();
    
    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        $incident = getIncidentByNumber($num);

        if (!$incident || !isset($incident['num'])) {
            echo "Incident not found";
            exit;
        }      
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = $_POST['num'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $traceability = $_POST['traceability'];

        if (updateIncident(num:$num, date:$date, description:$description, traceability:$traceability)) {
            echo "Incidente actualizado con éxito.";
        } else {
            echo "Error al actualizar el incidente.";
        }
    }
?>
<main class="tables">
    <div class="background">

        <table class="table">
            <form action="" method="POST" autocomplete="off">
                <label>Incident number: </label>
                <input type="number" name="num" value="<?php echo $incident['num']; ?>" readonly>

                <label>Incident date:</label>
                <input type="date" name="date" value="<?php echo $incident['date']; ?>" required>

                <label>Description:</label>
                <textarea name="description" required><?php echo $incident['description']; ?></textarea>

                <label>Traceability:</label>
                <select name="traceability" required>
                    <?php
                        foreach ($traceabilities as $traceability) {
                            $selected = ($incident['traceability'] === $traceability['num']) ? 'selected' : '';
                            echo "<option value='{$traceability['num']}' $selected>{$traceability['num']}</option>";
                        }
                    ?>
                </select>
                
                <button type="submit">Update</button>
            </form>
        </table>
    </div>
</main>
