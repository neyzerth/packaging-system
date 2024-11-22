<?php
    require "prodFun.php";

    $protocols = getProtocols();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $code = $_POST['code'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];
        $packaging_protocol = $_POST['packaging_protocol'];

        $result = addProduct(
            code: $code, name: $name, description: $description,
            height: $height, width: $width, 
            length: $length, weight: $weight, packaging_protocol: $packaging_protocol
        );

        if($result){
            echo '<h2>Product registered</h2>';
        } else {
            echo "<h2>Error</h2>";
        }

    }

?>

<main class="forms">
    <div class="background">
        <form class="form" action="" method="post" autocomplete="off">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Products</h1>
            </header>
            <h2>Products</h2>
            <div class="rows">
                <div class="row-sm-3">
                    <h4 for="code">Code</h4>
                    <div class="inputs">
                        <input name="code" id="code" type="text" required maxlength="5">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="name">Product Name</h4>
                    <div class="inputs">
                        <input name="name" id="name" type="text" required maxlength="50">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="description">Description</h4>
                    <div class="inputs">
                        <input name="description" id="description" type="text" placeholder="fragile" required maxlength="255">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="code">Code</h4>
                    <div class="inputs">
                        <input name="code" id="code" type="text" required maxlength="5">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="name">Product Name</h4>
                    <div class="inputs">
                        <input name="name" id="name" type="text" required maxlength="50">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="description">Description</h4>
                    <div class="inputs">
                        <input name="description" id="description" type="text" placeholder="fragile" required maxlength="255">
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="available_quantity">Quantity</h4>
                    <div class="inputs">
                        <input name="available_quantity" id="available_quantity" type="number" placeholder="999" required maxlength="10">
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="unit_of_measure">Unit of measure</h4>
                    <div class="inputs">
                        <select class="input" required name="unit_of_measure" id="unit_of_measure options">
                            <?php 
                                while ($unit_of_measure = mysqli_fetch_assoc($unit_of_measures)):   
                                    echo "<option value='{$unit_of_measure['code']}'>{$unit_of_measure['description']}</option>";
                                endwhile; 
                            ?>
                        </select>
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

        

