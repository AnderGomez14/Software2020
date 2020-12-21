<?php
class GameLogic
{

    // Declaración de una propiedad
    private $tema;
    private $numeroPregunta = 0;
    private $numeroPreguntasTotales;
    private $aciertos = 0;
    private $fallos = 0;
    private $preguntas_array;
    private $pregunta;
    private $respuesta = -1;
    private $feedback = false;


    // Declaración de un método
    public function comenzarJuego($tema)
    {
        include 'DbConfig.php';
        $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
        if (!$mysqli) {
            echo ('MAL');
            die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
        }
        $tema = mysqli_real_escape_string($mysqli, $tema);
        $this->tema = $tema;
        $preguntas = mysqli_query($mysqli, "select * from preguntas_imagen where tema='" . $tema . "'");
        if (mysqli_num_rows($preguntas) == 0)
            return ("ERROR: Tema no valido");
        $this->preguntas_array = array();
        while ($pregunta = mysqli_fetch_array($preguntas)) {
            array_push($this->preguntas_array, $pregunta);
        }
        shuffle($this->preguntas_array);
        $this->numeroPreguntasTotales = count($this->preguntas_array);
        return $this->siguientePregunta();
    }

    public function siguientePregunta()
    {
        if ($this->respuesta != -1)
            return 0; //0 = No se ha respondido a la anterior pregunta
        $this->pregunta = array_pop($this->preguntas_array);
        if ($this->pregunta != null) {
            $this->numeroPregunta += 1;
            $respuestas = array($this->pregunta['correcta'], $this->pregunta['inco1'], $this->pregunta['inco2'], $this->pregunta['inco3']);
            shuffle($respuestas);
            foreach ($respuestas as $index => $temp) {
                if ($temp == $this->pregunta['correcta']) {
                    $this->respuesta = $index;
                    break;
                }
            }
            $this->feedback = false;
            return array(
                "enum" => $this->pregunta['enum'],
                "respuestas" => $respuestas,
                "foto" => "../uploads/" . $this->pregunta['id'] . "." . $this->pregunta['foto'],
                "complejidad" => $this->pregunta['complejidad'],
                "tema" => $this->tema,
                "nPregunta" => $this->numeroPregunta . "/" . $this->numeroPreguntasTotales,
                "likes" => $this->pregunta['likes'],
                "dislikes" => $this->pregunta['dislikes'],
                "aciertos" => $this->aciertos,
                "fallos" => $this->fallos,
            );
        } else
            return 1; //1 = No quedan preguntas
    }

    public function checkRespuesta($respuesta)
    {
        if ($this->respuesta == -1)
            return 2; //2 = Ya se ha respondido a la pregunta
        if ($respuesta == $this->respuesta) {
            $resultado = True;
            $this->aciertos += 1;
        } else {
            $resultado = $this->respuesta;
            $this->fallos += 1;
        }
        $this->feedback = true;
        $this->respuesta = -1;

        return array("resultado" => $resultado, "aciertos" => $this->aciertos, "fallos" => $this->fallos,);
    }

    public function feedback($val)
    {
        if ($this->respuesta == -1 && $this->feedback) {
            include 'DbConfig.php';
            $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                echo ('MAL');
                die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
            }
            if ($val == "like")
                mysqli_query($mysqli, "UPDATE preguntas_imagen SET likes = likes + 1 WHERE id=" . $this->pregunta['id']);
            elseif ($val == "dislike")
                mysqli_query($mysqli, "UPDATE preguntas_imagen SET dislikes = dislikes + 1 WHERE id=" . $this->pregunta['id']);
            else return false;
            $this->feedback = false;
            return true;
        } else return false;
    }

    public function results()
    {
        if ($this->respuesta != -1) $this->numeroPregunta -= 1;
        $this->preguntas_array = array();
        return array("nPregunta" => $this->numeroPregunta . "/" . $this->numeroPreguntasTotales, "aciertos" => $this->aciertos, "fallos" => $this->fallos,);
    }

    public function subirResultados($nick)
    {
        if (count($this->preguntas_array) == 0) {
            include 'DbConfig.php';
            $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                echo ('MAL');
                die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
            }
            $nick = mysqli_real_escape_string($mysqli, $nick);
            if (strlen(trim($nick)) == 0)
                return 3;
            $check = mysqli_query($mysqli, "SELECT * FROM ranking WHERE nick='" . $nick . "'");
            if (mysqli_num_rows($check) != 0)
                mysqli_query($mysqli, "UPDATE ranking SET aciertos = aciertos + " . $this->aciertos . " , fallos = fallos + " . $this->fallos . " WHERE nick='" . $nick . "'");
            else
                mysqli_query($mysqli, "INSERT INTO ranking (nick, aciertos, fallos) VALUES ('" . $nick . "', " . $this->aciertos . ", " . $this->fallos . ")");
            return -1;
        }
    }
}
