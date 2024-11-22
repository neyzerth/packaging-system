<?php
    require "protocolFun.php";

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_FILES['pdf'])){
        $file = $_FILES['pdf'];
        $name  = $_POST['name'];

        error_log("POST PDF: $name - ".$_FILES['pdf']['name']);
        $result = addPackagingProtocol(
            name: $name, file: $file
        );

       

    }

?>

<main class="forms">
    <div class="background">
        <form class="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Materials</h1>
            </header>
            <h2>Material</h2>
            <div class="rows">
                <div class="row-md-5">
                    <h4 for="name">Name of protocol</h4>
                    <div class="inputs">
                        <input name="name" id="name" type="text">
                    </div>
                </div>
                <div class="row-md-5">
                    <h4 for="pdf">File *</h4>
                        <input class="inputs" name="pdf" id="pdf" type="file" accept=".pdf" required >
                </div>

            </div>
            <hr>
            <footer class="footer">
                <button class="btn-primary" type="submit">Confirm</button>
            </footer>
        </form>
    </div>
</main>
