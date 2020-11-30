function esValido() {
    $.ajax({
        type: "GET",
        url: "../php/esValido.php",
        data: { email: $("#usuarios").val() },
        success: function (response) {
            var resul = response;
            if(response == "A")
            $('#estado').html('Activado');
            else
            $('#estado').html('Bloqueado');
        }
    });
}

function cambiarEstado(){
    $.ajax({
       type: "GET", 
    });
}