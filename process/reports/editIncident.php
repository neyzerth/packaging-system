<?php
    require "reportFun.php";
    if(!validateUser("ADMIN", "SUPER")){
        header("Location: /process/reports");
    }

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
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Incidente actualizado con éxito.</span></div>";

        } else {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Error al actualizar el incidente.</span></div>";

        }
    }
?>
    <main class="forms">
        <div class="background">
            <form class="form" action="" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1></h1>
                </header>
                <h2></h2>
                <div class="rows">
                    <div class="row-sm-3">
                        <h4 for="code">Incident number</h4>
                        <div class="inputs">
                        <input type="number" name="num" value="<?php echo $incident['num']; ?>" readonly>

                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="material_name">Incident date</h4>
                        <div class="inputs">
                        <input type="date" name="date" value="<?php echo $incident['date']; ?>" required>

                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="unit_of_measure">Traceability</h4>
                        <div class="inputs">
                            <select name="traceability" required>
                                <?php
                                    foreach ($traceabilities as $traceability) {
                                        $selected = ($incident['traceability'] === $traceability['num']) ? 'selected' : '';
                                        echo "<option value='{$traceability['num']}' $selected>{$traceability['num']}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="description">Description</h4>
                        <div class="inputs">
                        <textarea name="description" required><?php echo $incident['description']; ?></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <footer class="footer">
                    <button class="btn-primary" type="submit">Update</button>
                </footer>
            </form>
        </div>
    </main>
    <script>
        setTimeout(() => {
            const successMsg = document.getElementById('success-msg');
            const errorMsg = document.getElementById('error-msg');
            if (successMsg) successMsg.style.display = 'none';
            if (errorMsg) errorMsg.style.display = 'none';
        }, 3000);
    </script>