<?php
    require "outFun.php";
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $date = $_POST['date'];
        $exit_quantity = $_POST['exit_quantity'];

        $result = addOut(date:$date, exit_quantity:$exit_quantity);
    }
?>
    <main class="forms">
        <div class="background">
            <form class="form" action="?a=add" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Outbonds</h1>
                </header>
                <h2>Outbond</h2>
                <div class="rows">
                    <div class="row-sm-3">
                        <h4 for="code">Date</h4>
                        <div class="inputs">
                            <input name="date" id="code" type="date" required>
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="material_name">Exit quantity</h4>
                        <div class="inputs">
                            <input name="exit_quantity" id="material_name" type="number" required maxlength="10">
                        </div>
                    </div>             
                <footer class="footer">
                    <button class="btn-primary" type="submit">Confirm</button>
                </footer>
            </form>
        </div>
    </main>