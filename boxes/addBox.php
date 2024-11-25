<?php

    require "boxFun.php";
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];

        $result = addBox(height: $height, width: $width, 
            length: $length, weight: $weight
        );

        if($result){
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Box Registered.</span></div>";
        } else {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Error</span></div>";
        }
    }
?>
<head>
    <script src="boxForm.js"></script>
</head>

    <main class="forms">
        <div class="background">
            <form class="form" action="?a=add" method="post">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Add Boxes</h1>
                </header>
                <hr>
                <h2>Dates</h2>
                <div class="rows">
                    <div class="row-md-5">
                        <h4 for="height">Height (cm)</h4>
                        <div class="inputs">
                            <input name="height" id="height" type="number"  required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="width">Width (cm)</h4>
                        <div class="inputs">
                            <input name="width" id="width" type="number"  required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="length">Length (cm)</h4>
                        <div class="inputs">
                            <input name="length" id="length" type="number"  required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="weight">Weight (g)</h4>
                        <div class="inputs">
                            <input name="weight" id="weight" type="number" required>
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