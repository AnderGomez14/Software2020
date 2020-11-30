<!DOCTYPE html>
<html>

<head>
    <?php session_start() ?>
    <link rel="stylesheet" href="../styles/leaflet.css" />
    <script src="../js/leaflet.js"></script>
    <?php include '../html/Head.html' ?>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div>
            <?php
            include 'DbConfig.php';
            if (!isset($_GET['email'])) die('Pagina restringida solo para usuarios');
            $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                echo ('MAL');
                die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
            }
            $email = mysqli_real_escape_string($mysqli, $_GET['email']);
            $query = $mysqli->query("SELECT * FROM users WHERE email ='" . $email . "' AND tipo='P'");
            if ($query->num_rows === 0)
                die('Area restringida solo para profesores');
            ?>
            <label>IDs para probar: Cualquiera mayor o igual que 66</label>
            <form method="get" action="">
                <input type="text" name="email" value="<?php echo $_GET['email']; ?>" hidden>
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