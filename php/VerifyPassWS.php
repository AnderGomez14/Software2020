<?php
error_reporting(0);
require_once('DbConfig.php');
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$ns = $url . "MikelGarcia-AnderGomez/php/VerifyPassWS.php";
$server = new soap_server();
$server->configureWSDL('pass', $ns);
$server->wsdl->schemaTargetNamespace = $ns;

$server->register('pass', array('x' => 'xsd:string', 'y' => 'xsd:int'), array('z' => 'xsd:string'), $ns);
function pass($contrasena, $codigo)
{
    if ($codigo == 1010) {
        if (empty($contrasena)) return 'NO';
        $comprobador = file_get_contents("../txt/toppasswords.txt");
        $pos = strpos($comprobador, $contrasena);
        if ($pos === false) {
            return 'SI';
        } else {
            return 'NO';
        }
        return 'SI';
    } else {
        return 'COD';
    }
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents("php://input");
$server->service($HTTP_RAW_POST_DATA);
