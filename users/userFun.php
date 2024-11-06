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

    $query = "call addUser(".
        "'$username', $password,". 
        "'$name', '$firstSurname', '$secondSurname', ".
        "'$dateOfBirth','$neighborhood','$street', $postalCode,".
        "'$phone','$email','$userType',$supervisor".
    ");";


    try {
        return mysqli_query($db, $query);
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getUsers(){
    $db = connectdb();

    $query = "SELECT num, full_name, date_of_birth, user FROM vw_user_personal_info;";

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
    $query = "SELECT num, full_name FROM vw_supervisor;";

    return mysqli_query($db, $query);
}

