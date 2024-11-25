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

        if($result = updateOutbound(num:$num, date:$date, exit_quantity:$exit_quantity, active:$active)) {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Out updated successfully</span></div>";
        } else {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Error updating out</span></div>";
        }
    }
?>
    <main class="forms">
        <div class="background">


            <form class="form" action="" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Edit Outbound</h1>
                </header>
                <a class="btn-primary" href="disableOut.php?num=<?php echo $out['num']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar esta salida?');">Disable</a>
                <hr>
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