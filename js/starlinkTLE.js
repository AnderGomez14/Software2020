var xmlhttp = new XMLHttpRequest();
var url = "../php/getStarlinkTLE.php?_=" + new Date().getTime();
var starlink;
var ready = false;
var time = new Date();
xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        parseTLE(this.responseText);
    }
};
xmlhttp.open("GET", url, true);
xmlhttp.send();

function parseTLE(response) {
    starlink = new Array;
    var txt = response.split("\n");
    var gmst = satellite.gstime(time);
    for (var i = 0; i < txt.length - 1; i += 3) {
        var temp = new Object;
        temp.name = txt[i].trim();
        temp.tle = satellite.twoline2satrec(txt[i + 1], txt[i + 2]);
        var positionEci = satellite.propagate(temp.tle, time).position;

        if (temp.tle.error == 0) {

            var positionGd = satellite.eciToGeodetic(positionEci, gmst);

            position = new Cesium.Cartesian3.fromRadians(positionGd.longitude, positionGd.latitude, positionGd.height * 1000);

            temp.entity = viewer.entities.add({
                name: temp.name,
                description: temp.name,
                position: position,
                billboard: {
                    image: "../images/starlink.png", // default: undefined
                    show: true, // default
                    scale: 1.0, // default: 1.0
                    width: 25, // default: undefined
                    height: 25, // default: undefined
                }
            });
            starlink.push(temp);
        }
    }
    ready = true;
}

var speedup = 0;
function reDrawStarlink() {
    time = new Date();
    if (false) { //True para subir la velocidad de la simulacion
        time.setSeconds(time.getSeconds() + speedup);
        speedup += 5;
    }
    if (ready) {
        var gmst = satellite.gstime(time);
        for (var i = 0; i < starlink.length; i++) {
            var positionEci = satellite.propagate(starlink[i].tle, time).position;
            var positionGd = satellite.eciToGeodetic(positionEci, gmst);
            starlink[i].entity.position._value = new Cesium.Cartesian3.fromRadians(positionGd.longitude, positionGd.latitude, positionGd.height * 1000);
        }
    }

}