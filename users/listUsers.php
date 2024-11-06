<?php
error_reporting(E_ALL);

    require("../config.php");
    require HEADER;
    require "userFun.php";

    $users = getUsers();    
?>

<body>

    <header class="bg-body-light container">
        <div>
            <div class="d-flex align-center">
                <form role="search">
                    <input class="form-control" type="search" placeholder="Buscar">
                </form>
                <ul class="nav mr-auto">
                    <li>
                        <a href="#">⚙️</a>
                    </li>
                    <li>
                        <a href="#">✉️</a>
                    </li>
                    <li>
                        <a href="#">➕</a>
                    </li>
                    <li>
                        <a href="#">🗑️</a>
                    </li>
                    <li>
                        <a href="#" onclick="refreshPage()">⭮</a>
                    </li>
                    <li>
                        <a href="#" id="prevButton" onclick="changeTable(-1)">&#60;</a>
                    </li>
                    <li>
                        <span id="pageIndicator"></span>
                    </li>
                    <li>
                        <a href="#" id="nextButton" onclick="changeTable(1)">&#62;</a>
                    </li>
                </ul>
                <a href="#">
                    <img class="rounded-circle" src="https://github.com/mdo.png" width="40" height="40">
                </a>
            </div>
        </div>
    </header>

    <main class="container">
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
                    <tr class="extra-info">
                        <td colspan="8">Here you can add more information about this person.</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Fin de la Tabla 1 -->

            
        </div>
    </main>

    <script src="../home/panel.js"></script>
</body>

</html>
