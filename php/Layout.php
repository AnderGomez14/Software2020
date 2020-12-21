<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>Quiz: el juego de las preguntas</h2>
      <br>
      <img src="https://i.imgur.com/xdT6gxU.gif">
      <?php
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
      }
      $query = $mysqli->query("SELECT * FROM ranking");
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>