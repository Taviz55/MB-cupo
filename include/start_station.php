<?php
    require('connection.php');

    $first_station = "SELECT id FROM estacion LIMIT 1";
    $first_station = mysqli_query($conn, $first_station);
    $first_station = mysqli_fetch_row($first_station);  
    
    $last_station = "SELECT id FROM estacion ORDER BY id DESC LIMIT 1";
    $last_station = mysqli_query($conn, $last_station);
    $last_station = mysqli_fetch_row($last_station);  

    $start_station_id = rand($first_station[0], $last_station[0]);

    $start_station = "SELECT id, nombre FROM estacion WHERE id=$start_station_id";
    $start_station = mysqli_query($conn, $start_station);
    $start_station = mysqli_fetch_row($start_station);  
?>