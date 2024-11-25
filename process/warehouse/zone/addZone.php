<?php
    require "zoneFun.php";
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $code = $_POST['code'];
        $area = $_POST['area'];
        $available_capacity = $_POST['available_capacity'];
        $total_capacity = $_POST['total_capacity'];

        $result = addZone(code: $code, area: $area, available_capacity: $available_capacity, total_capacity: $total_capacity);
        
        if (empty($code) || empty($area) || $available_capacity === false || $total_capacity === false) {
            echo "<div class='div-msg' id='error-msg'><span class='msg'>Invalid input data</span></div>";
        } else {
            $result = addZone($code, $area, $available_capacity, $total_capacity);

            if ($result['success'] == 1) {
                echo "<div class='div-msg' id='success-msg'><span class='msg'>{$result['message']}</span></div>";
            } else {
                echo "<div class='div-msg' id='error-msg'><span class='msg'>{$result['message']}</span></div>";
            }
        }
    }
?>
    <main class="forms">
        <div class="background">
            <form class="form" action="?a=add" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Add Zone</h1>
                </header>
                <hr>
                <h2>Zone</h2>
                <div class="rows">
                    <div class="row-md-5">
                        <h4 for="code">Code</h4>
                        <div class="inputs">
                            <input name="code" id="code" type="text"  maxlength="5">
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="material_name">Area</h4>
                        <div class="inputs">
                            <input name="area" id="material_name" type="text" required maxlength="50">
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="description">Available capacity</h4>
                        <div class="inputs">
                            <input name="available_capacity" id="description" type="number" placeholder="999" required maxlength="10">
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="available_quantity">Total capacity</h4>
                        <div class="inputs">
                            <input name="total_capacity" id="available_quantity" type="number" placeholder="999" required maxlength="10">
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
    <script>
        setTimeout(() => {
            const successMsg = document.getElementById('success-msg');
            const errorMsg = document.getElementById('error-msg');
            if (successMsg) successMsg.style.display = 'none';
            if (errorMsg) errorMsg.style.display = 'none';
        }, 3000);
    </script>