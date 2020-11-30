<?php
//Este PHP tiene la unica funcion de saltarme la politica de CORS de la pagina de donde consigo el json (odio el puto CORS xD)
echo (file_get_contents("https://celestrak.com/NORAD/elements/starlink.txt?cache=" . random_int(0, PHP_INT_MAX)));
