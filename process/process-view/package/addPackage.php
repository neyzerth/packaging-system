<div?php
    //require "packFun.php";

    //$protocols = getProtocols();

    if($_SERVER['REQUEST_METHOD']=='POST'){

        
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
                <h1>Add Package</h1>
            </header>
            <hr>
            <h2>Products</h2>
            <div class="rows">
                <div class="row-sm-3">
                    <h4 for="name">Product</h4>
                    <div class="inputs">
                        <input name="name" id="name" type="text" required maxlength="50">
                    </div>
                </div>
                <div class="row-sm-3">
                    <h4 for="code">Quantity</h4>
                    <div class="inputs">
                        <input name="code" id="code" type="number" required min="0">
                    </div>
                </div>
                <div class="row-sm-3">
                    <a class="btn"name="validate" id="validate" >Validate</a>
                </div>
            </div>
        </form>
        <form class="form" action="" method="post" autocomplete="off"></form>                
                <div class="row-md-5">
                    <h4 for="weight">Weight</h4>
                    <div class="inputs">
                        <input name="weight" id="weight" type="number" placeholder="999" required maxlength="10">
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="packaging_protocol">Packaging Protocol</h4>
                    <div class="inputs">
                        <select class="input" required name="packaging_protocol" id="packaging_protocol options">
                            <?php 
                                //while ($protocol = mysqli_fetch_assoc($protocols)):   
                                //    echo "<option value='{$protocol['code']}'>{$protocol['name']}</option>";
                                //endwhile; 
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