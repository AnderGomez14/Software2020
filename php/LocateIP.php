<?php
header('Content-Type: application/json');
$local = 1;
if ($local == 1) {
    $clientIP = '85.86.11.13';
    $serverIP = '145.14.145.112';
} else {
    $clientIP = $_SERVER['REMOTE_ADDR'];
    $serverIP = $_SERVER['SERVER_ADDR'];
}

$cliente = json_decode(file_get_contents("http://ipinfo.io/{$clientIP}/json"));
$servidor = json_decode(file_get_contents("http://ipinfo.io/{$serverIP}/json"));


$coordCliente = explode(",", $cliente->loc);
$coordServer = explode(",", $servidor->loc);

$json = new stdClass;
$json->cliente = new stdClass;
$json->cliente->long = $coordCliente[0];
$json->cliente->lat = $coordCliente[1];
$json->cliente->ciudad = $cliente->city;
$json->cliente->region = $cliente->region;
$json->cliente->pais = $cliente->country;

$json->servidor = new stdClass;
$json->servidor->long = $coordServer[0];
$json->servidor->lat = $coordServer[1];
$json->servidor->ciudad = $servidor->city;
$json->servidor->region = $servidor->region;
$json->servidor->pais = $servidor->country;


echo json_encode($json);
