function comenzarJuego() {
    var tema = $('#tema').find(":selected").val();
    $.ajax({
        type: "POST",
        url: "../php/GameManager.php?action=comenzar",
        data: { tema: tema },
        success: function (response) {
            $('#game').html(response);
        }
    });
}
function comprobarPregunta() {
    if (selected == -1)
        alert("Selecciona una pregunta.")
    else {
        if (window.confirm("¿Es \"" + selectedName + "\" tu respuesta final?")) {
            $.ajax({
                type: "POST",
                url: "../php/GameManager.php?action=check",
                data: { respuesta: selected },
                success: function (response) {
                    try {
                        var data = JSON.parse(response);
                        if (isNaN(parseInt(data.resultado)))
                            document.getElementById('button' + selected).style.backgroundColor = "green";
                        else {
                            document.getElementById('button' + selected.toString()).style.backgroundColor = "red";
                            document.getElementById('button' + selected.toString()).style.color = "white";
                            document.getElementById('button' + data.resultado.toString()).style.backgroundColor = "green";
                        }
                        var tds = document.getElementsByClassName('quizButton');
                        Array.prototype.forEach.call(tds, function (td) {
                            td.disabled = "true";
                        });
                        $('#aciertos').html(data.aciertos.toString());
                        $('#fallos').html(data.fallos.toString());
                        $('#action').attr("onclick", "siguientePregunta()");
                        $('#action').html("Siguiente Pregunta");
                        var button = $("<button onclick='feedback(\"like\");'></button>").text("Me gusta");
                        var button2 = $("<button onclick='feedback(\"dislike\");'></button>").text("No me gusta");


                        $('#game').append("<br> ¿Te ha gustado la pregunta?: ", button, button2)

                    } catch (error) {
                        alert(response);
                    }
                }
            });
        }
    }
}

function feedback(feedback) {
    $.ajax({
        type: "POST",
        url: "../php/GameManager.php?action=feedback",
        data: { valoracion: feedback },
        success: function (response) {
            if (response == "OK") {
                if (feedback == "like") $('#likes').html((parseInt($('#likes').html()) + 1).toString());
                else $('#dislikes').html((parseInt($('#dislikes').html()) + 1).toString());
            } else alert("Ya has valorado esta pregunta");
        }
    });

}

function siguientePregunta() {
    $.ajax({
        type: "POST",
        url: "../php/GameManager.php?action=siguiente",
        success: function (response) {
            $('#game').html(response);
        }
    });
}


function reset() {
    $.ajax({
        type: "POST",
        url: "../php/GameManager.php?action=reset",
        success: function (response) {
            $('#game').html(response);
        }
    });
}

function abandonar() {
    $.ajax({
        type: "POST",
        url: "../php/GameManager.php?action=abandonar",
        success: function (response) {
            $('#game').html(response);
        }
    });
}

function subirResultado() {
    var nickName = $("#nickName").val();
    if (nickName == "" || !nickName.trim()) {
        alert("Introduce un apodo.");
    } else
        $.ajax({
            type: "POST",
            url: "../php/GameManager.php?action=subirResultados",
            data: { nick: nickName },
            success: function (response) {
                $('#game').html(response);
            }
        });
}