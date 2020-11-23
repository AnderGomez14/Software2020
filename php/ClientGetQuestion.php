<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../styles/leaflet.css" />
    <script src="../js/leaflet.js"></script>
    <?php include '../html/Head.html' ?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div>
            <?php
            require_once('../lib/nusoap.php');
            require_once('../lib/class.wsdlcache.php');
            $soapclient = new nusoap_client('http://localhost/mikelgarcia-andergomez/php/GetQuestionWS.php?wsdl', true);
            if (isset($_GET['id'])) {
                $respuesta =  $soapclient->call('ObtenerPregunta', array('x' => $_GET['id']));
                echo $respuesta['enunciado'];
            }
            ?>
        </div>
    </section>
</body>

</html>