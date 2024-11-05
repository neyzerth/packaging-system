<?php
require "../config.php";
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

