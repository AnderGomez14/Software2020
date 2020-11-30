<?php
if (!isset($_SESSION))
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../styles/leaflet.css" />
  <script src="../js/leaflet.js"></script>
  <script type="text/javascript" src="https://geographiclib.sourceforge.io/scripts/geographiclib.js"></script>
  <script src="https://cesium.com/downloads/cesiumjs/releases/1.75/Build/Cesium/Cesium.js"></script>
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.75/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>Mikel Garcia Bartolome y Ander Gomez Fernández<br></h2>
      <h2>Ingenieria del Software<br></h2><br>
      <h3> mgarcia404@ikasle.ehu.eus <br>
        agomez302@ikasle.ehu.eus <br><br>
        <img src="../uploads/mikel.jpg" width="200" height="200">
        <img src="../uploads/ander.jpg" width="200" height="200"></h3>
      <?php
      include 'DbConfig.php';
      $local = 1;
      if ($local == 1) {
        $clientIP = '85.86.11.13';
        $serverIP = '145.14.145.112';
      } else {
        $clientIP = $_SERVER['REMOTE_ADDR'];
        $serverIP = $_SERVER['SERVER_ADDR'];
      }

      $cliente = json_decode(file_get_contents("http://ipinfo.io/{$clientIP}/json"));
      $servidor = json_decode(file_get_contents("http://ipinfo.io/{$serverIP}/json"));

      echo '<table id="ipTable" style="  margin-left: auto;
  margin-right: auto;" border=1> <tr><th></th> <th> Cliente </th> <th> Servidor </th> </tr>';
      echo '<tr> <th> IP </th> <td> ' . $cliente->ip . ' </td> <td> ' . $servidor->ip . ' </td> </tr>';
      echo '<tr> <th> Ciudad </th> <td> ' . $cliente->city . ' </td> <td> ' . $servidor->city . ' </td> </tr>';
      echo '<tr> <th> Region </th> <td> ' . $cliente->region . ' </td> <td> ' . $servidor->region . ' </td> </tr>';
      echo '<tr> <th> Pais </th> <td> ' . $cliente->country . ' <img src="https://raw.githubusercontent.com/stevenrskelton/flag-icon/master/png/16/country-squared/' . strtolower($cliente->country) . '.png"> </td> <td> ' . $servidor->country . ' <img src="https://raw.githubusercontent.com/stevenrskelton/flag-icon/master/png/16/country-squared/' . strtolower($servidor->country) . '.png"> </td> </tr>';
      echo '</table>';
      echo '<div id="coordClient" hidden>' . $cliente->loc . '</div>';
      echo '<div id="coordServer" hidden>' . $servidor->loc . '</div>';

      ?><br>
      <div id="cargando"><img src="https://thumbs.gfycat.com/TemptingOptimisticAlbacoretuna-size_restricted.gif"></img></div>
      <div id="starlinkdiv">
        <h>ESTADISTICAS STARLINK </h><br>
        <p>Numero de satelites en orbita: <p id="numeroSatsOrbita">
          </p>
          <p>Numero de satelites en orbita final: <p id="numeroSatsOrbitaF">
            </p>
          </p>
        </p>
        <p>Numero de satelites desorbitados: <p id="numeroSatsCaidos">
          </p>
        </p>
        <p>Numero de satelites que estan ascendiendo: <p id="numeroSatsOrbitaNF">
          </p>
        </p>

        <br>
        <div id="map" style="height: 500px;"></div>
      </div>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  <script src="../js/Starlink.js"></script>
</body>

</html>