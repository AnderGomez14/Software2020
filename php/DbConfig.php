<?php
$local = 1; //0 para la nube
if ($local == 1) {
    $server = "localhost";
    $user = "root";
    $pass = "";
    $basededatos = "quiz";
    $target_dir = getcwd() . "/../";
    $url = "http://localhost/MikelGarcia-AnderGomez/mikelgarcia-andergomez/";
} else {
    $server = "localhost";
    $user = "id15505880_miusuario";
    $pass = "KTYT%HAB6X3ZFp]w";
    $basededatos = "id15505880_dbquiz";
    $target_dir = getcwd() . "/../";;
    $url = "https://andergo14.000webhostapp.com/swfinal/";
}
