<?php
    $users = getUsers();    
?>
<div>
    <!-- Tabla 1 -->
    <table id="table1">
        <thead>
            <tr>
                <!--<th><input type="checkbox" id="checkboxMaestro1" onclick="toggleAllCheckboxes(this, 'table1')"></th>-->
                <th> </th>
                <th>#</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>User type</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <!--<td><input type="checkbox"></td>-->
                <td onclick="toggleInfo(this)">^</td>
                <td><?php echo $user['num']; ?></td>
                <td><?php echo $user['full_name']; ?></td>
                <td><?php echo $user['date_of_birth']; ?></td>
                <td><?php echo $user['user']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Fin de la Tabla 1 -->
</div>

