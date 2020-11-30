<?php if (!isset($_SESSION))
    session_start();
?>
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
            <?php if (!isset($_SESSION['email']) || $_SESSION['tipo'] != 'P') die('Pagina restringida solo para profesores');  ?>
            <label>IDs para probar: Cualquiera mayor o igual que 66</label>
            <form method="get" action="">
                <input type="text" name="id" required placeholder="ID de la pregunta">
                <input type="submit" value="Mostrar Pregunta">
            </form>
            <?php
            require_once('../lib/nusoap.php');
            require_once('../lib/class.wsdlcache.php');
            $soapclient = new nusoap_client($url . 'MikelGarcia-AnderGomez/php/GetQuestionWS.php?wsdl', true);
            if (isset($_GET['id'])) {
                $respuesta =  $soapclient->call('ObtenerPregunta', array('x' => $_GET['id']));
                if ($respuesta['enunciado'] == "")
                    echo 'No hay ninguna coincidencia con ID ' . $_GET['id'];
                else echo 'ID: ' . $respuesta['id'] . "<br> Autor: " . $respuesta['autor'] . "<br> Enunciado: " . $respuesta['enunciado'] . "<br> Respuesta correcta: " . $respuesta['respuesta_correcta'];
            }
            ?>
        </div>
    </section>
</body>

</html>