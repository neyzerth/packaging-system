<?php
require "outFun.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $selected_packaging = $_POST['packaging'] ?? []; // Embalajes seleccionados

    $today = date('Y-m-d');
    if ($date < $today) {
        $_SESSION['message'] = [
            'text' => 'Date cannot be in the past.',
            'type' => 'error'
        ];
        header("Location: /process/warehouse/outbound");
        exit();
    }

    if (empty($selected_packaging)) {
        $_SESSION['message'] = [
            'text' => 'No packaging selected.',
            'type' => 'error'
        ];
        header("Location: /process/warehouse/outbound");
        exit();
    }

    // Insertar en la tabla `outbound`
    $db = connectdb();
    $query = "INSERT INTO outbound (date, exit_quantity) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $exit_quantity = count($selected_packaging);
    $stmt->bind_param('si', $date, $exit_quantity);

    if ($stmt->execute()) {
        $outbound_id = $stmt->insert_id; // Obtener el ID del registro creado en `outbound`

        // Actualizar los embalajes seleccionados con el ID de `outbound`
        updatePackagingStatus($selected_packaging, $outbound_id);

        $_SESSION['message'] = [
            'text' => 'Successful registration',
            'type' => 'success'
        ];
    } else {
        $_SESSION['message'] = [
            'text' => 'Error during registration',
            'type' => 'error'
        ];
    }

    $stmt->close();
    $db->close();
    header("Location: /process/warehouse/outbound");
    exit();
}

?>

<!-- <script src="outForm.js"></script> -->

<main class="forms">
    <div class="background">
        <form class="form" action="" method="post" autocomplete="off">
            <header class="header">
                <img src="<?php echo SVG . "icon.svg" ?>">
                <h1>Add Outbound</h1>
            </header>
            <hr>
            <h2>Outbound</h2>
            <div class="rows">
                <div class="row-md-5">
                    <h4 for="date">Date</h4>
                    <div class="inputs">
                        <input name="date" id="date" type="date" required min="<?= date('Y-m-d') ?>">
                    </div>
                </div>
            </div>

            <div class="rows">
                <h4>Select Packaging by Zone</h4>
                <?php
                $zones = getZones();
                if (!empty($zones)) {
                    foreach ($zones as $zone) {
                        echo "<div class='zone'>";
                        echo "<h5>Zone: " . htmlspecialchars($zone) . " <button type='button' class='select-all' data-zone='" . htmlspecialchars($zone) . "'>Select All</button></h5>";
                        
                        $packaging = packagingByZone($zone);
                        if (!empty($packaging)) {
                            echo "<div class='packaging-list' id='zone-" . htmlspecialchars($zone) . "'>";
                            foreach ($packaging as $pkg) {
                                echo "<label>
                                    <input type='checkbox' name='packaging[]' value='" . htmlspecialchars($pkg['num']) . "' class='zone-" . htmlspecialchars($zone) . "'>
                                    Packaging Quantity: " . htmlspecialchars($pkg['package_quantity']) . "
                                </label><br>";
                            }
                            echo "</div>";
                        } else {
                            echo "<p>No packaging available in this zone.</p>";
                        }

                        echo "</div>";
                    }
                } else {
                    echo "<p>No zones available.</p>";
                }
                ?>
            </div>


            <script>
                document.querySelectorAll('.select-all').forEach(button => {
                    button.addEventListener('click', function() {
                        const zone = this.getAttribute('data-zone');
                        const checkboxes = document.querySelectorAll('.zone-' + zone);
                        
                        const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                        
                        // Si todos los checkboxes están seleccionados, deseleccionar todos
                        if (allChecked) {
                            checkboxes.forEach(checkbox => {
                                checkbox.checked = false;
                            });
                            this.textContent = 'Select All';  // Cambiar el texto del botón
                        } else {
                            checkboxes.forEach(checkbox => {
                                checkbox.checked = true;
                            });
                            this.textContent = 'Deselect All';  // Cambiar el texto del botón
                        }
                    });
                });
            </script>

            <hr>
            <footer class="footer">
                <button class="btn-primary" type="submit">Confirm</button>
            </footer>
        </form>
    </div>
</main>