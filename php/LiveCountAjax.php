<?php
include 'DbConfig.php';
$mysqli = mysqli_connect($server, $user, $pass, $basededatos);
if (!$mysqli) {
    echo ('MAL');
    die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
}

$mysqli->set_charset('utf8');

if (!isset($_POST['email'])) die('ERROR: Bad request F');
$query = $mysqli->query("SELECT id FROM preguntas_imagen WHERE mail= '" . $_POST['email'] . "'");
$totalQuestionsNumber = $query->num_rows;
$userQuestionsNumber = $query->num_rows;
$query->close();
$query = $mysqli->query("SELECT id FROM preguntas_imagen");
$totalQuestionsNumber = $query->num_rows;
mysqli_error($mysqli);
$nquestions =  'User: ' . $userQuestionsNumber . '; Total: ' .  $totalQuestionsNumber;

$fecha = time();
$query = $mysqli->query("UPDATE users SET last_visit = " . $fecha . " WHERE email = '" . $_POST['email'] . "'");
$threshold = $fecha - 5;
$query = $mysqli->query('SELECT * FROM users WHERE last_visit>' . $threshold);
$totalUsers = $query->num_rows;

$json = new stdClass;
$json->questions = $nquestions;
$json->users = $totalUsers;

header('Content-Type: application/json');
echo json_encode($json);
