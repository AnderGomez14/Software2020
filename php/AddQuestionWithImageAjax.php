<?php


include 'DbConfig.php';
include 'SubirImagen.php';
//error_reporting(E_ALL ^ E_NOTICE);
$mysqli = mysqli_connect($server, $user, $pass, $basededatos);
if (!$mysqli) {
  echo ('MAL');
  die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
}
if (empty($_POST['mail']) || empty($_POST['enum']) || empty($_POST['correcta']) || empty($_POST['inco1']) || empty($_POST['inco2']) || empty($_POST['inco3']) || empty($_POST['complejidad']) || empty($_POST['tema'])) {
  echo ('Error: Faltan parametros');
} else if (!(preg_match("/([a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es)))|([a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es)))|([a-zA-Z]+(@ehu.)((eus)|(es)))/", $_POST['mail']) && strlen($_POST['enum']) >= 10 && $_POST['complejidad'] >= 1 && $_POST['complejidad'] <= 3)) {
  echo ('Error: Datos incorrectos. <br>gg nice try. Esfuerzate mas para hackearme');
  echo '<br> <img src="https://pbs.twimg.com/media/EiEMspkX0AMfWG8.jpg" style="max-width:300px;width:100%"></img> <br>';
} else {
  $tipo = strtolower(pathinfo(basename($_FILES["archivosubido"]["name"]), PATHINFO_EXTENSION));

  $query = $mysqli->prepare("INSERT INTO preguntas_imagen(mail,enum,correcta,inco1,inco2,inco3,complejidad,tema,foto) VALUES (?,?,?,?,?,?,?,?,?)");
  $query->bind_param("ssssssiss", $_POST['mail'], $_POST['enum'], $_POST['correcta'], $_POST['inco1'], $_POST['inco2'], $_POST['inco3'], $_POST['complejidad'], $_POST['tema'], $tipo);
  //Esto lo he hecho asi para evitar ataques de SQL Injection
  if (!$query->execute())
    die('Error: No se ha podido añadir a la base de datos' . mysqli_error($mysqli));
  $id = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id FROM preguntas_imagen ORDER BY id DESC LIMIT 1"))['id'];
  if (!subir($_FILES, $target_dir, $id)) {
    mysqli_query($mysqli, "DELETE FROM preguntas_imagen WHERE id = '$id'");
    die();
  }
  echo 'Pregunta Introducida en la BD Correctamente <br>';
  $xml = simplexml_load_file("../xml/Questions.xml");
  $assessmentItem = $xml->addChild('assessmentItem');

  $assessmentItem->addAttribute('subject', $_POST['tema']);
  $assessmentItem->addAttribute('author', $_POST['mail']);
  //$assessmentItem->addAttribute('photo', "../uploads/" . $id . "." . $tipo); Esto esta por si hay que añadir tambien la ruta a la imagen


  $itemBody = $assessmentItem->addChild('itemBody');
  $itemBody->addChild('p', $_POST['enum']);

  $correctResponse = $assessmentItem->addChild('correctResponse');
  $correctResponse->addChild('response', $_POST['correcta']);

  $incorrectResponses = $assessmentItem->addChild('incorrectResponses');
  $incorrectResponses->addChild('response', $_POST['inco1']);
  $incorrectResponses->addChild('response', $_POST['inco2']);
  $incorrectResponses->addChild('response', $_POST['inco3']);

  $xmlDocument = new DOMDocument('1.0');
  $xmlDocument->preserveWhiteSpace = false;
  $xmlDocument->formatOutput = true;
  $xmlDocument->loadXML($xml->asXML());
  echo 'Pregunta Introducida en el XML Correctamente <br>';

  if (!$xmlDocument->save('../xml/Questions.xml'))
    die('Esto es embarazoso, pero no se ha podido guardar el XML');
  // if (isset($_GET['email']))
  //   echo '<p><a href="ShowQuestionsWithImage.php?email=' . $_GET['email'] . '"> Ver Preguntas</a>';
  // else
  //   echo "<p><a href='ShowQuestionsWithImage.php'> Ver Preguntas</a>";
}
mysqli_close($mysqli);
