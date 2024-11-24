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
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Caja actualizado con éxito.</span></div>";

        } else {
            echo "<div class='div-msg' id='error-msg'><span class='msg'>Error al actualizar la caja.</span></div>";
        }
    }
?>
<main class="forms">
    <div class="background">
        <form class="form" action="" method="POST" autocomplete="off">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Boxes</h1>
            </header>
            <a href="disableBox.php?num=<?php echo $box['num']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar esta caja?');">Disable</a>
            
            <div class="rows">
                <div class="row-sm-3">
                    <h4>Box Number</h4>
                    <div class="inputs">
                    <input type="number" name="num" value="<?php echo $box['num']; ?>" readonly>
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4>Height</h4>
                    <div class="inputs">
                    <input type="number" name="height" value="<?php echo $box['height']; ?>" required>

                    </div>
                </div>
                <div class="row-sm-3">
                    <h4>Width</h4>
                    <div class="inputs">
                    <input type="number" name="width" value="<?php echo $box['width']; ?>" required>

                    </div>
                </div>
                <div class="row-md-5">
                    <h4>Length</h4>
                    <div class="inputs">
                    <input type="number" name="length" value="<?php echo $box['length']; ?>" required>

                    </div>
                </div>
                <div class="row-md-5">
                    <h4>Weight</h4>
                    <div class="inputs">
                    <input type="number" name="weight" value="<?php echo $box['weight']; ?>" required>

                    </div>
                </div>
                <!--
                <div class="row-sm-3">
                    <h4></h4>
                    <div class="inputs">
                        
                    </div>
                </div>
                -->
            </div>
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