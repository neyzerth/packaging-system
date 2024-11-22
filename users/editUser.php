<?php
    require_once("../config.php");
    require "userFun.php";

    $supervisors = getSupervisors();
    $userTypes = getUserTypes();

    if (isset($_GET['num'])) {
        $num = $_GET['num'];
        $user = getUserByNumber($num);
        if (!$user) {
            echo "User not found";
            exit;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $first_surname = $_POST['first_surname'];
        $second_surname = $_POST['second_surname'];
        $date = $_POST['date'];
        $neighborhood = $_POST['neighborhood'];
        $street = $_POST['street'];
        $postal_code = $_POST['postal_code'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $active = 1;
        $user_type = $_POST['user_type'];
        $supervisor = $_POST['supervisor'];

        if (updateUser(num:$num, username: $username, password: $password, name: $name, first_surname: $first_surname, second_surname: $second_surname, date_of_birth: $date, neighborhood: $neighborhood, street: $street, postal_code: $postal_code, phone: $phone, email: $email, active:$active, user_type: $user_type, supervisor: $supervisor)) {
            echo "Producto actualizado con éxito.";
        } else {
            echo "Error al actualizar el producto.";
        }
    }
?>


                <input type="hidden" name="num" value="<?php echo $user['num']; ?>">



<main class="forms">
        <div class="background">
            <form class="form" action="addUser.php" method="post" autocomplete="off">
                
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Users</h1>
                </header>

                <h2>Profile</h2>
                <hr>
                <a  class="btn-primary" href="disableUser.php?num=<?php echo $user['num']; ?>" onclick="return confirm('Are you sure you want to disable this user?');">Disable</a>
                <div class="rows">
                    <div class="row-lg-10">
                        <h4 for="name">Name</h4>
                        <div class="inputs">
                        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="first_surname">First Surname</h4>
                        <div class="inputs">
                        <input type="text" name="first_surname" value="<?php echo $user['first_surname']; ?>" required>
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="second_surname">Second Surname</h4>
                        <div class="inputs">
                        <input type="text" name="second_surname" value="<?php echo $user['second_surname']; ?>">
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="date">Date of Birth</h4>
                        <div class="inputs">
                        <input type="date" name="date" value="<?php echo $user['date_of_birth']; ?>" required>
                        </div>
                    </div>
                </div>
                
                <hr>
                <h2>Access Credentials</h2>
                <div class="rows">
                    <div class="row-lg-10">
                        <h4 for="username">User</h4>
                        <div class="inputs">
                            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="email">Email</h4>
                        <div class="inputs">
                        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="phone">Phone number</h4>
                        <div class="inputs">
                        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="password">Password</h4>
                        <div class="inputs">
                        <input type="password" name="password" value="<?php echo $user['password']; ?>" required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="user_type">User type</h4>
                            <select class="inputs" name="user_type" required>
                                <?php
                                    while ($type = mysqli_fetch_assoc($userTypes)) {
                                        $selected = $user['user_type'] === $type['code'] ? 'selected' : '';
                                        echo "<option value='{$type['code']}' $selected>{$type['name']}</option>";
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="row-md-5">
                        <h4 for="supervisor">Supervisor</h4>
                        <select class="inputs" name="supervisor" required>
                            <?php 
                                while ($supervisor = mysqli_fetch_assoc($supervisors)) {
                                    $selected = $user['supervisor'] === $supervisor['num'] ? 'selected' : '';
                                    echo "<option value='{$supervisor['num']}' $selected>{$supervisor['full_name']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <hr>
                <h2>Address</h2>
                <div class="rows">
                    <div class="row-md-5">
                        <h4 for="">Postal code</h4>
                        <div class="inputs">
                        <input type="number" name="postal_code" value="<?php echo $user['postal_code']; ?>" required>
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="">Neighborhood</h4>
                        <div class="inputs">
                        <input type="text" name="neighborhood" value="<?php echo $user['neighborhood']; ?>" required>
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="">Street</h4>
                        <div class="inputs">
                        <input type="text" name="street" value="<?php echo $user['street']; ?>" required>
                        </div>
                    </div>
                </div>

                <hr>
                <footer class="footer">
                    <button class="btn-primary" type="submit">Update</button>
                </footer>

            </form>
        </div>
    </main>