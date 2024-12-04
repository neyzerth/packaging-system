<?php
    require_once("../config.php");
    require_once("userFun.php");

    if (validateUser("ADMIN") && isset($_GET['num'])) {
        $num = $_GET['num'];
        
        if (disableUser($num)) {
            $_SESSION['message'] = [
                'text' => 'User successfully disabled',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error deactivating user',
                'type' => 'error'
            ];
        }
        //mandarlo entre carpetas ya que si lo hacemos por archivos no se imprime el mensaje
        header("Location: /users/");
        exit();
    } else {
        $_SESSION['message'] = [
            'text' => 'User code not provided',
            'type' => 'error'
        ];
    }
?>