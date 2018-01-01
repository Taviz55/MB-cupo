 function update(){
    $.ajax({
        // la URL para la petición
    url : 'update_metrobus_cupo.php',
 
    // la información a enviar
    // (también es posible utilizar una cadena de datos)
    data : { 
        end: $("#end").val(),
        m_selected: $("#m_selected").val(),
        passen: $("#passen").val()
    },
 
    // especifica si será una petición POST o GET
    type : 'POST',
 
    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
    success : function() {
        $('.table_metrobus_cupo').load('access.php .table_metrobus_cupo');
    },
 
    // código a ejecutar si la petición falla;
    // son pasados como argumentos a la función
    // el objeto de la petición en crudo y código de estatus de la petición
    error : function(xhr, status) {
        alert('Disculpe, existió un problema');
    },
 
    });
}

function validaForm(){
     //Campos de texto
    if($("#passengers").val() == ""){
        alert("Debe ingresar el numero de pasajeros.");
        $("#passengers").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#end_station").val() == 0){
        alert("Debe selleccionar un destino.");
        $("#end_station").focus();
        return false;
    }

    return true; // Si todo está correcto
}

$(document).ready( function() { 
    
    //update();
    setInterval(update, 4000);

});

 