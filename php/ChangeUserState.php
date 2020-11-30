<?php
include 'DbConfig.php';
$mysqli = mysqli_connect($server, $user, $pass, $basededatos);
if (!$mysqli) {
    echo ('MAL');
    die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
}
session_start();


if (isset($_SESSION['email']) && $_SESSION['email'] == "admin@ehu.es") {
    $email = mysqli_real_escape_string($mysqli, $_GET['email']);
    if ($email != "admin@ehu.es") {
        $user = mysqli_query($mysqli, "SELECT estado from users where email = '" . $email . "'");
        $row = mysqli_fetch_array($user);
        if ($row['estado'] == "A")
            $estado = "B";
        else
            $estado = "A";
        $update = mysqli_query($mysqli, "UPDATE users SET estado = '" . $estado . "' WHERE email = '" . $email . "'");
    }
}
