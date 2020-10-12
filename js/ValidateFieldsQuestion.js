function validar(){
    var mail = $('#mail').val();
    var enunciado = $('#enunciado').val();
    var correcta = $('#correcta').val();
    var inco1 = $('#inco1').val();
    var inco2 = $('#inco2').val();
    var inco3 = $('#inco3').val();
    var complejidad = $('#complejidad').val();
    var tema = $('#tema').val();
    if(mail && enunciado && correcta && inco1 && inco2 && inco3 && complejidad && tema)
    {
        if(verificarMail(mail)){
            comp = parseInt(complejidad);
            if(1 <=comp && comp <= 3){
                if(enunciado.length>=10){
                    $('form').submit();
                }else{
                    console.log("Pregunta inferior a 10 caracteres");
                }
            }else{
                console.log("Complejidad incorrecta");
            }
        }else{
            console.log("Correo Incorrecto");
        }
    } else {
        console.log("Faltan datos");
    }
}

function verificarMail(Mail)
{
    var regexAlumno = /[a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es))/;
    var regexProf1 = /[a-zA-Z]*(.)[a-zA-Z]*(@ehu.)((eus)|(es))/;
    var regexProf2 = /[a-zA-Z]*(@ehu.)((eus)|(es))/;
    return regexAlumno.test(Mail) || regexProf1.test(Mail) || regexProf2.test(Mail);
}