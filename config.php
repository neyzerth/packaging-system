<?php

function connectdb(){

    try {
        $db = mysqli_connect("localhost", "root", "", "packaging");
        //echo "<p>Conectado<p>";
        return $db;
    } catch (Exception $e) {
        echo "<p>Conection Error: {$e->getMessage()}<p>";
        return false;
    }
}
