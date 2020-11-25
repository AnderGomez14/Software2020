<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$soapclient = new nusoap_client('https://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl', true);

if (isset($_GET['email'])) {
    //$prueba = ($soapclient->call("comprobar", array("x" => $_GET["email"])));
    if ($soapclient->call('comprobar', array('x' => $_GET['email'])) == 'SI') {
        echo 'SI';
    } else {
        echo 'NO';
    }
}
