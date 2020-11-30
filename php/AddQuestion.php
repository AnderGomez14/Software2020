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
      if (!isset($_SESSION['email']))
        die('ERROR');
      //error_reporting(E_ALL ^ E_NOTICE);
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
        die('Fallo al conectar a MySQL');
      }
      if (empty($_GET['mail']) || empty($_GET['enum']) || empty($_GET['correcta']) || empty($_GET['inco1']) || empty($_GET['inco2']) || empty($_GET['inco3']) || empty($_GET['complejidad']) || empty($_GET['tema'])) {
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
        die('Error: Faltan parametros');
      } else if (!(preg_match("/([a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es)))|([a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es)))|([a-zA-Z]+(@ehu.)((eus)|(es)))/", $_GET['mail']) && strlen($_GET['enum']) >= 10 && $_GET['complejidad'] >= 1 && $_GET['complejidad'] <= 3)) {
        echo ('Error: Datos incorrectos.');
        echo '<br> <img src="https://pbs.twimg.com/media/EiEMspkX0AMfWG8.jpg" style="max-width:300px;width:100%"></img> <br>';
      } else {
        $query = $mysqli->prepare("INSERT INTO preguntas(mail,enum,correcta,inco1,inco2,inco3,complejidad,tema) VALUES (?,?,?,?,?,?,?,?)");
        $query->bind_param("ssssssis", $_GET['mail'], $_GET['enum'], $_GET['correcta'], $_GET['inco1'], $_GET['inco2'], $_GET['inco3'], $_GET['complejidad'], $_GET['tema']);
        //Esto lo he hecho asi para evitar ataques de SQL Injection
        if (!$query->execute()) {
          echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
          die('Error: No se ha podido añadir a la base de datos');
        } else {
          echo 'Todo bien';
          echo '<br> <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/499/826/2f0.png" style="max-width:300px;width:100%"></img> <br>';
          echo "<p><a href='ShowQuestions.php'> Ver Preguntas</a>";
        }
      }
      mysqli_close($mysqli);
      ?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>