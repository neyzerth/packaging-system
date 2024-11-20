<?php
    require_once("../config.php");
    require "protocolFun.php";
    
    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        $protocol = getProtocolByNumber($num);

        if (!$protocol || !isset($protocol['num'])) {
            echo "Protocol not found";
            exit;
        }      
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = $_POST['num'];
        $name = $_POST['name'];
        $file_name = $_POST['file_name'];
        $active = 1; 

        if (updateProtocol(num:$num, name:$name, file_name:$file_name, active:$active)) {
            echo "Protocolo actualizado con éxito.";
        } else {
            echo "Error al actualizar el protocolo.";
        }
    }
?>
<main class="tables">
    <div class="background">
        <a href="disableProtocol.php?num=<?php echo $protocol['num']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar este protocolo?');">Disable</a>

        <table class="table">
            <form action="" method="POST" autocomplete="off">
                <label>Protocol Number: </label>
                <input type="number" name="num" value="<?php echo $protocol['num']; ?>" readonly>

                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $protocol['name']; ?>" required>
                
                <label>File name:</label>
                <input type="text" name="file_name" value="<?php echo $protocol['file_name']; ?>" required>
                
                <button type="submit">Update</button>
            </form>
        </table>
    </div>
</main>
