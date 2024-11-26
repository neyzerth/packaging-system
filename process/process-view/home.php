<?php

?>
    <div class="tables">
        <div class="background">
            <?php //include HEADER; ?>
            <div style="text-align: center">
                <h1>PROCESS VIEW</h1>
            </div>
            <div class="process">
                <div>
                <a href="?a=addPackage">
                    <h3>Packing</h3>
                    <img class="bin" src="<?php echo SVG . "products.svg" ?>">
                </a>
                </div>
                <div>
                    <a href="?a=addPackaging">
                    <h3>Packaging</h3>
                    <img class="bin" src="<?php echo SVG . "boxes.svg" ?>">
                    </a>
                </div>
                <div>
                    <a href="?a=addWarehouse">
                    <h3>Warehouse</h3>
                    <img class="bin" src="<?php echo SVG . "zone.svg" ?>">
                    </a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <span>Code</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>Name</span>
                            <span class="column-order"></span>
                        </th>
                    </tr>
                </thead>
<<<<<<< Updated upstream:process/process-view/home.php
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
=======
>>>>>>> Stashed changes:process/process-view/addProcess.php
            </table>
            <?php include FOOTER ?>
            <hr>
            <footer class="footer">
                <button class="btn-primary" type="submit">Incident</button>
            </footer>
        </div>
    </div>