function distanciaEntreCoord(lat1, lon1, lat2, lon2) {
    var p = 0.017453292519943295; // Math.PI / 180
    var c = Math.cos;
    var a = 0.5 - c((lat2 - lat1) * p) / 2 +
        c(lat1 * p) * c(lat2 * p) *
        (1 - c((lon2 - lon1) * p)) / 2;

    return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
}
var map = L.map('map').setView([10, 0], 1.5);

var satIcon = L.icon({
    iconUrl: '../images/starlink.png',
    shadowUrl: '../images/null.png',

    iconSize: [32, 32], // size of the icon
    shadowSize: [32, 32], // size of the shadow
    popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
});

var clientIcon = L.icon({
    iconUrl: '../images/client.png',
    shadowUrl: '../images/null.png',

    iconSize: [32, 32], // size of the icon
    shadowSize: [32, 32], // size of the shadow
    popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
});

var serverIcon = L.icon({
    iconUrl: '../images/server.png',
    shadowUrl: '../images/null.png',

    iconSize: [32, 32], // size of the icon
    shadowSize: [32, 32], // size of the shadow
    popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
});


L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var xmlhttp = new XMLHttpRequest();
var url = "../php/getStarlinkJSON.php";
var starlink;
xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        starlink = JSON.parse(this.responseText);
        addSats();
    }
};
xmlhttp.open("GET", url, true);
xmlhttp.send();


var server = document.getElementById("coordServer").innerHTML.split(",")
var client = document.getElementById("coordClient").innerHTML.split(",")

L.marker([client[0], client[1]], {
    icon: clientIcon
}).addTo(map)
    .bindPopup('Usuario')
    .openPopup();


L.marker([server[0], server[1]], {
    icon: serverIcon
}).addTo(map)
    .bindPopup('Servidor')
    .openPopup();
var closeSatsClient = "";
var closeSatsServer = "";
var closeSatsServerArray = new Array;

document.getElementById("starlinkdiv").hidden = true;



function addSats() {
    var numeroSatsOrbita = 0;
    var numeroSatsOrbitaF = 0;

    for (var i = 0; i < starlink.sats.length; i++) {
        if (starlink.sats[i].lat2 !== 0 && starlink.sats[i].lng2 !== 0) {
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

            if (starlink.sats[i].lat2 > (parseFloat('-10.0') + parseFloat(client[0])) && starlink.sats[i].lat2 < (parseFloat('10.0') + parseFloat(client[0])) && starlink.sats[i].lng2 > (parseFloat('-10.0') + parseFloat(client[1])) && starlink.sats[i].lng2 < (parseFloat('10.0') + parseFloat(client[1]))) {
                if (distanciaEntreCoord(parseFloat(starlink.sats[i].lat2), parseFloat(starlink.sats[i].lng2), parseFloat(client[0]), parseFloat(client[1])) < 600)
                    closeSatsClient += starlink.sats[i].name + ", ";
            }

            if (starlink.sats[i].lat2 > (parseFloat('-10.0') + parseFloat(server[0])) && starlink.sats[i].lat2 < (parseFloat('10.0') + parseFloat(server[0])) && starlink.sats[i].lng2 > (parseFloat('-10.0') + parseFloat(server[1])) && starlink.sats[i].lng2 < (parseFloat('10.0') + parseFloat(server[1]))) {
                closeSatsServerArray.push(i);
                if (distanciaEntreCoord(parseFloat(starlink.sats[i].lat2), parseFloat(starlink.sats[i].lng2), parseFloat(server[0]), parseFloat(server[1])) < 600)
                    closeSatsServer += starlink.sats[i].name + ", ";
            }
            if (starlink.sats[i].periapsis < 555 && starlink.sats[i].periapsis > 545)
                numeroSatsOrbita += 1;
            else
                numeroSatsOrbitaF += 1;
        }
    }
    var table = document.getElementById("ipTable");
    var tr = document.createElement("tr");
    var c1 = document.createElement("th");
    var c2 = document.createElement("td");
    var c3 = document.createElement("td");

    c1.innerText = "Satelites en\nrango";
    c2.innerText = closeSatsClient;
    c3.innerText = closeSatsServer;

    tr.appendChild(c1);
    tr.appendChild(c2);
    tr.appendChild(c3);

    table.appendChild(tr);

    document.getElementById("numeroSatsOrbita").innerHTML = numeroSatsOrbita + numeroSatsOrbitaF;
    document.getElementById("numeroSatsCaidos").innerHTML = starlink.sats.length - (numeroSatsOrbita + numeroSatsOrbitaF);
    document.getElementById("numeroSatsOrbitaNF").innerHTML = numeroSatsOrbitaF;
    document.getElementById("numeroSatsOrbitaF").innerHTML = numeroSatsOrbita;

    document.getElementById("cargando").hidden = true;
    document.getElementById("starlinkdiv").hidden = false;




}
    //globus.planet.viewExtentArr([5.54, 45.141, 5.93, 45.23]);