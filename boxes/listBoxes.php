<?php
    $boxes = getBoxes();
?>

<table>
    <thead>
        <tr>
            <th><input type="checkbox"></th>
            <th>#</th>
            <th>Height</th>
            <th>Width</th>
            <th>Length</th>
            <th>Volume</th>
            <th>Weight</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($boxes as $box): ?>
        <tr>
            <td><input type="checkbox"></td>
            <td><?php echo $box['num'] ?></td>
            <td><?php echo $box['height'].'cm' ?></td>
            <td><?php echo $box['width'].'cm' ?></td>
            <td><?php echo $box['length'].'cm' ?></td>
            <td><?php echo $box['volume'].'cm2' ?></td>
            <td><?php echo $box['weight'].'g' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>