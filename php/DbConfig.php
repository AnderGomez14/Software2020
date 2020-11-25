<?php
$local = 1; //0 para la nube
if ($local == 1) {
    $server = "localhost";
    $user = "root";
    $pass = "";
    $basededatos = "quiz";
    $target_dir = "/xampp/htdocs/MikelGarcia-AnderGomez/";
    $url = "http://localhost/";
} else {
    $server = "localhost";
    $user = "id15505880_miusuario";
    $pass = "KTYT%HAB6X3ZFp]w";
    $basededatos = "id15505880_dbquiz";
    $target_dir = "/storage/ssd5/880/15505880/public_html/MikelGarcia-AnderGomez/";
    $url = "https://andergo14.000webhostapp.com/";
}
