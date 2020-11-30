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

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>