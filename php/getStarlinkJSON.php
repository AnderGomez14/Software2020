<?php
//Esta funcion esta exclusivamente para saltarme la limitacion que me impone el CORS (lo odio xD)
echo file_get_contents("https://satellitemap.space/starposA.json?cache=" . random_int(0, PHP_INT_MAX));
