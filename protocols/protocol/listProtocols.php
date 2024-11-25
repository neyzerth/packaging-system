<?php
    require_once("../../../config.php");
    require "protocolFun.php";
    $protocols = getProtocols();
?>
    <main class="tables">
        <div class="background">
            <?php 
            $link="?a=add";
            include HEADER 
            ?>
            <h1>Protocols</h1>
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
                        <td>
                            <?php if(validateUser("ADMIN", "SUPER")): ?>
                                <a class="btn" href="?a=edit&num=<?php echo $protocol['num'];?>">Edit</a>
                            <?php endif; ?>
                            
                            <a class="btn" href="<?php echo URL."uploads/".$protocol['file_name']?>">View</a>
                        </td>
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
            <?php include FOOTER?>