<?php
    require_once("../config.php");
    require "prodFun.php";

    $protocols=getProtocols();

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $product = getProductByCode($code);
        if (!$product) {
            echo "Product not found";
            exit;
        }
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
        $packaging_protocol = $_POST['packaging_protocol'];

        if (updateProduct(code:$code, name:$name, description:$description, height:$height, width:$width, length:$length, weight:$weight, active:$active, packaging_protocol:$packaging_protocol)) {
            echo "Producto actualizado con éxito.";
        } else {
            echo "Error al actualizar el producto.";
        }
    }
?>
<main class="forms">
    <div class="background">
        <a href="disableProduct.php?code=<?php echo $product['code']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar este producto?');">Disable</a>
        <table class="table">
            <form action="" method="POST" autocomplete="off">
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
                <select name="packaging_protocol">
                    <?php 
                        while ($protocol = mysqli_fetch_assoc($protocols)):  
                            $selected = $product['packaging_protocol'] === $protocol['num'] ? 'selected' : '';
                            echo "<option value='{$protocol['num']}' $selected>{$protocol['file_name']}</option>";
                        endwhile; 
                    ?>
                </select>
                
                <button type="submit">Update</button>
            </form>
    </div>
</main>
