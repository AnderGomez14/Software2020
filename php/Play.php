<?php if (!isset($_SESSION))
    session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/game.js"></script>
    <script src="../js/jquery-3.4.1.min.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="game">
            <?php
            unset($_SESSION['gameSession']);
            echo '<h2>Bienvenido al Quiz</h2>
                Selecciona una tema para comenzar a jugar <br>
                <select id="tema">';

            include 'DbConfig.php';
            $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                echo ('MAL');
                die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
            }
            $temas = mysqli_query($mysqli, "SELECT DISTINCT tema FROM preguntas_imagen");
            echo '<option disabled selected>Selecciona un tema</option>';
            while ($tema = mysqli_fetch_array($temas)) {
                echo '<option value="' . $tema[0] . '">' . $tema[0] . '</option>';
            }
            echo '</select> <br><br>  <img src="../uploads/ajugar.gif" style="max-width: 320px;"/> <br> <br>  <input type="button" onclick="comenzarJuego()" value="A Jugaaaaar!"></input>';

            ?><br>

        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>