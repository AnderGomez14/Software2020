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
      include 'SubirImagen.php';
      //error_reporting(E_ALL ^ E_NOTICE);
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
      }
      if (!(isset($_POST['mail']) && isset($_POST['enum']) && isset($_POST['correcta']) && isset($_POST['inco1']) && isset($_POST['inco2']) && isset($_POST['inco3']) && isset($_POST['complejidad']) && isset($_POST['tema']))) {
        echo ('Error: Faltan parametros');
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
      } else {
        $tipo = strtolower(pathinfo(basename($_FILES["archivosubido"]["name"]), PATHINFO_EXTENSION));
        if (!mysqli_query($mysqli, "INSERT INTO preguntas_imagen(mail,enum,correcta,inco1,inco2,inco3,complejidad,tema,foto) VALUES ('$_POST[mail]','$_POST[enum]','$_POST[correcta]','$_POST[inco1]','$_POST[inco2]','$_POST[inco3]','$_POST[complejidad]','$_POST[tema]','$tipo')"))
          die('Error: No se ha podido añadir a la base de datos' . mysqli_error($mysqli));
        $id = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id FROM preguntas_imagen ORDER BY id DESC LIMIT 1"))['id'];
        if (!subir($_FILES, $target_dir, $id)) {
          mysqli_query($mysqli, "DELETE FROM preguntas_imagen WHERE id = '$id'");
          die();
        }
        echo 'Todo bien';
        echo '<br> <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/499/826/2f0.png" style="max-width:300px;width:100%"></img> <br>';
        echo "<p><a href='ShowQuestionsWithImage.php'> Ver Preguntas</a>";
      }
      mysqli_close($mysqli);
      ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>