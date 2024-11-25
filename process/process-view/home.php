<?php
$product = isset($_GET['product']) ? $_GET['product'] : "Select a product...";

?>
    <div class="tables">
        <div class="background">
            <?php include HEADER; ?>
            <div style="text-align: center">
                <h1>PROCESS VIEW</h1>
            </div>
            <div class="process">
                <div>
                    <h3>Packing</h3>
                    <img class="bin" src="<?php echo SVG . "products.svg" ?>">
                    <div>
                        <a href="?a=addPackage"><p>[ADD]</p></a>
                        <input class="inputs" value="<?php echo $product?>" readonly>
                    </div>
                    <div>
                        <input class="inputs" type="number" value="0" min="0">
                    </div>
                </div>
                <div>
                    <h3>Packaging</h3>
                    <img class="bin" src="<?php echo SVG . "boxes.svg" ?>">
                    <select class="inputs">
                    </select>
                </div>
                <div>
                    <h3>Warehouse</h3>
                    <img class="bin" src="<?php echo SVG . "zone.svg" ?>">
                    <select class="inputs">
                    </select>
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
                <tfoot>
                    <tr>
                        <th>
                            <span>Code</span>
                        </th>
                        <th>
                            <span>Name</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <?php include FOOTER ?>
            <hr>
            <footer class="footer">
                <button class="btn-primary" type="submit">Incident</button>
            </footer>
        </div>
    </div>