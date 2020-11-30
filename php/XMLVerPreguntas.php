<?php
$xml = simplexml_load_file("../xml/Questions.xml");
if (!$xml) die('Error al cargar el XML');
if (!isset($_SESSION)) {
    session_start();
}



if (isset($_SESSION['email'])) {
    echo '<table id="tshow" style="margin: 0px auto" border=1> <tr> <th> Autor </th> <th> Enunciado </th> <th> Respuesta correcta </th> </tr>';

    foreach ($xml->children() as $pregunta) {
        echo '<tr><td>' . htmlspecialchars($pregunta->attributes()->author) . '</td>';
        echo '<td>' . htmlspecialchars($pregunta->children()->itemBody->children()->p) . '</td>';
        echo '<td>' . htmlspecialchars($pregunta->children()->correctResponse->children()->response) . '</td></tr>';
    }

    echo '</table>';
}
