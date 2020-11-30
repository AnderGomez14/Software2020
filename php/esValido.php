<?php
include 'DbConfig.php';
$mysqli = mysqli_connect($server, $user, $pass, $basededatos);
if (!$mysqli) {
    echo ('MAL');
    die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
}

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['email']) && $_SESSION['email'] == "admin@ehu.es") {
    $email = mysqli_real_escape_string($mysqli, $_GET['email']);
    $user = mysqli_query($mysqli, "select estado from users where email = '" . $email . "'");
    while ($row = mysqli_fetch_array($user)) {
        echo $row['estado'];
    }
}
