function esValido() {
    $('#estado').html('');
    $.ajax({
        type: "GET",
        url: "../php/esValido.php",
        data: { email: $("#usuarios").val() },
        success: function (response) {
            var resul = response;
            if (response == "A")
                $('#estado').html('Activado');
            else
                $('#estado').html('Bloqueado');
        }
    });
}

function cambiarEstado() {
    $('#estado').html('');
    if ($("#usuarios").val() != "admin@ehu.es") {
        if (confirm("Quieres cambiar el estado del usuario " + $("#usuarios").val()))
            $.ajax({
                type: "GET",
                url: "../php/ChangeUserState.php",
                data: { email: $("#usuarios").val() },
            });
    } else
        if (confirm("Seguro que quieres bloquear a un Administrador?")) {
            window.location.href = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
        }
}

function eliminarUser() {
    $('#estado').html('');
    if ($("#usuarios").val() != "admin@ehu.es") {
        if (confirm("Quieres eliminar al usuario " + $("#usuarios").val()))
            $.ajax({
                type: "GET",
                url: "../php/RemoveUser.php",
                data: { email: $("#usuarios").val() },
                success: function (response) {
                    location.reload();
                }
            });
    } else
        if (confirm("Estas seguro de eliminar a un Administrador?")) {
            window.location.href = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
        }


}