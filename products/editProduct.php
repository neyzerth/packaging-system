<?php
    require "prodFun.php";

    $protocols=getProtocols();

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $product = getProductByCode($code);
        if (!$product) {
            echo "Product not found";
            exit;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST['code'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];
        $active = 1; 
        $packaging_protocol = $_POST['packaging_protocol'];

        if(updateProduct(code:$code, name:$name, description:$description, height:$height, width:$width, length:$length, weight:$weight, active:$active, packaging_protocol:$packaging_protocol)){
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Product updated successfully..</span></div>";
        } else {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Error updating product</span></div>";
        }
    }
?>
<head>
    <script src="productForm.js"></script>
</head>

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
                    <a class="btn" href="disableProduct.php?code=<?php echo $product['code']; ?>" onclick="return confirm('¿Are you sure you want to disable this product?');">Disable</a>
                </div>
            </div>
            <div class="rows">
                <div class="row-sm-3">
                    <h4 for="code">Code</h4>
                    <div class="inputs">
                        <input name="code" id="code" type="text" value="<?php echo $product['code']; ?>" required maxlength="5">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="name">Product Name</h4>
                    <div class="inputs">
                        <input name="name" id="name" type="text" value="<?php echo $product['name']; ?>" required maxlength="50">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="description">Description</h4>
                    <div class="inputs">
                        <input name="description" id="description" type="text" placeholder="fragile" value="<?php echo $product['description']; ?>" required maxlength="255">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="height">Height</h4>
                    <div class="inputs">
                        <input name="height" id="height" type="number" value="<?php echo $product['height']; ?>" required >
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="width">Width</h4>
                    <div class="inputs">
                        <input name="width" id="width" type="number" value="<?php echo $product['width']; ?>" required >
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="length">Length</h4>
                    <div class="inputs">
                        <input name="length" id="length" type="number" value="<?php echo $product['length']; ?>" required >
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="weight">Weight</h4>
                    <div class="inputs">
                        <input name="weight" id="weight" type="number" placeholder="999" value="<?php echo $product['weight']; ?>" required maxlength="10">
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="packaging_protocol">Packaging Protocol</h4>
                    <div class="inputs">
                        <select class="input" required name="packaging_protocol" id="packaging_protocol options">
                            <?php 
                            while ($protocol = mysqli_fetch_assoc($protocols)):  
                                $selected = $product['packaging_protocol'] === $protocol['num'] ? 'selected' : '';
                                echo "<option value='{$protocol['num']}' $selected>{$protocol['file_name']}</option>";
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
<script>
        setTimeout(() => {
            const successMsg = document.getElementById('success-msg');
            const errorMsg = document.getElementById('error-msg');
            if (successMsg) successMsg.style.display = 'none';
            if (errorMsg) errorMsg.style.display = 'none';
        }, 3000);
    </script>