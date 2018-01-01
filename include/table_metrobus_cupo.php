<?php 
    require('connection.php');
   // require('selected_metrobus.php');
    $query_metrobus =  "SELECT metrobus_cupo.*, estacion.nombre AS estacion, tipo_metrobus.capacidad
                        FROM metrobus_cupo
                        INNER JOIN estacion
                        ON estacion.id = metrobus_cupo.estacion_id
                        INNER JOIN metrobus
                        ON metrobus.id = metrobus_cupo.metrobus_id
                        INNER JOIN tipo_metrobus
                        ON tipo_metrobus.id = tipo_metrobus_id";

    $result_metrobus = mysqli_query($conn, $query_metrobus);

?>

<div class="row">
    <div style="padding: 0;" class="col table_metrobus_cupo">
        <table class="table table-dark">
          <thead>
            <tr>
              <th>Dirección</th>
              <th>Estación</th>
              <th>Disponible</th>
            </tr>
          </thead>
          <tbody>
          <?php  
             if($result_metrobus){
                 while($row = mysqli_fetch_array($result_metrobus)) { ?>
                    <?php $cupo = $row['capacidad'] - $row['cupo'];  ?>  
                    
                   <?php  
                        if($cupo <= 5)
                            $clase = "sobreCupo";
                        elseif($cupo > 5 && $cupo <= 20)  
                            $clase = "cupoAlto";
                        elseif($cupo >= 30)
                            $clase = "cupoBajo";              
                    ?>
                    
                    <?php if($row['metrobus_id'] == $selected){ ?>                    
                        <tr style="font-size: 14px;" class='bg-light text-dark'>
                            <td><strong><?= $row['direccion']; ?></strong></td>
                            <td><strong><?= $row['estacion']; ?></strong></td>
                            <td><strong><?= "+- ".$cupo; ?></strong></td>
                        </tr>
                   <?php }else{ ?>
                        <tr>
                            <td><?= $row['direccion']; ?></td>
                            <td><?= $row['estacion']; ?></td>
                            <td class="<?= $clase; ?>"><?= "+- ".$cupo; ?></td>
                        </tr>
                   <?php  } ?>
                <?php } ?>
            <?php } ?>   
         </tbody>
        </table>
    </div>
</div>
