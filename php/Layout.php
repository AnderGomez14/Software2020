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
      <img src="https://i.imgur.com/xdT6gxU.gif" style="max-height:170px;">
      <?php
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
      }
      $query = $mysqli->query("SELECT * FROM ranking ORDER BY (aciertos / (aciertos + fallos)) DESC LIMIT 10");
      if (mysqli_num_rows($query) != 0)
        echo "<br><br><h3>Ranking de Quizers</h3>";
      echo "<br><table id='ranking'><tr><th>Posicion</th><th>Apodo</th><th>Aciertos</th><th>Fallos</th><th>Puntacion</th></tr>";
      $cont = 1;
      while ($usuario = mysqli_fetch_array($query)) {
        $puntacion = round(($usuario['aciertos'] / ($usuario['aciertos'] + $usuario['fallos'])) * 100, 1);
        echo "<tr><td>" . $cont . "º</td><td>" . htmlspecialchars($usuario['nick']) . "</td><td>" . $usuario['aciertos'] . "</td><td>" . $usuario['fallos'] . "</td><td>" . $puntacion . "%</td></tr>";
        $cont += 1;
      }
      echo "</table>";
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>