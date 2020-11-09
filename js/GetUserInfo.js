var xmlGlobal;
$(document).ready(function () {
    $.get('../xml/Users.xml', function (xml) {
        xmlGlobal = xml;
    })
});
function informacion() {
    var mail = $('#mail').val();
    var listaUsers = $(xmlGlobal).find('usuario');
    var done = false;
    for (var i = 0; i < listaUsers.length; i++) {
        if ($(listaUsers[i]).find('email').text() == mail) {
            done = true;
            $('#respuesta').show();
            $('#nombre').text($(listaUsers[i]).find('nombre').text());
            $('#apellidos').text($(listaUsers[i]).find('apellido1').text() + " " + $(listaUsers[i]).find('apellido2').text());
            $('#telefono').text($(listaUsers[i]).find('telefono').text());
            break;
        }
    }
    if (!done) alert('No hay ningun usuario con ese correo.');
}

function limpiar() {
    $('#respuesta').hide();
}
