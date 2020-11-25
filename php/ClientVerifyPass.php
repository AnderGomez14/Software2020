<?php
require_once('DbConfig.php');
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
$soapclient = new nusoap_client($url . '/MikelGarcia-AnderGomez/php/VerifyPassWS.php?wsdl', true);


if (isset($_GET['contrasena']) && isset($_GET['codigo'])) {
    print $soapclient->call('pass', array($_GET['contrasena'], $_GET['codigo']));
}
