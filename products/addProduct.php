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

    <div class="container">
        <main>
            <div class="py5" style="text-align: center;">
                <svg width="60" height="60" viewBox="0 0 16 16" fill="#5C73F2">
                    <path
                        d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                </svg>
                <h1>Product form</h1>
            </div>
            <div class="row-div">
                <div class="">
                    <form action="addProduct.php" method="post" autocomplete="off">
                        <div class="row-form">
                            <div class="row-md-6">
                                <label for="height">Code</label>
                                <div class="input-group">
                                    <input name="code" id="code" type="text" step="0.01" required maxlength="5">
                                </div>
                            </div>
                            <div class="row-md-6">
                                <label for="width">Product name</label>
                                <div class="input-group">
                                    <input name="name" id="name" type="text" step="0.01" required maxlength="50">
                                </div>
                            </div>
                            <div class="row-md-6">
                                <label for="length">Description</label>
                                <div class="input-group">
                                <textarea name="description" id="description" required maxlength="255" rows="4" cols="50"></textarea>
                                </div>
                            </div>
                            <div class="row-md-6">
                                <label for="height">Height (cm)</label>
                                <div class="input-group">
                                    <input name="height" id="height" type="number" step="0.01" required>
                                </div>
                            </div>
                            <div class="row-md-6">
                                <label for="width">Width (cm)</label>
                                <div class="input-group">
                                    <input name="width" id="width" type="number" step="0.01" required>
                                </div>
                            </div>
                            <div class="row-md-6">
                                <label for="length">Length (cm)</label>
                                <div class="input-group">
                                    <input name="length" id="length" type="number" step="0.01" required>
                                </div>
                            </div>
                            <div class="row-md-6">
                                <label for="weight">Weight (g)</label>
                                <div class="input-group">
                                    <input name="weight" id="weight" type="number" step="0.01" required">
                                </div>
                            </div>
                            <!--PACKAGING PROTOCOL-->
                            <div class="row-md-6">
                                <label for="supervisor">Supervisor</label>
                                <select name="supervisor" id="supervisor">
                                <?php 
                                    while ($protocol = mysqli_fetch_assoc($protocols)):   
                                        echo "<option value='{$protocol['num']}'>{$protocol['file_name']}</option>";
                                    endwhile; 
                                ?>
                                </select>
                            </div>
                        <hr class="border-bottom" style="margin-top: 2rem; margin-bottom: 2rem;">
                        <button class="btn-primary" type="submit">Confirm Registration</button>
                    </form>
                </div>
            </div>
        </main>

