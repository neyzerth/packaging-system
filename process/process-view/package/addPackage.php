<?php
    require "packageFun.php";

    $products = getProducts();
    $boxes = null;
    
    $quantity = null;


    $quantity = $_GET['quantity'];
    $prodCode = $_GET['product'];
    $product = getProductByCode($prodCode);


    $minVol = $product['height'] * $product['width'] * $product['length'] * $quantity;

    $validate = $product != null;

    if ($validate) {
        $boxes = getBoxesByVol($minVol);
    }
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $boxCode = $_POST['box'];
        $weight = $_POST['weight'];
        $date = $_POST['date'];

        addPackage($prodCode, $quantity, $boxCode);
        

    }

?>

<main class="forms">
    <div class="background">
        <form class="form" action="" method="get" autocomplete="off">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Add Package</h1>
            </header>
            <hr>
            <h2>Products</h2>
            <input type="hidden" name="a" value="addPackage">
            <div class="rows">
                <div class="row-md-5">
                    <h4 for="product">Product</h4>
                    <select class="inputs" id="product" name="product">
                    <?php foreach ($products AS $product):  ?>
                        <option value="<?php echo $product['code']?>">
                            <?php echo $product['name']?> 
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="row-md-5">
                    <h4 for="quantity">Quantity</h4>
                    <div class="inputs">
                        <input name="quantity" id="quantity" type="number" value = "<?php echo $quantity?>" required min="2">
                    </div>
                </div>
                
                <div class="row-md-5">
                    <button class="btn-primary">Validate</button>
                </div>
            </div>
        </form>

        <?php if($validate): ?>
        <form class="form" action="" method="post" autocomplete="off"> 
            <div class="rows">       
                <div class="row-md-5">
                    <h4 for="box">Box</h4>
                    <select name="box" id="box" class="inputs">
                    <?php foreach ($boxes AS $box):  ?>
                        <option value="<?php echo $box['num']?>">
                            <?php echo $box['height'].'cm x'.$box['width'].'cm x'.$box['width'].'cm'?> 
                        </option>
                    <?php endforeach; ?>
                    </selec>
                </div>
                <div class="row-md-5">
                    <h4 for="weight">Weight (kg)</h4>
                    <div class="inputs">
                        <input name="weight" id="weight" type="number" placeholder="999" required maxlength="10">
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="date">Date</h4>
                    <div class="inputs">
                        <input class="input" type="date" name="date" id="date" required>
                    </div>
                </div>
            </div>
            <hr>
            <footer class="footer">
                <button class="btn-primary" type="submit">Confirm</button>
            </footer>
        </form>
        <?php endif; ?>
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