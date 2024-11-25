    <div class="tables">
        <div class="background">
            <?php $link="?a=add"; include HEADER; ?>
            <div style="text-align: center">
                <h1>PROCESS VIEW</h1>
            </div>
            <div class="process">
                <div>
                    <h3>Packing</h3>
                    <img class="bin" src="<?php echo SVG . "products.svg" ?>">
                    <select class="inputs">
                    </select>
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