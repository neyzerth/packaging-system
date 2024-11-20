<?php
    require_once("../config.php");
    require "boxFun.php";
    
    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        $box = getBoxByNumber($num);

        if (!$box || !isset($box['num'])) {
            echo "Box not found";
            exit;
        }      
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = $_POST['num'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];

        if (updateBox(num:$num, height:$height, width:$width, length:$length, weight:$weight)) {
            echo "Caja actualizado con éxito.";
        } else {
            echo "Error al actualizar la caja.";
        }
    }
?>
<main class="tables">
    <div class="background">
        <a href="disableBox.php?num=<?php echo $box['num']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar esta caja?');">Disable</a>

        <table class="table">
            <form action="" method="POST" autocomplete="off">
                <label>Box Number: </label>
                <input type="number" name="num" value="<?php echo $box['num']; ?>" readonly>

                <label>Height:</label>
                <input type="number" name="height" value="<?php echo $box['height']; ?>" required>

                <label>Width:</label>
                <input type="number" name="width" value="<?php echo $box['width']; ?>" required>

                <label>Length:</label>
                <input type="number" name="length" value="<?php echo $box['length']; ?>" required>
                
                <label>Weight:</label>
                <input type="number" name="weight" value="<?php echo $box['weight']; ?>" required>
                
                <button type="submit">Update</button>
            </form>
        </table>
    </div>
</main>
