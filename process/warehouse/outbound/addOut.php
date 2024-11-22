<?php
    require "outFun.php";
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $date = $_POST['date'];
        $exit_quantity = $_POST['exit_quantity'];

        $result = addOut(date:$date, exit_quantity:$exit_quantity);
        if($result = updateZone(code: $code, area: $area, available_capacity: $available_capacity, total_capacity: $total_capacity, active: $active)){
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Outbonds updated successfully</span></div>";
        } else {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Error updating zone</span></div>";
        }
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
                    <div class="row-md-5">
                        <h4 for="code">Date</h4>
                        <div class="inputs">
                            <input name="date" id="code" type="date" required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="material_name">Exit quantity</h4>
                        <div class="inputs">
                            <input name="exit_quantity" id="material_name" type="number" required maxlength="10">
                        </div>
                    </div> 
                </div>            
                <footer class="footer">
                    <button class="btn-primary" type="submit">Confirm</button>
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