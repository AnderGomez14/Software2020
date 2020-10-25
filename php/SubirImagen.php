<?php
function subir($FILES, $target_dir, $id)
{
    $tipo = strtolower(pathinfo(basename($FILES["archivosubido"]["name"]), PATHINFO_EXTENSION));
    $target_file = $target_dir . $id . "." . $tipo;

    $check = getimagesize($FILES["archivosubido"]["tmp_name"]);
    if (!($check !== false)) {
        echo "El archivo no es una imagen.";
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
        return false;
    }

    if (
        $tipo != "jpg" && $tipo != "png" && $tipo != "jpeg"
        && $tipo != "gif"
    ) {
        echo "Lo siento, pero el archivo no tiene un formato admitido. F";
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
        return false;
    }

    if (move_uploaded_file($FILES["archivosubido"]["tmp_name"], $target_file)) {
        return true;
    } else {
        echo 'Algo raro ha ido mal.';
        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
        return false;
    }
}
