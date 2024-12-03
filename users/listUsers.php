<?php
    require_once("../config.php");
    require "userFun.php";
    $users = getUsers();
?>
<body style="display: flex; flex-direction: column;">
    <div class="table">
        <?php $link="?a=add"; include HEADER;?>
        <table>
            <thead>
                <tr>
                    <th>Num</th>
                    <th>Name</th>
                    <th>Date of birth</th>
                    <th>User type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['num']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['date_of_birth']; ?></td>
                    <td><?php echo $user['user']; ?></td>
                    <?php if(validateUser("ADMIN")):?>
                    <td>
                        <a class="btn1" href="?a=edit&num=<?php echo $user['num'];?>">Edit</a>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include FOOTER ?>
    </div>