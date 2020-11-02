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
      if (!isset($_GET['email'])) die('Pagina restringida solo para usuarios');
      include 'DbConfig.php';
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
      }
      $preguntas = mysqli_query($mysqli, "select * from preguntas_imagen");
      echo '<table id="tshow" border=1> <tr> <th> Mail </th> <th> Enunciado </th> <th> Respuesta correcta </th> <th> Respuesta Incorrecta 1 </th> <th> Respuesta Incorrecta 2 </th> <th> Respuesta Incorrecta 3 </th> <th> Nivel de complejidad </th> <th> Tema </th> <th> Foto </th> </tr>';
      //Uso la funcion htmlspecialchars para asi evitar posibles ataques XSS. 
      //Dado que sin eso, si por ejemplo pones <script>alert(1)</script> como enunciado de la pregunta,
      //al visualizar la tabla te saldria un aviso dejando en evidencia el XSS
      $dir = "../uploads/";
      while ($row = mysqli_fetch_array($preguntas)) {
        echo '<tr><td>' . htmlspecialchars($row['mail']) . '</td> <td>' . htmlspecialchars($row['enum']) .
          '</td> <td>' . htmlspecialchars($row['correcta']) . '</td> <td>' . htmlspecialchars($row['inco1']) . '</td> <td>' .
          htmlspecialchars($row['inco2']) . '</td> <td>' . htmlspecialchars($row['inco3']) . '</td> <td>' . htmlspecialchars($row['complejidad']) .
          '</td> <td>' . htmlspecialchars($row['tema']) . '</td> <td> <img src="' . $dir . $row['id'] . "." . $row['foto'] . '" style="max-height:300px;height:auto;max-width:300px;width:auto"></img> </td> </tr>';
      }
      echo '</table>';
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>