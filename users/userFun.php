<?php
    require_once "../config.php";
    function addUser($username, $password, $name, $firstSurname, $secondSurname, $dateOfBirth, $neighborhood, $street, $postalCode, $phone, $email, $userType, $supervisor) {
        $db = connectdb();
        
        // Valores nulos
        $secondSurname = empty($secondSurname) ? null : $secondSurname;
        $dateOfBirth = empty($dateOfBirth) ? null : $dateOfBirth;
        $neighborhood = empty($neighborhood) ? null : $neighborhood;
        $street = empty($street) ? null : $street;
        $postalCode = empty($postalCode) ? null : $postalCode;
        $phone = empty($phone) ? null : $phone;
        $email = empty($email) ? null : $email;
        $userType = empty($userType) ? null : $userType;
        $supervisor = empty($supervisor) ? null : $supervisor;
    
        $stmt = $db->prepare("CALL addUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        if ($stmt === false) {
            die('Query preparation error: ' . htmlspecialchars($db->error));
        }
    
        $stmt->bind_param("ssssssssisssi", $username, $password, $name, $firstSurname, $secondSurname, $dateOfBirth, $neighborhood, $street, $postalCode, $phone, $email, $userType, $supervisor);
    
        $result = $stmt->execute();
        $stmt->close();
        $db->close();
    
        return $result;
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

    function updateUser($num, $username, $password, $name, $firstSurname, $secondSurname, $dateOfBirth, $neighborhood, $street, $postalCode, $phone, $email, $active, $userType, $supervisor) {
        $db = connectdb();
    
        // Valores nulos
        $secondSurname = empty($secondSurname) ? null : $secondSurname;
        $dateOfBirth = empty($dateOfBirth) ? null : $dateOfBirth;
        $neighborhood = empty($neighborhood) ? null : $neighborhood;
        $street = empty($street) ? null : $street;
        $postalCode = empty($postalCode) ? null : $postalCode;
        $phone = empty($phone) ? null : $phone;
        $email = empty($email) ? null : $email;
        $userType = empty($userType) ? null : $userType;
        $supervisor = empty($supervisor) ? null : $supervisor;
    
        $stmt = $db->prepare("CALL UpdateUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        if ($stmt === false) {
            die('Query preparation error: ' . htmlspecialchars($db->error));
        }
    
        $stmt->bind_param("issssssssissisi", $num, $username, $password, $name, $firstSurname, $secondSurname, $dateOfBirth, $neighborhood, $street, $postalCode, $phone, $email, $active, $userType, $supervisor);
    
        $result = $stmt->execute();
        if (!$result) {
            echo "Execution error: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
        $db->close();
    
        return $result;
    }
    
    
    function disableUser($num) {
        $db = connectdb();
        
        $stmt = $db->prepare("CALL dropUser(?)");
        
        if ($stmt === false) {
            die('Query preparation error: '. htmlspecialchars($db->error));
        }
    
        $stmt->bind_param("i", $num);
        
        // Ejecutar el procedimiento
        if ($stmt->execute()) {
            $result = true; 
        } else {
            $result = false;
            echo "Execution error: " . htmlspecialchars($stmt->error); 
        }
        
        $stmt->close();
        $db->close();
        
        return $result; 
    }


    /*function searchUser($search){
        $db = connectdb();
        
        $search = $db->real_escape_string($search);

        $query = "SELECT * FROM vw_user_personal_info WHERE num = $search";
        $result = $db->query($query);
        
        $users = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        
        return $users;
    }*/
?>