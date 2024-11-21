<?php
    require_once("../config.php");
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
        <form class="form" action="" method="POST" autocomplete="off">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Materials</h1>
            </header>
            <a class="btn-primary" href="disableMaterial.php?code=<?php echo $material['code']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar este material?');">Disable</a>
            <input type="hidden" name="code" value="<?php echo $material['code']; ?>">
            <div class="rows">
                <div class="row-sm-3">
                    <h4>Name</h4>
                    <div class="inputs">
                        <input type="text" name="material_name" value="<?php echo $material['name']; ?>" required>
                    </div>
                </div>

                <div class="row-sm-3">
                    <h4>Available Quantity</h4>
                    <div class="inputs">
                    <input type="number" name="available_quantity" value="<?php echo $material['available_quantity']; ?>" required>

                    </div>
                </div>

                <div class="row-sm-3">
                    <h4>Unit of Measure</h4>
                    <div class="inputs">
                        <select class="input" required name="unit_of_measure">
                            <?php 
                                while ($unit = mysqli_fetch_assoc($unit_of_measures)): 
                                    $selected = $material['unit_of_measure'] === $unit['code'] ? 'selected' : '';
                                    echo "<option value='{$unit['code']}' $selected>{$unit['description']}</option>";
                                endwhile; 
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row-lg-10">
                    <h4>Description</h4>
                    <div class="inputs" style="">
                        <textarea style="resize: none; height: 500px" name="description" required><?php echo $material['description']; ?></textarea>
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