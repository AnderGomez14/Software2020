<?php
error_reporting(0);
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$ns = "http://localhost/mikelgarcia-andergomez/php/VerifyPassWS.php";
$server = new soap_server();
$server->configureWSDL('pass', $ns);
$server->wsdl->schemaTargetNamespace = $ns;

$server->register('pass', array('x' => 'xsd:string'), array('z' => 'xsd:string'), $ns);
function pass($contrasena)
{
    $comprobador = file_get_contents("../txt/toppasswords.txt");
    $pos = strpos($comprobador, $contrasena);
    if ($pos === false) {
        return 'SI';
    } else {
        return 'NO';
    }
    return 'SI';
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents("php://input");
$server->service($HTTP_RAW_POST_DATA);
