<!DOCTYPE html>
<html>

<head>
  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      Código PHP para mostrar una tabla con las preguntas de la BD.<br>
      La tabla no incluye las imágenes
      <br><br>
      <?php
      include 'DbConfig.php';
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
      }
      $preguntas = mysqli_query($mysqli, "select * from preguntas");
      echo '<table border=1> <tr> <th> Mail </th> <th> Enunciado </th> <th> Respuesta correcta </th> <th> Respuesta Incorrecta 1 </th> <th> Respuesta Incorrecta 2 </th> <th> Respuesta Incorrecta 3 </th> <th> Nivel de complejidad </th> <th> Tema </th> </tr>';
      //Uso la funcion htmlspecialchars para asi evitar posibles ataques XSS. 
      //Dado que sin eso, si por ejemplo pones <script>alert(1)</script> como enunciado de la pregunta,
      //al visualizar la tabla te saldria un aviso dejando en evidencia el XSS
      while ($row = mysqli_fetch_array($preguntas)) {
        echo '<tr><td>' . htmlspecialchars($row['mail']) . '</td> <td>' . htmlspecialchars($row['enum']) .
          '</td> <td>' . htmlspecialchars($row['correcta']) . '</td> <td>' . htmlspecialchars($row['inco1']) . '</td> <td>' . htmlspecialchars($row['inco2']) . '</td> <td>' . htmlspecialchars($row['inco3']) . '</td> <td>' . htmlspecialchars($row['complejidad']) . '</td> <td>' . htmlspecialchars($row['tema']) . '</td> </tr>';
      }
      echo '</table>';
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>