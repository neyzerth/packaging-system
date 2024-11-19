<?php
    require_once("../config.php");
    require "materialFun.php";
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $material = getMaterialByCode($code);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];
        $name = $_POST['material_name'];
        $description = $_POST['description'];
        $available_quantity = $_POST['available_quantity'];
        $active = 1; 
        $unit_of_measure = $_POST['unit_of_measure'];

        if (updateMaterial($code, $name, $description, $available_quantity, $active, $unit_of_measure)) {
            echo "Material actualizado con éxito.";
        } else {
            echo "Error al actualizar el material.";
        }
    }
?>
<main class="tables">
    <div class="background">
        <a href="disableMaterial.php?code=<?php echo $material['code']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar este material?');">Disable</a>
        <table class="table">
            <form action="editMaterial.php" method="POST" autocomplete="off">
                <input type="hidden" name="code" value="<?php echo $material['code']; ?>">
                <label>Name:</label>
                <input type="text" name="material_name" value="<?php echo $material['name']; ?>" required>
                
                <label>Description:</label>
                <textarea name="description" required><?php echo $material['description']; ?></textarea>
                
                <label>Available Quantity:</label>
                <input type="number" name="available_quantity" value="<?php echo $material['available_quantity']; ?>" required>
                
                <label>Unit of Measure:</label>
                <input type="text" name="unit_of_measure" value="<?php echo $material['unit_of_measure']; ?>" required>
                
                <button type="submit">Update</button>
            </form>
        </table>
    </div>
</main>
