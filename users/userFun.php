<?php
    require_once "../config.php";
    function addUser($username, $password, $name, $firstSurname, $secondSurname, $dateOfBirth, $neighborhood, $street, $postalCode, $phone, $email, $userType, $supervisor) {
        $db = connectdb();
        $postalCode = nullDb($postalCode);
        $supervisor = nullDb($supervisor);
        $query = "call addUser(" . "'$username', $password," . "'$name', '$firstSurname', '$secondSurname', " . "'$dateOfBirth','$neighborhood','$street', $postalCode," . "'$phone','$email','$userType',$supervisor" . ");";
        try {
            return mysqli_query($db, $query);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    function getUsers() {
        $db = connectdb();
        $query = "SELECT * FROM vw_user_personal_info;";
        $result = mysqli_query($db, $query);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        mysqli_close($db);
        return $users;
    }

    function getUserTypes() {
        $db = connectdb();
        $query = "SELECT code, name FROM user_type;";
        return mysqli_query($db, $query);
    }
    function getSupervisors() {
        $db = connectdb();
        $query = "SELECT num, full_name FROM vw_supervisor;";
        return mysqli_query($db, $query);
    }

    function getUserByNumber($num) {
        $db = connectdb();
        $query = "SELECT * FROM user WHERE num = '$num';";
        $result = mysqli_query($db, $query);
        $protocol = mysqli_fetch_assoc($result);
        mysqli_close($db);
        return $protocol;
    }

    function updateUser($num, $username, $password, $name, $first_surname, $second_surname, $date_of_birth, $neighborhood, $street, $postal_code, $phone, $email, $active, $user_type, $supervisor) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL UpdateUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
        }
        
        // Vincular los parámetros
        $stmt->bind_param("issssssssisssi", $num, $username, $password, $name, $first_surname, $second_surname, $date_of_birth, $neighborhood, $street, $postal_code, $phone, $email, $active, $user_type, $supervisor);
        
        // Ejecutar el procedimiento
        if ($stmt->execute()) {
            $result = true; 
        } else {
            $result = false;
            echo "Error en la ejecución: " . htmlspecialchars($stmt->error); 
        }
        
        $stmt->close();
        $db->close();
        
        return $result; 
    }
    
    function disableUser($num) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL dropUser(?)");
        
        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . htmlspecialchars($db->error));
        }
    
        $stmt->bind_param("i", $num);
        
        // Ejecutar el procedimiento
        if ($stmt->execute()) {
            $result = true; 
        } else {
            $result = false;
            echo "Error en la ejecución: " . htmlspecialchars($stmt->error); 
        }
        
        $stmt->close();
        $db->close();
        
        return $result; 
    }
?>