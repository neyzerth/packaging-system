<?php
    $users = getUsers();    
?>
    <main class="tables">
        <div class="background">
            <?php include HEADER ?>
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
                        <th>
                            <span>Date of birth</span>
                            <span class="column-order"></span>
                        </th>
                        <th>
                            <span>User type</span>
                            <span class="column-order"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['num']; ?></td>
                        <td><?php echo $user['full_name']; ?></td>
                        <td><?php echo $user['date_of_birth']; ?></td>
                        <td><?php echo $user['user']; ?></td>
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
                            <span>Date of birth</span>
                        </th>
                        <th>
                            <span>User type</span>
                        </th>
                    </tr>
                </tfoot>
            </table>
            <?php include FOOTER ?>
        </div>
    </main>