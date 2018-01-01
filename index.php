<?php
    require('include/connection.php');
    require('include/selected_metrobus.php');

    
    if($selected_metrobus[2] == 'Tacubaya'){
        $query_stations = "SELECT * FROM estacion where linea_id=2 AND id >".$start_station[0]." ORDER BY id ASC";
    }else{
        $query_stations = "SELECT * FROM estacion where linea_id=2 AND id <".$start_station[0]." ORDER BY id DESC";
    }

    $result_stations = mysqli_query($conn, $query_stations);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <title>MB</title>
</head>

<body> 
   <div class="container-fluid">  
     <div class="row" id="main">
        <div class="col">
            <div class="jumbotron">
                <div class="start_station">      
                    <h5>Estación de inicio: <span class="badge badge-light"><?= $start_station[1] ?></span></h5>
                    <h5>Metrobus: <span class="badge badge-light"><?= $selected_metrobus[0] ?></span></h5>               
                </div>
                <div id="content">
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#connection_wifi">Conectarse a Wi-Fi</button>
                </div>
            </div>
        </div>
    </div>
   
    <div class="modal fade" id="connection_wifi" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title">Ingresa los siguientes datos para acceder a internet.</p>
                </div>
                <div class="modal-body">
                    <form  action="include/access.php" method="post" id="access-form">
                        <div class="form-group">
                            <input class="form-control" type="number" name="passengers" pattern="[0-9]*" min="1" id="passengers" placeholder="Numero de Pasajeros">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="end_station" id="end_station">
                                <option value="0" selected="selected">Estación de destino</option>
                                <?php
                                    while($row = $result_stations->fetch_assoc()){ ?>
                                        <option value="<?php echo $row['id']; ?>">
                                              <?php echo $row['nombre']; ?>
                                        </option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="start_station" id="start_station" value="<?= $start_station[0] ?>">
                        <input type="hidden" name="selected_metrobus" id="selected_metrobus" value="<?= $selected_metrobus[0] ?>">
                        <input type="hidden" name="update" value="1">

                        <input type="submit" value="Acceder" class="btn btn-dark" id="access-btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
      
    <?php include('table_metrobus_cupo_index.php') ?>

    <?php mysqli_close($conn); ?> 
    </div>   
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
       
</body>

</html>
















