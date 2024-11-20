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
<main class="tables">
    <div class="background">
        <a href="disableUser.php?num=<?php echo $user['num']; ?>" onclick="return confirm('Are you sure you want to disable this user?');">Disable</a>
        <table class="table">
            <form action="" method="POST" autocomplete="off">
                <input type="hidden" name="num" value="<?php echo $user['num']; ?>">
                
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
                
                <label>Password:</label>
                <input type="password" name="password" value="<?php echo $user['password']; ?>" required>
                
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

                <label>First Surname:</label>
                <input type="text" name="first_surname" value="<?php echo $user['first_surname']; ?>" required>

                <label>Second Surname:</label>
                <input type="text" name="second_surname" value="<?php echo $user['second_surname']; ?>">

                <label>Date of Birth:</label>
                <input type="date" name="date" value="<?php echo $user['date_of_birth']; ?>" required>

                <label>Neighborhood:</label>
                <input type="text" name="neighborhood" value="<?php echo $user['neighborhood']; ?>" required>

                <label>Street:</label>
                <input type="text" name="street" value="<?php echo $user['street']; ?>" required>

                <label>Postal Code:</label>
                <input type="number" name="postal_code" value="<?php echo $user['postal_code']; ?>" required>

                <label>Phone:</label>
                <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

                <label>User Type:</label>
                <select name="user_type" required>
                    <?php
                        while ($type = mysqli_fetch_assoc($userTypes)) {
                            $selected = $user['user_type'] === $type['code'] ? 'selected' : '';
                            echo "<option value='{$type['code']}' $selected>{$type['name']}</option>";
                        }
                    ?>
                </select>

                <label>Supervisor:</label>
                <select name="supervisor" required>
                    <?php 
                        while ($supervisor = mysqli_fetch_assoc($supervisors)) {
                            $selected = $user['supervisor'] === $supervisor['num'] ? 'selected' : '';
                            echo "<option value='{$supervisor['num']}' $selected>{$supervisor['full_name']}</option>";
                        }
                    ?>
                </select>

                <button type="submit">Update</button>
            </form>
        </table>
    </div>
</main>