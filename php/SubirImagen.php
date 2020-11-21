<?php
function subir($FILES, $target_dir, $id)
{
    $tipo = strtolower(pathinfo(basename($FILES["archivosubido"]["name"]), PATHINFO_EXTENSION));
    $target_file = $target_dir . 'uploads/' . $id . "." . $tipo;

    $check = getimagesize($FILES["archivosubido"]["tmp_name"]);
    if (!($check !== false)) {
        echo "El archivo no es una imagen.";
        return false;
    }

    if (
        $tipo != "jpg" && $tipo != "png" && $tipo != "jpeg"
        && $tipo != "gif"
    ) {
        echo "Lo siento, pero el archivo no tiene un formato admitido. F";
        return false;
    }

    if (move_uploaded_file($FILES["archivosubido"]["tmp_name"], $target_file)) {
        return true;
    } else {
        echo 'Algo raro ha ido mal.';
        return false;
    }
}
