<?php
    require "userFun.php";
    $user_types = getUserTypes();
    $supervisors = getSupervisors();
    if ($_SERVER['REQUEST_METHOD']=='POST') {
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
        $user_type = $_POST['user_type'];
        $supervisor = $_POST['supervisor'];
        $result = addUser(username: $username, password: $password, name: $name, firstSurname: $first_surname, secondSurname: $second_surname, dateOfBirth: $date, neighborhood: $neighborhood, street: $street, postalCode: $postal_code, phone: $phone, email: $email, userType: $user_type, supervisor: $supervisor);
        if($result){
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Box Registered.</span></div>";
        } else {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Error</span></div>";
        }
    }
?>
    <main class="forms">
        <div class="background">
            <form class="form" action="addUser.php" method="post" autocomplete="off">
                
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Add Users</h1>
                </header>
                <hr>
                <h2>Profile</h2>
                <div class="rows">
                    <div class="row-lg-10">
                        <h4 for="name">Name</h4>
                        <div class="inputs">
                            <input name="name" id="name" type="text" required>
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="first_surname">First Surname</h4>
                        <div class="inputs">
                            <input name="first_surname" id="first_surname" type="text" required>
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="second_surname">Second Surname</h4>
                        <div class="inputs">
                            <input name="second_surname" id="second_surname" type="text" required>
                        </div>
                    </div>
                    <div class="row-sm-3">
                        <h4 for="date">Date of Birth</h4>
                        <div class="inputs">
                            <input type="date" name="date" id="date" required>
                        </div>
                    </div>
                </div>
                
                <hr>
                <h2>Access Credentials</h2>
                <div class="rows">
                    <div class="row-lg-10">
                        <h4 for="username">User</h4>
                        <div class="inputs">
                            <input name="username" id="username" type="text" required placeholder="@Username">
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="email">Email</h4>
                        <div class="inputs">
                            <input name="email" id="email" type="email" placeholder="you@example.com">
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="phone">Phone number</h4>
                        <div class="inputs">
                            <input name="phone" id="phone" type="text" required placeholder="xx-xxx-xxxx-xxx">
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="password">Password</h4>
                        <div class="inputs">
                            <input type="password" name="password" id="password" required placeholder="***">
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="user_type">User type</h4>
                        <select required name="user_type" id="user_type" class="inputs" name="" id="options">
                            <?php 
                                while ($user_type = mysqli_fetch_assoc($user_types)):   
                                    echo "<option value='{$user_type['code']}'>{$user_type['name']}</option>";
                                endwhile; 
                            ?>
                        </select>
                    </div>
                    <div class="row-md-5">
                        <h4 for="supervisor">Supervisor</h4>
                        <select class="inputs" name="supervisor" id="supervisor">
                            <?php 
                                while ($supervisor = mysqli_fetch_assoc($supervisors)):   
                                    echo "<option value='{$supervisor['num']}'>{$supervisor['full_name']}</option>";
                                endwhile;
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
                            <input name="postal-code" id="postal-code" type="text" placeholder="#">
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4 for="">Neighborhood</h4>
                        <div class="inputs">
                            <input name="neighborhood" id="neighborhood" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="row-lg-10">
                        <h4 for="">Street</h4>
                        <div class="inputs">
                            <input name="street" id="street" type="text" placeholder="#">
                        </div>
                    </div>
                </div>

                <hr>
                <footer class="footer">
                    <button class="btn-primary" type="submit">Confirm</button>
                </footer>

            </form>
        </div>
    </main>
    <?php include FOOT ?>
    <script>
        setTimeout(() => {
            const successMsg = document.getElementById('success-msg');
            const errorMsg = document.getElementById('error-msg');
            if (successMsg) successMsg.style.display = 'none';
            if (errorMsg) errorMsg.style.display = 'none';
        }, 3000);
    </script>