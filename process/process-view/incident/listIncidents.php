<?php
    require "reportFun.php";
    $incidents = getIncident();
?>
<body style="display: flex; flex-direction: column;">
    <div class="table">
        <?php 
            $link="?a=add";
            include HEADER;
        ?>
        <table>
            <thead>
                <tr>
                    <th>Num</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Traceability</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($incidents as $incident): ?>
                <tr>
                    <td><?php echo $incident['num']; ?></td>
                    <td><?php echo $incident['date']; ?></td>
                    <td><?php echo $incident['description']; ?></td>
                    <td><?php echo $incident['traceability']?></td>
                    <?php if(validateUser("ADMIN", "SUPER")): ?>
                    <td>
                        <a class="btn1" href="?a=edit&num=<?php echo $incident['num']; ?>">Edit</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>