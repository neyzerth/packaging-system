<?php
session_start();
if(empty($_SESSION['trac'])){
    $process = startProcess();
    $_SESSION['trac'] = $process['Traceability'];
} 

session_start();
$trac = getProcessByID($_SESSION['trac']);
?>
    <div class="tables">
        <div class="background">
            <br>
            <div style="text-align: center">
                <h1>PROCESS VIEW</h1>
            </div>
            <div class="process">
                <div>
                    <h2>STATE: <?php echo $trac['State'] ?></h2>
                </div>
                <div>
                    <h2>TRACEABILITY ID: <?php echo $trac['Traceability']; ?></h2>
                </div>
                <div>
                    <a href="?a=select"><h3 class="btn">Select New Process</h3></a>
                </div>
            </div>
            <div class="process">
                <div class="">
                <a href="?a=addPackage">
                    <h3>Packing</h3>
                    <img class="bin process-btn" src="<?php echo SVG . "products.svg" ?>">
                </a>
                <p>
                    <b>Product:</b> 
                    <?php echo printNull($trac['Product'])?>
                </p>
                <p>
                    <b>Product Quantity:</b> 
                    <?php echo printNull($trac['Product_Quantity'])?>
                </p>
                <p>
                    <b>Tag:</b> 
                    <?php echo "[".printNull($trac['Package_Tag'])."] "
                        .printNull($trac['Package_Type'])?>
                </p>
                <p>
                    <b>Protocol:</b> 
                    <?php echo printNull($trac['Protocol'])?>
                </p>
                </div>
                <div>
                    <a href="?a=addPackaging">
                        <h3>Packaging</h3>
                        <img class="bin process-btn" src="<?php echo SVG . "boxes.svg" ?>">
                    </a>
                    <p>
                    <b>Barcode:</b> 
                        <?php echo printNull($trac['Packaging_Barcode'])?>
                    </p>
                    <p>
                        <b>Package Quantity:</b> 
                        <?php echo printNull($trac['Package_Quantity'])?>
                    </p>
                    <p>
                    <b>Tag:</b> 
                    <?php echo "[".printNull($trac['Packaging_Tag'])."] "
                        .printNull($trac['Packaging_Type'])?>
                </p>
                </div>
                <div>
                    <a href="?a=addWarehouse">
                        <h3>Warehouse</h3>
                        <img class="bin process-btn" src="<?php echo SVG . "zone.svg" ?>">
                    </a>
                    <p>
                        <b>Area:</b> 
                        <?php echo printNull($trac['Area'])?>
                    </p>
                    <p>
                        <b>Total Space:</b> 
                        <?php echo printNull($trac['Available'])?>
                    </p>
                    <p>
                        <b>Available Space:</b> 
                        <?php echo printNull($trac['Available'])?>
                    </p>
                </div>
            </div>
            
            <?php 
            include 'listUsersInProcess.php';
            ?>
            <hr>
            <button class="btn-primary" type="submit">Incident</button>
            <footer class="footer">
            </footer>
        </div>
    </div>