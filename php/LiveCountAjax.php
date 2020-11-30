<?php
include 'DbConfig.php';
if (!isset($_POST['email'])) die('ERROR: Bad request F');
$xml = simplexml_load_file("../xml/Questions.xml");
if (!$xml) die('Error al cargar el XML');

$mysqli = mysqli_connect($server, $user, $pass, $basededatos);
if (!$mysqli) {
    echo ('MAL');
    die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
}
if (isset($_POST['email'])) {
    $mysqli->set_charset('utf8');

    $totalQuestionsNumber = $xml->count();
    $count = 0;
    foreach ($xml->children() as $pregunta) {
        if ($pregunta->attributes()->author == $_POST['email']) $count += 1;
    }
    $userQuestionsNumber = $count;


    $fecha = time();
    $query = $mysqli->query("UPDATE users SET last_visit = " . $fecha . " WHERE email = '" . $_POST['email'] . "'");
    $threshold = $fecha - 12; //Pongo 2s mas por seguridad
    $query = $mysqli->query('SELECT * FROM users WHERE last_visit>' . $threshold);
    $totalUsers = $query->num_rows;

    $json = new stdClass;
    $json->nUsersQuestions = $userQuestionsNumber;
    $json->nQuestions = $totalQuestionsNumber;
    $json->nUsers = $totalUsers;

    header('Content-Type: application/json');
    echo json_encode($json);
}
