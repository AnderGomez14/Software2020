<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
$soapclient = new nusoap_client('http://localhost/MikelGarcia-AnderGomez/php/VerifyPassWS.php?wsdl', true);
$codigo = 1010;

if (isset($_GET['contrasena'])) {
    echo $soapclient->call('pass', array('x' => $_GET['contrasena'], 'y' => $codigo));
}
