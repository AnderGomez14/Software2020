<?php if (!isset($_SESSION))
    session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div>
            <?php
            if (!isset($_SESSION['email'])) die('Pagina restringida solo para usuarios');
            //Uso la funcion htmlspecialchars para asi evitar posibles ataques XSS. 
            //Dado que sin eso, si por ejemplo pones <script>alert(1)</script> como enunciado de la pregunta,
            //al visualizar la tabla te saldria un aviso dejando en evidencia el XSS


            $xml = simplexml_load_file("../xml/Questions.xml");
            if (!$xml) die('Error al cargar el XML');

            echo '<table id="tshow" border=1> <tr> <th> Autor </th> <th> Enunciado </th> <th> Respuesta correcta </th> </tr>';

            foreach ($xml->children() as $pregunta) {
                echo '<tr><td>' . htmlspecialchars($pregunta->attributes()->author) . '</td>';
                echo '<td>' . $pregunta->children()->itemBody->children()->p . '</td>';
                echo '<td>' . htmlspecialchars($pregunta->children()->correctResponse->children()->response) . '</td></tr>';
            }

            echo '</table>';
            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>