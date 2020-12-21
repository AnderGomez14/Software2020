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
            <h2>RESULTADOS</h2>
            Aciertos: 2 <br>
            Fallos: 3 <br>
            Preguntas respondidas: 5/6 <br><br>
            <label for="nickName">Apodo: </label>
            <input type="text" id="nickName" /><br><br>
            <button onclick="subirResultado()">Subir resultado a la tabla</button>
            <button onclick="reset()">Volver al comienzo</button>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>