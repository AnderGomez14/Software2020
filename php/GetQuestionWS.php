<?php
error_reporting(0);
require_once('DbConfig.php');
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$ns = $url . "MikelGarcia-AnderGomez/php/GetQuestionWS.php";
$server = new soap_server();
$server->configureWSDL('ObtenerPregunta', $ns);
$server->wsdl->schemaTargetNamespace = $ns;
$server->wsdl->addComplexType(
    'question',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id' => array('name' => 'id', 'type' => 'xsd:int'),
        'autor' => array('name' => 'autor', 'type' => 'xsd:string'),
        'enunciado' => array('name' => 'enunciado', 'type' => 'xsd:string'),
        'respuesta_correcta' => array('name' => 'respuesta_correcta', 'type' => 'xsd:string'),
    )
);

$server->register('ObtenerPregunta', array('x' => 'xsd:int'), array('z' => 'tns:question'), $ns);
function ObtenerPregunta($id)
{
    include 'DbConfig.php';
    $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
    if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
    }
    $query = $mysqli->prepare("SELECT * FROM `preguntas_imagen` WHERE id = ?");
    $query->bind_param("i", $id);
    if ($query->execute()) {
        $result = $query->get_result();
        if ($result->num_rows === 0)
            return array('id' => "", 'autor' => "", 'enunciado' => "", 'respuesta_correcta' => "");
        else {
            $question = $result->fetch_array();
            return array('id' => $question[0], 'autor' => $question[1], 'enunciado' => $question[2], 'respuesta_correcta' => $question[3]);
        }
    }
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents("php://input");
$server->service($HTTP_RAW_POST_DATA);
