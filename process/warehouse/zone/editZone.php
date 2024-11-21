<?php
    require_once("../../../config.php");
    require "zoneFun.php";

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $zone = getZoneByCode($code);

        if (!$zone) {
            echo "Zone not found";
            exit;
        }         
    }

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $code = $_POST['code'];
        $area = $_POST['area'];
        $available_capacity = $_POST['available_capacity'];
        $total_capacity = $_POST['total_capacity'];
        $active = 1;

        if($result = updateZone(code: $code, area: $area, available_capacity: $available_capacity, total_capacity: $total_capacity, active: $active)){
            echo "Zone updated successfully";
        } else {
            echo "Error updating zone";
        }
    }
?>
    <main class="forms">
        <div class="background">

            <a href="disableZone.php?code=<?php echo $zone['code']; ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar esta zona?');">Disable</a>

            <form class="form" action="" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Zones</h1>
                </header>
                <h2>Zone</h2>
                <div class="rows">
                    <div class="row-sm-3">
                        <h4 for="code">Code</h4>
                        <div class="inputs">
                            <input name="code" id="code" type="text" required maxlength="5" value="<?php echo $zone['code']; ?>">
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="material_name">Area</h4>
                        <div class="inputs">
                            <input name="area" id="material_name" type="text" required maxlength="50" value="<?php echo $zone['area']; ?>">
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="description">Available capacity</h4>
                        <div class="inputs">
                            <input name="available_capacity" id="description" type="number" placeholder="999" required maxlength="10"value="<?php echo $zone['available_capacity']; ?>">
                        </div>
                    </div>
                        <h4 for="available_quantity">Total capacity</h4>
                        <div class="inputs">
                            <input name="total_capacity" id="available_quantity" type="number" placeholder="999" required maxlength="10"value="<?php echo $zone['total_capacity']; ?>">
                        </div>
                <footer class="footer">
                    <button class="btn-primary" type="submit">Update</button>
                </footer>
            </form>
        </div>
    </main>