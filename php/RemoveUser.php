<?php
include 'DbConfig.php';
$mysqli = mysqli_connect($server, $user, $pass, $basededatos);
if (!$mysqli) {
    echo ('MAL');
    die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
}

$email = mysqli_real_escape_string($mysqli, $_GET['email']);
if ($email != "admin@ehu.es")
    $user = mysqli_query($mysqli, "DELETE FROM users WHERE email = '" . $email . "'");
