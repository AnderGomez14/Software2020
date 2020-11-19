<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
$soapclient = new nusoap_client('http://localhost/MikelGarcia-AnderGomez/php/VerifyPassWS.php?wsdl', true);

if (isset($_GET['contrasena'])) {
    $prueba = ($soapclient->call("comprobar", array("x" => $_GET["contrasena"])));
    if ($soapclient->call('comprobar', array('x' => $_GET['contrasena'])) == 'SI') {
        echo 'SI';
    } else {
        echo 'NO';
    }
}
