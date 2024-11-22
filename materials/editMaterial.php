<?php
    require "materialFun.php";

    $unit_of_measures = getUnitMeasure();
    
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $material = getMaterialByCode($code);

        if (!$material) {
            echo "Material not found";
            exit;
        }         
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];
        $name = $_POST['material_name'];
        $description = $_POST['description'];
        $available_quantity = $_POST['available_quantity'];
        $active = 1; 
        $unit_of_measure = $_POST['unit_of_measure'];

        if (updateMaterial(code: $code, name: $name, description: $description, available_quantity: $available_quantity, active: $active, unit_of_measure: $unit_of_measure)) {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Material actualizado con éxito.</span></div>";
        } else {
            echo "<div class='div-msg' id='error-msg'><span class='msg'>Error al actualizar el material.</span></div>";
        }
    }
?>
    <main class="forms">
        <div class="background">
            <form class="form" action="" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Materials</h1>
                </header>
                <h2>Material</h2>
                <div class="rows">
                    <div class="row-sm-3">
                        <h4 for="code">Code</h4>
                        <div class="inputs">
                            <input name="code" id="code" type="text" value="<?php echo $material['code']; ?>" required maxlength="5">
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="material_name">Name of material</h4>
                        <div class="inputs">
                            <input name="material_name" id="material_name" type="text" value="<?php echo $material['material_name']; ?>" required maxlength="50">
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="description">Description</h4>
                        <div class="inputs">
                            <input name="description" id="description" type="text" placeholder="fragile" value="<?php echo $material['description']; ?>" required maxlength="255">
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="available_quantity">Available Quantity</h4>
                        <div class="inputs">
                            <input name="available_quantity" id="available_quantity" type="number" placeholder="999" value="<?php echo $material['available_quantity']; ?>" required maxlength="10">
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="unit_of_measure">Unit of measure</h4>
                        <div class="inputs">
                            <select class="input" required name="unit_of_measure" id="unit_of_measure options">
                                <?php 
                                    while ($unit = mysqli_fetch_assoc($unit_of_measures)): 
                                        $selected = $material['unit_of_measure'] === $unit['code'] ? 'selected' : '';
                                        echo "<option value='{$unit['code']}' $selected>{$unit['description']}</option>";
                                    endwhile; 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <footer class="footer">
                    <button class="btn-primary" type="submit">Confirm</button>
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