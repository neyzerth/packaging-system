<?php
    $protocols = getProtocols();
?>
<main class="tables">
    <table class="table">
        <colgroup>
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
                    <span>Name</span>
                    <span class="column-order"></span>
                </th>
                <th>
                    <span>File</span>
                    <span class="column-order"></span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($protocols as $protocol):?>
            <tr>
                <td><?php echo  $protocol['num'];?> </td>
                <td><?php echo  $protocol['name'];?></td>
                <td><?php echo  $protocol['file_name'];?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>
                    <span>Code</span>
                </th>
                <th>
                    <span>Name</span>
                </th>
                <th>
                    <span>File</span>
                </th>
            </tr>
        </tfoot>
    </table>
</main>