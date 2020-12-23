<?php
include_once 'GameLogic.php';
include_once 'DbConfig.php';
if (!isset($_SESSION))
    session_start();
if (!isset($_GET['action'])) {
    die("Something went wrong!");
} else {
    if ($_GET['action'] == "comenzar") {
        if (!isset($_POST['tema'])) {
            error(4);
        } elseif (isset($_SESSION['gameSession'])) {
            error(6);
        } else {
            $GameSession = new GameLogic;
            $question = $GameSession->comenzarJuego($_POST['tema']);
            if (!is_array($question)) {
                error($question);
            } else {
                $_SESSION['gameSession'] = $GameSession;
                showQuestion($question);
            }
        }
    } elseif (isset($_SESSION['gameSession'])) {
        if ($_GET['action'] == "check") {
            if (!isset($_POST['respuesta']) || !is_numeric($_POST['respuesta']) || $_POST['respuesta'] < 0 || $_POST['respuesta'] > 3) {
                error(5);
            } else {
                $respuesta = $_SESSION['gameSession']->checkRespuesta($_POST['respuesta']);
                if (!is_array($respuesta)) {
                    error($respuesta);
                } else {
                    echo json_encode($respuesta);
                }
            }
        } elseif ($_GET['action'] == "feedback") {
            if (!isset($_POST['valoracion']))
                error(7);
            else {
                if ($_SESSION['gameSession']->feedback($_POST['valoracion']))
                    echo "OK";
                else
                    echo "ERROR";
            }
        } elseif ($_GET['action'] == "siguiente") {
            $question = $_SESSION['gameSession']->siguientePregunta();
            if (!is_array($question)) {
                error($question);
            } else {
                showQuestion($question);
            }
        } elseif ($_GET['action'] == "abandonar") {
            pantallaFinal();
        } elseif ($_GET['action'] == "subirResultados") {
            if (!isset($_POST['nick']))
                error(3);
            else {
                $lead = $_SESSION['gameSession']->subirResultados($_POST['nick']);
                if ($lead != -1)
                    error($lead);
                else {
                    unset($_SESSION['gameSession']);
                    echo "<script>alert('Los resultados se han guardado satisfactoriamente.');window.location.href='Layout.php';</script>";
                }
            }
        }
    }
}
/**
 * Esta funcion devolvera el codigo HTML de la pagina de una pregunta
 * 
 * Toma como argumento question, que sera un array con los datos de la pregunta
 */
function showQuestion($question)
{
    echo '<div id="score" class="score">Aciertos: <label id="aciertos">' . $question['aciertos'] . '</label> | Fallos: <label id="fallos">' . $question['fallos'] . '</label> | Tema: ' . htmlspecialchars($question['tema']) . ' | Pregunta: ' . $question['nPregunta'] . ' | Valoracion: <label id="likes">' . $question['likes'] . '</label> Me gusta / <label id="dislikes">' . $question['dislikes'] . '</label> No me gusta</div>';
    echo "<br><h1>" . htmlspecialchars($question['enum']) . "</h1>";
    $complejidad = "";
    if ($question['complejidad'] = '1')
        $complejidad = "Baja";
    elseif ($question['complejidad'] = '2')
        $complejidad = "Media";
    else
        $complejidad = "Alta";
    echo "Complejidad: " . $complejidad . "<br><br>";
    echo '<img src="' . $question['foto'] . '" style="max-width:25%;width:100%;max-height:25%;height:100%"><br><br><br>';
    echo '<table class="quizTable">
                <tr>
                    <td>
                        <button id="button0" class="quizButton" onclick="clickButton(this)" value="0">' . htmlspecialchars($question['respuestas'][0]) . '</button>
                    </td>
                    <td>
                        <button id="button1" class="quizButton" onclick="clickButton(this)" value="1">' . htmlspecialchars($question['respuestas'][1]) . '</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button id="button2" class="quizButton" onclick="clickButton(this)" value="2">' . htmlspecialchars($question['respuestas'][2]) . '</button>
                    </td>
                    <td>
                        <button id="button3" class="quizButton" onclick="clickButton(this)" value="3">' . htmlspecialchars($question['respuestas'][3]) . '</button>
                    </td>
                </tr>
            </table><br>';
    echo '<button id="action" onclick="comprobarPregunta()">Comprobar pregunta</button>';
    echo '<button id="abandonar" onclick="abandonar()">Abandonar</button>';
    echo "<script> var selected = -1;
                var selectedName = \"\";
                var widest = Math.max($('td').width());
                $('td').width(widest);

                function clickButton(button) {
                    selected = parseInt(button.value);
                    selectedName = button.innerHTML;
 var tds = document.getElementsByClassName('quizButton');
 Array.prototype.forEach.call(tds, function(td) {
 // Do stuff here
 td.style.backgroundColor = \"#292ce9\";
 td.style.color = \"white\";
 });

 button.style.backgroundColor = \"yellow\";
 button.style.color = \"black\";
 }</script>";
}

/**
 * Esta funcion devolvera el codigo HTML de la pagina de resultados
 */
function pantallaFinal()
{
    $resultados = $_SESSION['gameSession']->results();
    echo '            <h2>RESULTADOS</h2>
            Aciertos: ' . $resultados['aciertos'] . ' <br>
            Fallos: ' . $resultados['fallos'] . ' <br>
            Preguntas respondidas: ' . $resultados['nPregunta'] . ' <br><br>
            <img src="https://media.giphy.com/media/g9582DNuQppxC/giphy.gif"/><br><br>
            <label for="nickName">Apodo: </label>
            <input type="text" id="nickName" /><br><br>
            <button onclick="subirResultado()">Subir resultado a la tabla</button>
            <button onclick="window.location.href = \'play.php\';">Volver al comienzo</button>';
}

function error($id)
{
    if ($id == 0) {
        die("ERROR: No se ha respondido a la anterior pregunta");
    } elseif ($id == 1) {
        pantallaFinal();
        //die("ERROR: No quedan preguntas");
    } elseif ($id == 2) {
        die("ERROR: Ya se ha respondido a la pregunta");
    } elseif ($id == 3) {
        die("ERROR: Apodo no valido");
    } elseif ($id == 4) {
        die("ERROR: Falta el parametro Tema");
    } elseif ($id == 5) {
        die("ERROR: Falta el parametro Respuesta o no es valido");
    } elseif ($id == 6) {
        die("ERROR: Ya has iniciado el juego");
    } elseif ($id == 7) {
        die("ERROR: Falta el parametro valoracion");
    } elseif ($id == 8) {
        die("ERROR: Tema no valido");
    } elseif ($id == 9) {
        die("ERROR: No se puede subir los resultados");
    } elseif ($id == 10) {
        die("ERROR: No has acabado todavia");
    } else {
        die("ERROR: Error desconocido");
    }
}
