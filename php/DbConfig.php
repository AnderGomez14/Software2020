<?php
$local = 1; //0 para la nube
if ($local == 1) {
    $server = "localhost";
    $user = "root";
    $pass = "";
    $basededatos = "quiz";
    $target_dir = "/xampp/htdocs/MikelGarcia-AnderGomez/uploads/";
} else {
    $server = "localhost";
    $user = "id14877493_mikelander";
    $pass = "r=U/(_J5kUgJP4x)";
    $basededatos = "id14877493_quiz";
    $target_dir = "/storage/ssd2/493/14877493/public_html/MikelGarcia-AnderGomez/uploads/";
}
