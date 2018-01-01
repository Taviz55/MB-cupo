<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "metrobus";

    $conn = mysqli_connect($server, $user, $pass, $db);

    if(mysqli_connect_errno()){
        echo "Falló la conección a la DB";
        exit();
    }

    mysqli_select_db($conn, $db) or die ("No se encontró la DDBB");

    mysqli_set_charset($conn, "utf8");

?>