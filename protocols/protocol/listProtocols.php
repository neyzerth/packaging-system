<?php
    require_once("../../config.php");
    require "protocolFun.php";
    $protocols = getProtocols();
?>
<body style="display: flex; flex-direction: column;">
        <div class="table">
            <?php 
            $link="?a=add";
            include HEADER 
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>File</th>
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
                                <a class="a" href="?a=edit&num=<?php echo $protocol['num'];?>">Edit</a>
                            <?php endif; ?>
                            
                            <a  class="btn1" href="<?php echo URL."uploads/".$protocol['file_name']?>">View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php include FOOTER ?>
        </div>
    </div>