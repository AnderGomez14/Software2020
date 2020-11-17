<?php
$xml = simplexml_load_file("../xml/Questions.xml");
if (!$xml) die('Error al cargar el XML');

echo '<table id="tshow" border=1> <tr> <th> Autor </th> <th> Enunciado </th> <th> Respuesta correcta </th> </tr>';

foreach ($xml->children() as $pregunta) {
    echo '<tr><td>' . htmlspecialchars($pregunta->attributes()->author) . '</td>';
    echo '<td>' . htmlspecialchars($pregunta->children()->itemBody->children()->p) . '</td>';
    echo '<td>' . htmlspecialchars($pregunta->children()->correctResponse->children()->response) . '</td></tr>';
}

echo '</table>';
