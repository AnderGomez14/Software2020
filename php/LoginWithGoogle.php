<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once getcwd() . "/../vendor/autoload.php";

// init configuration
$clientID = '183147629418-40gufv0teip26kaqqq8m5qh2or923duu.apps.googleusercontent.com';
$clientSecret = 'MrThvxyQldaYY4FnfwLgrQCF';
$redirectUri = 'localhost/MikelGarcia-AnderGomez/php/LoginWithGoogle.php';

// create Client Request to access Google API


$client = new Google_Client(['client_id' => $clientID]);
$payload = $client->verifyIdToken($_POST['idtoken']);
if ($payload) {
    $json = file_get_contents("https://oauth2.googleapis.com/tokeninfo?id_token=" . $_POST['idtoken']);
    $data = json_decode($json);
    $_SESSION['email'] = $data->email;
    $_SESSION['tipo'] = 'A';
    $_SESSION['foto'] = $data->picture;
    $_SESSION['social'] = true;
    echo 'TODO BIEN';
} else {
    // Invalid ID token
}
