<?php
    require_once "../config.php";
    session_start();
    function login($username, $password) {
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
        $stmt->close();
        $db->close();
        return $bool;
    }
?>