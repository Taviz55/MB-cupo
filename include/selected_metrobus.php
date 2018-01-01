<?php

    $first_metrobus = "SELECT MIN(id) FROM metrobus_cupo";
    $first_metrobus = mysqli_query($conn, $first_metrobus);
    $first_metrobus = mysqli_fetch_row($first_metrobus);  
    
    $last_metrobus = "SELECT MAX(id) FROM metrobus_cupo";
    $last_metrobus = mysqli_query($conn, $last_metrobus);
    $last_metrobus = mysqli_fetch_row($last_metrobus);  

    $start_metrobus_id = rand($first_metrobus[0], $last_metrobus[0]);

    $selected_metrobus = "SELECT metrobus_id, estacion_id, direccion FROM metrobus_cupo WHERE id=".$start_metrobus_id;
    $selected_metrobus = mysqli_query($conn, $selected_metrobus);
    $selected_metrobus = mysqli_fetch_row($selected_metrobus);  

    $start_station = "SELECT id, nombre FROM estacion WHERE id=".$selected_metrobus[1];
    $start_station = mysqli_query($conn, $start_station);
    $start_station = mysqli_fetch_row($start_station);

?>