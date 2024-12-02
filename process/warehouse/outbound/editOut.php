<?php
    require_once("../../../config.php");
    require "outFun.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
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

        $today = date('Y-m-d');
        if ($date < $today) {
            $_SESSION['message'] = [
                'text' => 'Date cannot be in the past.',
                'type' => 'error'
            ];
            header("Location: /process/warehouse/outbound");
            exit();
        
        }
    
        
        if ($exit_quantity < 0) {
            $_SESSION['message'] = [
                'text' => 'Exit quantity cannot be negative.',
                'type' => 'error'
            ];
            header("Location: /process/warehouse/outbound");
            exit();
        }

        if($result = updateOutbound(num:$num, date:$date, exit_quantity:$exit_quantity, active:$active)) {
            $_SESSION['message'] = [
                'text' => 'Successful registration',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error',
                'type' => 'error'
            ];
        }
        header("Location: /process/warehouse/outbound/");
        exit();
    }
?>
    <script src="outForm.js"></script>

    <main class="forms">
        <div class="background">
            <form class="form" action="" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Edit Outbound</h1>
                </header>
                <?php if(validateUser("ADMIN","SUPER","EMPLO")):?>
                <a class="btn-primary" href="disableOut.php?num=<?php echo $out['num']; ?>" onclick="return confirm('¿Are you sure you want to disable this outbound?');">Disable</a>
                <?php endif; ?>
                <hr>
                <h2>Outbound</h2>
                <div class="rows">
                    <div class="row-sm-3">
                        <h4 for="num">Num</h4>
                        <div class="inputs">
                            <input name="num" id="num" type="number" required value="<?php echo $out['num']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="date">Date</h4>
                        <div class="inputs">
                            <input name="date" id="date" type="date" required  value="<?php echo $out['date']; ?>">
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="exit_quantity">Exit quantity</h4>
                        <div class="inputs">
                            <input name="exit_quantity" id="exit_quantity" type="number" placeholder="17" required maxlength="10"value="<?php echo $out['exit_quantity']; ?>">
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
    <?php include FOOT ?>