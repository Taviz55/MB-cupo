<?php
    require('connection.php');

    $end = false;
    $m_selected = false;
    $passen = false;

    if(isset($_POST['end']) && isset($_POST['m_selected']) && isset($_POST['passen'])){
        $end = $_POST['end'];
        $m_selected = $_POST['m_selected'];
        $passen = $_POST['passen'];
    }

    
    $first_station = "SELECT MIN(id), nombre FROM estacion";
    $first_station = mysqli_query($conn, $first_station);
    $first_station = mysqli_fetch_row($first_station);

    $first_direction = "SELECT nombre FROM estacion WHERE id=$first_station[0]";
    $first_direction = mysqli_query($conn, $first_direction);
    $first_direction = mysqli_fetch_row($first_direction);

    $last_station = "SELECT MAX(id), nombre FROM estacion";
    $last_station = mysqli_query($conn, $last_station);
    $last_station = mysqli_fetch_row($last_station);

    $last_direction = "SELECT nombre FROM estacion WHERE id=$last_station[0]";
    $last_direction = mysqli_query($conn, $last_direction);
    $last_direction = mysqli_fetch_row($last_direction);

    $update_metrobus_station = "SELECT metrobus_id, direccion, estacion_id FROM metrobus_cupo";
    
    if ($update_metrobus_station = mysqli_query($conn, $update_metrobus_station)) {
        while($row = mysqli_fetch_array($update_metrobus_station)) {
            
            $metrobus = $row['metrobus_id'];
            $direction = $row['direccion'];
            $station = $row['estacion_id']; 
    
            if($direction == 'Tepalcates'){          
                if($station == $first_station[0]){
                    $new_station = "UPDATE metrobus_cupo SET estacion_id= estacion_id + 1, direccion='$last_direction[0]' 
                                WHERE metrobus_id='$metrobus'";
                }else{          
                    $new_station = "UPDATE metrobus_cupo SET estacion_id= estacion_id - 1 
                                WHERE metrobus_id='$metrobus'";
                }
            }else{
                if($station == $last_station[0]){
                
                    $new_station = "UPDATE metrobus_cupo SET estacion_id= estacion_id - 1, direccion='$first_direction[0]' 
                                WHERE metrobus_id='$metrobus'";
                }else{             
                    $new_station = "UPDATE metrobus_cupo SET estacion_id= estacion_id + 1 
                                    WHERE metrobus_id='$metrobus'";
                }
            }
           
             $new_station = mysqli_query($conn, $new_station);
        }
    }


?>
