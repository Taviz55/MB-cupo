<?php
    require('connection.php');

    SESSION_START();

    if(isset($_POST['start_station']) && isset($_POST['passengers']) && isset($_POST['end_station']) 
       && isset($_POST['selected_metrobus']) && isset($_POST['update'])){
        
        $_SESSION['start_station'] = $_POST['start_station'];
        $_SESSION['passengers'] = $_POST['passengers'];
        $_SESSION['end_station'] = $_POST['end_station'];
        $_SESSION['selected'] = $_POST['selected_metrobus'];
        
        $update = $_POST['update'];
    
    }

    $start_station = $_SESSION['start_station'];
    $passengers = $_SESSION['passengers'];
    $end_station = $_SESSION['end_station'];
    $selected =  $_SESSION['selected'] ;

    $s_station = "SELECT nombre FROM estacion WHERE id=".$start_station;
    $s_station = mysqli_query($conn, $s_station);
    $s_station = mysqli_fetch_row($s_station);

    $d_station = "SELECT nombre FROM estacion WHERE id=".$end_station;
    $d_station = mysqli_query($conn, $d_station);
    $d_station = mysqli_fetch_row($d_station);
    
    if($update){
        $update_metrobus_cupo = "UPDATE metrobus_cupo SET cupo= cupo + $passengers where metrobus_id ='$selected'";
        $update_metrobus_cupo = mysqli_query($conn, $update_metrobus_cupo);
        
        $insert_passengers = "INSERT INTO pasajero(metrobus_id, cantidad, estacion_inicio_id, estacion_destino_id, hora_ingreso, fecha) 
                          VALUES('$selected', $passengers, $start_station, $end_station, NOW(), NOW())";
        $insert_passengers = mysqli_query($conn, $insert_passengers);
    }

    $second_update = "SELECT estacion_id FROM metrobus_cupo WHERE metrobus_id='$selected'";
    $second_update = mysqli_query($conn, $second_update);
    $second_update = mysqli_fetch_row($second_update);
    if($second_update[0] == $end_station){
        $update_metrobus_cupo = "UPDATE metrobus_cupo SET cupo= cupo - $passengers where metrobus_id ='$selected'";
        $update_metrobus_cupo = mysqli_query($conn, $update_metrobus_cupo);
        
        $_SESSION['selected'] = false;
    }
 

   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">

    <title>MB</title>
</head>

<body> 

   <div class="container-fluid">  
     <div class="row" id="main">
        <div class="col">
            <div class="jumbotron">
                <div class="start_station">      
                    <h5 class="text-primary">Estación de inicio: <span class="badge badge-primary"><?= $s_station[0] ?></span></h5>
                    <h5 class="text-primary">Estación de destino: <span class="badge badge-primary"><?= $d_station[0] ?></span></h5>
                    <h5 class="text-primary">Metrobus: <span class="badge badge-primary"><?= $selected ?></span></h5>
                    <h4 class="text-primary">Ahora estás conectado!</h4>               
                </div>
            </div>
        </div>
    </div>
   
    <?php include('table_metrobus_cupo.php') ?>

    <?php mysqli_close($conn); ?> 
    </div>   
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="../js/update_metrobus_cupo.js"></script>
       
</body>

</html>

















