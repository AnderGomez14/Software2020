<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <script src="../js/starlinkTLE.js"></script>
    <script src="https://cesium.com/downloads/cesiumjs/releases/1.75/Build/Cesium/Cesium.js"></script>
    <link href="https://cesium.com/downloads/cesiumjs/releases/1.75/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/satellite.js/4.1.2/satellite.min.js" integrity="sha512-vPUNwJL2fh3Z31Gcd8AXpbctnJsfzU1+SlM3RWaYdmoIvQmFh15XS2unNjkUI5A9ZXD/fVjw2JGeOELEos5TKw==" crossorigin="anonymous"></script>
</head>

<body>
    <div id="cesiumContainer"></div>
</body>

<script>
    Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIwOTI4YTQ3My0xNjZmLTQ4OWEtYjY2Ny1hMjA4NzNkMDY0MDciLCJpZCI6Mzg1MDMsImlhdCI6MTYwNjQxNTk3OX0.sseuw21q-iTk-H7W6JOd08fygnVir-sSUDZ8mDIxeiw';
    const viewer = new Cesium.Viewer('cesiumContainer', {
        terrainProvider: Cesium.createWorldTerrain(),
        infoBox: false,
        selectionIndicator: false
    });
    //viewer.animation.container.style.visibility = 'hidden';
    //viewer.timeline.container.style.visibility = 'hidden';
    //viewer._toolbar.style.visibility = 'hidden';
    //viewer.forceResize();

    window.setInterval(function() {
        reDrawStarlink();
    }, 50);
</script>

</html>