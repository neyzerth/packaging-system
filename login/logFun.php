<?php
require_once __DIR__ . "/../config.php";

//AGREGUE ESTE IF POR QUE ME SALIA ESTE ERROR:
//Notice: session_start(): Ignoring session_start() because a session is already active 
//if (session_status() === PHP_SESSION_NONE) {
//    session_start();
//}
function login($username, $password)
{
    $db = connectdb();
    $stmt = $db->prepare("SELECT num, username, user_type FROM vw_user_info WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $bool = $result->num_rows > 0;
    if ($bool) {
        $user = $result->fetch_assoc();
        
        $_SESSION['num'] = $user['num'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
    }   
    return $bool;
}

function logout(){
    session_unset();
    session_destroy();
    header("Location: /login/");
}

function validateUser(string ...$validUsers){

    session_start();

    error_log("Validating...".$_SESSION['user_type']);

    if(!isset($_SESSION)){
        header("Location: /login/");
        exit;
    }

    if($validUsers == "ALL"){
        return true;
    }

    return in_array($_SESSION['user_type'], $validUsers);
}
?>