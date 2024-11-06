<?php
    require("../config.php");
    require HEAD;
    require "materialFun.php";

    $unit_of_measures = getUnitMeasure();
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $code = $_POST['code'];
        $material_name = $_POST['material_name'];
        $description = $_POST['description'];
        $available_quantity = $_POST['available_quantity'];
        $unit_of_measure = $_POST['unit_of_measure'];

        $result = addMaterial(code: $code, material_name: $material_name,
        description: $description, available_quantity: $available_quantity,
        unit_of_measure: $unit_of_measure);

    }

?>

    <div class="container">
        <main>
            <div class="py5" style="text-align: center;">
                <svg width="60" height="60" viewBox="0 0 16 16" fill="#5C73F2">
                    <path
                        d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                </svg>
                <h1>Material form</h1>
            </div>
            <div class="row-div">
                <div class="">
                    <form action="addMaterial.php" method="post" autocomplete="off">
                        <h2>Material</h2>
                        <div class="row-form">
                            <div class="row-md-6">
                                <label for="code">Code</label>
                                <div class="input-group">
                                    <input name="code" id="code" type="text" required>
                                </div>
                            </div>
                            <div class="row-md-6">
                                <label for="material_name">Name of material</label>
                                <div class="input-group">
                                    <input name="material_name" id="material_name" type="text" required>
                                </div>
                            </div>
                            <div class="row-md-6">
                                <label for="description">Description</label>
                                <div class="input-group">
                                    <input name="description" id="description" type="text" placeholder="fragile" required>
                                </div>
                            </div>
                            <div class="row-lg-12">
                                <label for="available_quantity">Quantity</label>
                                <div class="input-group">
                                    <input name="available_quantity" id="available_quantity" type="number" placeholder="999" required>
                                </div>
                            </div>
                            <!--AQUI VA UN SELECT/LIST CON WHILE-->
                            <div class="row-lg-12">
                                <label for="unit_of_measure">Unit of measure</label>
                                <div class="input-group">
                                    <select required name="unit_of_measure" id="unit_of_measure" class="input-group" name="" id="options">
                                    <?php 
                                        while ($unit_of_measure = mysqli_fetch_assoc($unit_of_measures)):   
                                            echo "<option value='{$unit_of_measure['code']}'>{$unit_of_measure['description']}</option>";
                                        endwhile; 
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="border-bottom" style="margin-top: 2rem; margin-bottom: 2rem;">
                        <button class="btn-primary" type="submit">Confirm</button>
                    </form>
                </div>
            </div>
        </main>
        <footer class="text-center" style="margin-top: 3rem; padding-top: 3rem; margin-bottom: 3rem;">
            <p>© 2024-2025 Packakings</p>
        </footer>
    </div>
