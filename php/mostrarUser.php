<?php
include 'DbConfig.php';
$mysqli = mysqli_connect($server, $user, $pass, $basededatos);
if (!$mysqli) {
    echo ('MAL');
    die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
}

$email = mysqli_real_escape_string($mysqli, $_GET['email']);
$user = mysqli_query($mysqli, "select * from users where email = '" . $email . "'");
while ($row = mysqli_fetch_array($user)) {
    $json = new stdClass;
    $json->nEmail = $row['email'];
    $json->nPassword = $row['password'];
    $json->nUsers = $row['foto'];
    header('Content-Type: application/json');
    echo json_encode($json);
}
