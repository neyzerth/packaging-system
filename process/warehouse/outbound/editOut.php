<?php
    require_once("../../../config.php");
    require "outFun.php";

    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        $out = getOutboundByNum($num);

        if (!$out) {
            echo "Out not found";
            exit;
        }         
    }

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $num = $_POST['num'];
        $date = $_POST['date'];
        $exit_quantity = $_POST['exit_quantity'];
        $active = 1;

        if($result = updateOutbound(num: $num, date: $date, exit_quantity: $exit_quantity, active: $active)){
            echo "Out updated successfully";
        } else {
            echo "Error updating out";
        }
    }
?>
    <main class="forms">
        <div class="background">

            <a href="disableOut.php?num=<?php echo $out['num']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar esta salida?');">Disable</a>

            <form class="form" action="" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Outbounds</h1>
                </header>
                <h2>Outbound</h2>
                <div class="rows">
                    <div class="row-sm-3">
                        <h4 for="code">Num</h4>
                        <div class="inputs">
                            <input name="num" id="code" type="number" required value="<?php echo $out['num']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="material_name">Date</h4>
                        <div class="inputs">
                            <input name="date" id="material_name" type="date" required  value="<?php echo $out['date']; ?>">
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="description">Exit quantity</h4>
                        <div class="inputs">
                            <input name="exit_quantity" id="description" type="number" placeholder="999" required maxlength="10"value="<?php echo $out['exit_quantity']; ?>">
                        </div>
                <footer class="footer">
                    <button class="btn-primary" type="submit">Update</button>
                </footer>
            </form>
        </div>
    </main>