<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../styles/leaflet.css" />
  <script src="../js/leaflet.js"></script>
  <?php include '../html/Head.html' ?>
  <script>
    var xmlhttp = new XMLHttpRequest();
    var url = "../php/getStarlinkJSON.php";
    var starlink;
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        starlink = JSON.parse(this.responseText);
        addSats();
      }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
  </script>
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

    </div><br>
    <div id="map" style="height: 500px;"></div>
  </section>
  <?php include '../html/Footer.html' ?>
  <script>
    var map = L.map('map').setView([51.505, -0.09], 1);

    var satIcon = L.icon({
      iconUrl: '../images/starlink.png',
      shadowUrl: '../images/null.png',

      iconSize: [32, 32], // size of the icon
      shadowSize: [32, 32], // size of the shadow
      popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
    });
    L.Icon.Default.prototype.options.iconUrl = '../starlink.png';
    L.Icon.Default.prototype.options.shadowUrl = '../null.png';


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    function addSats() {
      for (var i = 0; i < starlink.sats.length; i++) {
        if (starlink.sats[i].lat2 !== 0 && starlink.sats[i].lng21 !== 0) {
          L.marker([starlink.sats[i].lat2, starlink.sats[i].lng2], {
              icon: satIcon
            }).addTo(map)
            .bindPopup(starlink.sats[i].name)
            .openPopup();
          L.circle([starlink.sats[i].lat2, starlink.sats[i].lng2], {
            color: 'red',
            opacity: 0.3,
            fillColor: '#f03',
            fillOpacity: 0.1,
            radius: 600000
          }).addTo(map);
        }
      }
    }
    //globus.planet.viewExtentArr([5.54, 45.141, 5.93, 45.23]);
  </script>
</body>

</html>