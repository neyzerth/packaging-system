<?php
require_once "../config.php";
function addUser(
    $username, $password, 
    $name, $firstSurname, $secondSurname, 
    $dateOfBirth, $neighborhood, $street, $postalCode,
    $phone, $email, 
    $userType, $supervisor
){
    $db = connectdb();
    
    $postalCode = nullDb($postalCode);
    $supervisor = nullDb($supervisor);

    $query = "call sp_insertUSer(".
        "'$username', $password,". 
        "'$name', '$firstSurname', '$secondSurname', ".
        "'$dateOfBirth','$neighborhood','$street', $postalCode,".
        "'$phone','$email','$userType',$supervisor".
    ");";

    echo "<p>$query</p>";

    try {
        $response = mysqli_query($db, $query);
        return "Usuario registrado con exito";
    } catch (Exception $e) {
        return "". $e->getMessage();
    }
}

function getUsers(){
    $db = connectdb();

    $query = "SELECT num, first_surname, second_surname, name, date_of_birth FROM user_personal_info;";

    $result = mysqli_query($db, $query);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    mysqli_close($db);

    return $users;
}

function getUserTypes(){
    $db = connectdb();
    $query = "SELECT code, name FROM user_type;";

    return mysqli_query($db, $query);
}
function getSupervisors(){
    $db = connectdb();
    $query = "SELECT num, name FROM user WHERE supervisor IS NULL;";

    return mysqli_query($db, $query);
}

