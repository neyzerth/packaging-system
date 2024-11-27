<?php
    require "packagingFun.php";

    $quantity = getProcessByID($_SESSION['trac'])['Package_Quantity'];
    $packaging = getProcessByID($_SESSION['trac'])['Packaging'];
    error_log($quantity);

    if($_SERVER['REQUEST_METHOD']=='POST' || !empty($quantity)){

        //$quantity = $_POST['quantity'];

        

        $validate = true;

        $materials = getMaterial();
    
        if($validate){

            // $readonly = "readonly";
            // $disabled = "disabled";

            addPackagesQuan($quantity);
            
        }

        if($_POST['validate'] == "true"){

            $material = $_POST['material'];
            $matQuant = $_POST['mat_quantity'];
            $bool = addMaterialToPackaging($material, $packaging, $matQuant)['Package_Quantity'];
            
            if($bool){
                header("Location: /process/process-view/");
            }
        }
    }

?>

<main class="forms">
    <div class="background">
        <form class="form" action="" method="post" autocomplete="off">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Add Packaging</h1>
            </header>
            <hr>
            <h2>Packages</h2>
            <input type="hidden" name="a" value="addPackaging">
            <div class="rows">
                <div class="row-md-5">
                    <h4 for="product">Packages quantity</h4>
                    <div class="inputs">
                        <input value="<?php echo getProcessByID($_SESSION['trac'])['Package_Quantity']?>" type="number" name="quantity" id="quantity" min="2" required <?php echo $readonly?>>
                    </div>
                </div>
                
                <?php //if(!$validate):?>
                <div class="row-md-5">
                    <div>
                        <button class="btn-primary" type="submit" >Validate</button>
                    </div>
                </div>
                <?php //endif;?>
            </div>
        </form>

        <?php if($validate): ?>
        <form class="form" action="" method="post" autocomplete="off"> 
            <input type="" name="product" id="quantity" value="<?php echo $quantity?>" hidden>
            <input type="" name="validate" id="validate" value="true" hidden>
            <hr>
            <h2>Material</h2>
            <div class="rows">       
                <div class="row-md-5">
                    <h4 for="material">Material</h4>
                    <select name="material" id="material" class="inputs">
                    <?php foreach ($materials AS $material):  ?>
                        <option value="<?php echo $material['code']?>">
                            <?php echo $material['name']." (".$material['unit_of_measure'].")"?>
                        </option>
                    <?php endforeach; ?>
                    </selec>
                </div>
                <div class="row-md-5">
                    <h4 for="mat_quantity">Quantity</h4>
                    <div class="inputs">
                        <input class="input" type="number" name="mat_quantity" id="mat_quantity" value="" required>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <a class="btn-primary" style="text-align: center" href="/process/process-view/" >Go back</a>
                <button class="btn-primary"  type="submit">Confirm</button>
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