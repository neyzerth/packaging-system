<?php
    require "boxFun.php";
    //session_start(); 
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];

        $result = addBox(height: $height, width: $width, 
            length: $length, weight: $weight
        );

        if($result){
            $_SESSION['message'] = [
                'text' => 'Box added successfully',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error adding box',
                'type' => 'error'
            ];
        }
        header("Location: /boxes/");
        exit(); 
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
                            <input name="height" id="height" type="number" min="0" step="0.001" required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="width">Width (cm)</h4>
                        <div class="inputs">
                            <input name="width" id="width" type="number"  min="0" step="0.001" required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="length">Length (cm)</h4>
                        <div class="inputs">
                            <input name="length" id="length" type="number" min="0" step="0.001" required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="weight">Weight (g)</h4>
                        <div class="inputs">
                            <input name="weight" id="weight" type="number" min="0" step="0.001" required>
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
    <?php include FOOT ?>