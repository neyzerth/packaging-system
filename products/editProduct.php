<?php
    require_once("../config.php");
    require "prodFun.php";

    $protocols=getProtocols();

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $product = getProductByCode($code);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];
        $active = 1; 
        $packaging_protocol = $_POST['packaking_protocol'];

        if (updateProduct($code, $name, $description, $height, $width, $length, $weight, $active, $packaging_protocol)) {
            echo "Material actualizado con éxito.";
        } else {
            echo "Error al actualizar el producto.";
        }
    }
?>
<main class="tables">
    <div class="background">
        <table class="table">
            <form action="editProduct.php" method="POST" autocomplete="off">
                <input type="hidden" name="code" value="<?php echo $product['code']; ?>">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
                
                <label>Description:</label>
                <textarea name="description" required><?php echo $product['description']; ?></textarea>
                
                <label>Height:</label>
                <input type="number" name="height" value="<?php echo $product['height']; ?>" required>

                <label>Width:</label>
                <input type="number" name="width" value="<?php echo $product['width']; ?>" required>

                <label>Length:</label>
                <input type="number" name="length" value="<?php echo $product['length']; ?>" required>

                <label>Weight:</label>
                <input type="number" name="weight" value="<?php echo $product['weight']; ?>" required>
                
                <label for="supervisor">Protocol</label>
                    <select name="packaging_protocol" id="supervisor">
                    <?php 
                    while ($protocol = mysqli_fetch_assoc($protocols)):   
                    echo "<option value='{$protocol['num']}'>{$protocol['file_name']}</option>";
                    endwhile; 
                    ?>
                    </select>
                
                <button type="submit">Update</button>
            </form>
        </table>
    </div>
</main>
