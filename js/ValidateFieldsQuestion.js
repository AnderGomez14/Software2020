function validar() {
    limpia();
    var mail = $('#mail').val();
    var enunciado = $('#enunciado').val();
    var correcta = $('#correcta').val();
    var inco1 = $('#inco1').val();
    var inco2 = $('#inco2').val();
    var inco3 = $('#inco3').val();
    var complejidad = $('#complejidad').val();
    var tema = $('#tema').val();
    if (mail && enunciado && correcta && inco1 && inco2 && inco3 && complejidad && tema) {
        limpia(mail, enunciado, correcta, inco1, inco2, inco3, tema)
        if (verificarMail(mail)) {
            comp = parseInt(complejidad);
            if (1 <= comp && comp <= 3) {
                if (enunciado.length >= 10) {
                    $('form').submit();
                } else {
                    $('#resul').text("Pregunta inferior a 10 caracteres");
                    var aux = $('#lenunciado');
                    aux.css("color", "red");
                }
            } else {
                $('#resul').text("Complejidad incorrecta");
            }
        } else {
            $('#resul').text("Correo Incorrecto");
            var aux = $('#lmail');
            aux.css("color", "red");
        }
    } else {
        $('#resul').text("Faltan datos");
        vacia(mail, enunciado, correcta, inco1, inco2, inco3, tema);

    }
}

function verificarMail(Mail) {
    var regexAlumno = /[a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es))/;
    var regexProf1 = /[a-zA-Z]*(.)[a-zA-Z]*(@ehu.)((eus)|(es))/;
    var regexProf2 = /[a-zA-Z]*(@ehu.)((eus)|(es))/;
    return regexAlumno.test(Mail) || regexProf1.test(Mail) || regexProf2.test(Mail);
}

function limpia() {

    var aux = $('#lmail');
    aux.css("color", "black");
    aux = $('#lenunciado');
    aux.css("color", "black");
    aux = $('#lcorrecta');
    aux.css("color", "black");
    aux = $('#linco1');
    aux.css("color", "black");
    aux = $('#linco2');
    aux.css("color", "black");
    aux = $('#linco3');
    aux.css("color", "black");
    aux = $('#ltema')
    aux.css("color", "black");
}

function vacia(mail, enunciado, correcta, inco1, inco2, inco3, tema) {
    if (!mail) {
        var aux = $('#lmail');
        aux.css("color", "red");
    }
    if (!enunciado) {
        var aux = $('#lenunciado');
        aux.css("color", "red");
    }
    if (!correcta) {
        var aux = $('#lcorrecta');
        aux.css("color", "red");
    }
    if (!inco1) {
        var aux = $('#linco1');
        aux.css("color", "red");
    }
    if (!inco2) {
        var aux = $('#linco2');
        aux.css("color", "red");
    }
    if (!inco3) {
        var aux = $('#linco3');
        aux.css("color", "red");
    }
    if (!tema) {
        var aux = $('#ltema');
        aux.css("color", "red");
    }
}