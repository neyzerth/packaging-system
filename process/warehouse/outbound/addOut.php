<?php
    require "outFun.php";
    session_start();
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $date = $_POST['date'];
        $exit_quantity = $_POST['exit_quantity'];

        if($result = addOut(date:$date, exit_quantity:$exit_quantity)){
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
        header("Location: /process/warehouse/outbound");
        exit();
    }
?>
<head>
    <script src="outForm.js"></script>
</head>

    <main class="forms">
        <div class="background">
            <form class="form" action="?a=add" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Add Outbond</h1>
                </header>
                <hr>
                <h2>Outbond</h2>
                <div class="rows">
                    <div class="row-md-5">
                        <h4 for="date">Date</h4>
                        <div class="inputs">
                            <input name="date" id="date" type="date" required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="exit_quantity">Exit quantity</h4>
                        <div class="inputs">
                            <input name="exit_quantity" id="exit_quantity" type="number" required maxlength="10">
                        </div>
                    </div> 
                </div>
                <hr>            
                <footer class="footer">
                    <button class="btn-primary" type="submit">Confirm</button>
                </footer>
            </form>
        </div>
    </main>
    <?php include FOOT ?>