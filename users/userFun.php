<?php
require "/config.php";
function addUser(
    $username, $password, 
    $name, $firstSurname, $secondSurname, 
    $dateOfBirth, $neighborhood, $street, $postalCode,
    $phone, $email, $active, $userType, $supervisor
){
    $db = connectdb();
    $query = "call sp_ser(".
        $username.",". $password.",". 
        $name.",". $firstSurname.",". $secondSurname.",". 
        $dateOfBirth.",". $neighborhood.",". $street.",". $postalCode.",".
        $phone.",". $email.",". $active.",". $userType.",". $supervisor
    .");";

    try {
        $response = mysqli_query($db, $query);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

