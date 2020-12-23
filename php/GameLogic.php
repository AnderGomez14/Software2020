<?php
class GameLogic
{
    private $numeroPregunta = 0;
    private $numeroPreguntasTotales;
    private $aciertos = 0;
    private $fallos = 0;
    private $preguntas_array;
    private $pregunta;
    private $respuesta = -1;
    private $feedback = false;

    /**
     * *Esta funcion es la que llama al comienzo del juego.
     * 
     * Devolvera 8 si el tema no es valido o no hay preguntas en la BD
     * Si todo va correctamente, devolvera una array con los datos de la primera pregunta
     */
    public function comenzarJuego($tema)
    {
        include 'DbConfig.php';
        $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
        if (!$mysqli) {
            echo ('MAL');
            die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
        }
        $tema = mysqli_real_escape_string($mysqli, $tema);
        if (empty($tema)) {
            $preguntas = mysqli_query($mysqli, "select * from preguntas_imagen");
        } else {
            $preguntas = mysqli_query($mysqli, "select * from preguntas_imagen where tema='" . $tema . "'");
        }
        if (mysqli_num_rows($preguntas) == 0)
            return 8;
        $this->preguntas_array = array();
        while ($pregunta = mysqli_fetch_array($preguntas)) {
            array_push($this->preguntas_array, $pregunta);
        }
        shuffle($this->preguntas_array);
        $this->numeroPreguntasTotales = count($this->preguntas_array);
        return $this->siguientePregunta();
    }

    /**
     * Esta funcion es la que se encarga de pasar a la siguiente pregunta
     * 
     * Si no quedan preguntas, devolvera 1.
     * Si no se ha respondido a la anterior pregunta, devolvera 0
     * 
     * Si todo va correctamente, devolvera una array con los datos de la siguiente pregunta
     */
    public function siguientePregunta()
    {
        if ($this->respuesta != -1)
            return 0;
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
                "tema" => $this->pregunta['tema'],
                "nPregunta" => $this->numeroPregunta . "/" . $this->numeroPreguntasTotales,
                "likes" => $this->pregunta['likes'],
                "dislikes" => $this->pregunta['dislikes'],
                "aciertos" => $this->aciertos,
                "fallos" => $this->fallos,
            );
        } else
            return 1;
    }

    /**
     * Esta funcion comprobara el resultado del usuario
     * 
     * Recibe como argumento respuesta, que sera un numero del 0 al 3
     * 
     * En caso de que ya se haya respondido a la pregunta anteriormente, devolvera 2
     * 
     * Si todo va correctamente, devolvera una array con los datos del resultado
     */
    public function checkRespuesta($respuesta)
    {
        if ($this->respuesta == -1)
            return 2;
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

    /**
     * Esta funcion añadira la valoracion que ha hecho el usuario a la BD
     * 
     * Recibe como argumento val, que sera "like" o "dislike"
     * 
     * Deuvelve false si el string no es "like" o "dislike", si todavia no se ha respondido a la pregunta o si
     * ya a ha valorado esa pregunta.
     *  
     * Devolvera true si se ha valorado correctamente la pregunta
     */
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
    /**
     * Esta funcion cargará los resultados
     * 
     * Vaciará el array de preguntas por sea acaso y devolvera un array con los resultados obtenidos 
     */
    public function results()
    {
        if ($this->respuesta != -1) $this->numeroPregunta -= 1;
        $this->preguntas_array = array();
        return array("nPregunta" => $this->numeroPregunta . "/" . $this->numeroPreguntasTotales, "aciertos" => $this->aciertos, "fallos" => $this->fallos,);
    }

    /**
     * Esta funcion subirá los resultados al ranking
     * 
     * Recibe como argumento nick, que sera el apodo que ha introducido el usuario
     * 
     * Si nick es vacio, devolvera 3.
     * Si no ha contestado ninguna pregunta, devolvera 9
     * Si todavia esta jugando, devolvera 10
     * 
     * Devolvera -1 si todo va bien
     */
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
            if ($this->aciertos == 0 && $this->fallos == 0)
                return 9;
            mysqli_query($mysqli, "INSERT INTO ranking (nick, aciertos, fallos) VALUES ('" . $nick . "', " . $this->aciertos . ", " . $this->fallos . ") ON DUPLICATE KEY UPDATE aciertos = aciertos + " . $this->aciertos . " , fallos = fallos + " . $this->fallos . ";");
            return -1;
        } else return 10;
    }
}
