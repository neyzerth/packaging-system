<?php
    $boxes = getBoxes();
?>
<main class="tables">
    <table class="table">
        <colgroup>
            <col width="">
            <col width="">
            <col width="">
            <col width="">
            <col width="">
            <col width="">
        </colgroup>
        <thead>
            <tr>
                <th>
                    <span>Code</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>Height</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>Width</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>Length</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>Volume</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>Weight</span>
                    <span class="column-order"></span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($boxes as $box): ?>
            <tr>
                <td><?php echo $box['num'] ?></td>
                <td><?php echo $box['height'].'cm' ?></td>
                <td><?php echo $box['width'].'cm' ?></td>
                <td><?php echo $box['length'].'cm' ?></td>
                <td><?php echo $box['volume'].'cm2' ?></td>
                <td><?php echo $box['weight'].'g' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>
                    <span>Code</span>
                </th>
                <th>
                    <span>Height</span>
                </th>
                <th>
                    <span>Width</span>
                </th>
                <th>
                    <span>Length</span>
                </th>
                <th>
                    <span>Volume</span>
                </th>
                <th>
                    <span>Weight</span>
                </th>
            </tr>
        </tfoot>
    </table>
</main>