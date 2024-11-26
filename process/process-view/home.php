<?php

?>
    <div class="tables">
        <div class="background">
            <br>
            <?php //include HEADER; ?>
            <div style="text-align: center">
                <h1>PROCESS VIEW</h1>
            </div>
            <div class="process">
                <div>
                    <h2>STATE: </h2>
                </div>
                <div>
                    <h2>TRACEABILITY ID: </h2>
                </div>
                <div>
                    <a><h2 class="btn">NEW </h2></a>
                </div>
            </div>
            <div class="process">
                <div class="">
                <a href="?a=addPackage">
                    <h3>Packing</h3>
                    <img class="bin process-btn" src="<?php echo SVG . "products.svg" ?>">
                </a>
                </div>
                <div>
                    <a href="?a=addPackaging">
                    <h3>Packaging</h3>
                    <img class="bin process-btn" src="<?php echo SVG . "boxes.svg" ?>">
                    </a>
                </div>
                <div>
                    <a href="?a=addWarehouse">
                    <h3>Warehouse</h3>
                    <img class="bin process-btn" src="<?php echo SVG . "zone.svg" ?>">
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
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <?php include FOOTER ?>
            <hr>
            <footer class="footer">
                <button class="btn-primary" type="submit">Incident</button>
            </footer>
        </div>
    </div>