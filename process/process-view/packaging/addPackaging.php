][<?php
    require "packagingFun.php";
    $zones = getZones();
    $outbounds = getOuts();
    $tags = getTags();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $code = $_POST['code'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];
        $package_quantity = $_POST['package_quantity'];
        $zone = $_POST['zone'];
        $tag = $_POST['tag'];

        $result = addPackaging(code:$code, height:$height, width:$width, length:$length, weight:$weight, package_quantity:$package_quantity, zone:$zone, tag:$tag);

        if($result){
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
        header("Location: /process/process-view");
        exit();
    }
?>

<head>
    <script src="packagingForm.js"></script>
</head>

<main class="forms">
    <div class="background">
        <form class="form" action="" method="post" autocomplete="off">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Add Packaging</h1>
            </header>
            <hr>
            <h2>Packaging</h2>
            <div class="rows">
                <div class="row-sm-3">
                    <h4 for="code">Code</h4>
                    <div class="inputs">
                        <input name="code" id="code" type="text" required maxlength="5">
                    </div>
                <div class="row-sm-3">
                    <h4 for="height">Height</h4>
                    <div class="inputs">
                        <input name="height" id="height" type="number" required >
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="width">Width</h4>
                    <div class="inputs">
                        <input name="width" id="width" type="number" required >
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="length">Length</h4>
                    <div class="inputs">
                        <input name="length" id="length" type="number" required >
                    </div>
                </div>
                
                <div class="row-md-5">
                    <h4 for="weight">Weight</h4>
                    <div class="inputs">
                        <input name="weight" id="weight" type="number" placeholder="999" required>
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="package_quantity">Package quantity</h4>
                    <div class="inputs">
                        <input name="package_quantity" id="package_quantity" type="number" placeholder="999" required >
                    </div>
                </div>
                <!-- apartir de aqui serian los select -->
                <div class="row-md-5">
                <h4 for="outbound">Zone</h4>
                    <div class="inputs">
                        <select class="input" required name="zone" id="zone">
                        <?php 
                            while ($zone = mysqli_fetch_assoc($zones)):   
                                echo "<option value='{$zone['code']}'>{$zone['area']}</option>";
                            endwhile; 
                        ?>
                        </select>
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="outbound">Tag</h4>
                    <div class="inputs">
                        <select class="input" required name="tag" id="tag options">
                            <?php 
                                while ($tag = mysqli_fetch_assoc($tags)):   
                                    echo "<option value='{$tag['num']}'>{$tag['barcode']}</option>";
                                endwhile; 
                            ?>
                        </select>
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
