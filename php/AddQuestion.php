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
      include 'DbConfig.php';
      //error_reporting(E_ALL ^ E_NOTICE);
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
        die('Fallo al conectar a MySQL');
      }
      if (!(isset($_GET['mail']) && isset($_GET['enum']) && isset($_GET['correcta']) && isset($_GET['inco1']) && isset($_GET['inco2']) && isset($_GET['inco3']) && isset($_GET['complejidad']) && isset($_GET['tema']))) {
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
        die('Error: Faltan parametros');
      } else if (!mysqli_query($mysqli, "INSERT INTO preguntas(mail,enum,correcta,inco1,inco2,inco3,complejidad,tema) VALUES ('$_GET[mail]','$_GET[enum]','$_GET[correcta]','$_GET[inco1]','$_GET[inco2]','$_GET[inco3]','$_GET[complejidad]','$_GET[tema]')")) {
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
        die('Error: No se ha podido añadir a la base de datos');
      } else {
        echo 'Todo bien';
        echo '<br> <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/499/826/2f0.png" style="max-width:300px;width:100%"></img> <br>';
        echo "<p><a href='ShowQuestions.php'> Ver Preguntas</a>";
      }
      mysqli_close($mysqli);
      ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>