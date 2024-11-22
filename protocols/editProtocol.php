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


<main class="forms">
    <div class="background">
        <form class="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Materials</h1>
            </header>
            <h2>Material</h2>
            <div class="rows">
                <div class="row-sm-3">
                    <a class="btn" href="disableProtocol.php?num=<?php echo $protocol['num']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar este protocolo?');">Disable</a>
                </div>
            </div>
            <div class="rows">
                <div class="row-md-5">
                    <h4 for="name">Num</h4>
                    <div class="inputs">
                        <input name="name" id="name" type="text"  value="<?php echo $protocol['num']; ?>" readonly>
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="name">Name of protocol</h4>
                    <div class="inputs">
                        <input name="name" id="name" type="text"  value="<?php echo $protocol['name']; ?>">
                    </div>
                </div>
            </div>
            <div class="rows">
                <div class="row-md-5">
                    <h4 for="name">Actual File</h4>
                    <div class="inputs">
                        <input name="name" id="name" type="text"  value="<?php echo $protocol['file_name']; ?>" readonly>
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="pdf">New file</h4>
                    <input class="inputs" name="pdf" id="pdf" type="file" accept=".pdf" >
                </div>

            </div>
            <hr>
            <footer class="footer">
                <button class="btn-primary" type="submit">Confirm</button>
            </footer>
        </form>
    </div>
</main>

