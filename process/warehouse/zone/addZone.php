<?php
    require "zoneFun.php";
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $code = $_POST['code'];
        $area = $_POST['area'];
        $available_capacity = $_POST['available_capacity'];
        $total_capacity = $_POST['total_capacity'];

        $result = addZone(code: $code, area: $area, available_capacity: $available_capacity, total_capacity: $total_capacity);
    }
?>
    <main class="forms">
        <div class="background">
            <form class="form" action="?a=add" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Zones</h1>
                </header>
                <h2>Zone</h2>
                <div class="rows">
                    <div class="row-sm-3">
                        <h4 for="code">Code</h4>
                        <div class="inputs">
                            <input name="code" id="code" type="text" required maxlength="5">
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="material_name">Area</h4>
                        <div class="inputs">
                            <input name="area" id="material_name" type="text" required maxlength="50">
                        </div>
                    </div>
                    <div class="row-sm-3">
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
                
                <footer class="footer">
                    <button class="btn-primary" type="submit">Confirm</button>
                </footer>
            </form>
        </div>
    </main>