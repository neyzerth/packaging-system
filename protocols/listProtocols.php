<?php
    $protocols = getProtocols();
?>
<table>
    <thead>
        <tr>
            <th> </th>
            <th>#</th>
            <th>Name</th>
            <th>File</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($protocols as $protocol):?>
        <tr>
            <td>^</td>
            <td><?php echo  $protocol['num'];?> </td>
            <td><?php echo  $protocol['name'];?></td>
            <td><?php echo  $protocol['file_name'];?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>