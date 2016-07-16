<?php
/**
 * Created by PhpStorm.
 * User: Memo
 * Date: 16/jul/2016
 * Time: 12:29 PM
 */

echo $_POST["ajax"]();
function imagenes()
{
    $files = scandir('img/');
    $array = array();
    $img = "";
    foreach ($files as $file) {
        if ($file == "." || $file == "..")
            continue;
        $id = str_replace(" ", "_", explode(".", $file)[0]);
        $href = $file;
        $img .= "<img onclick='listaMarca(\"" . explode(".", $file)[0] . "\")' src='img/" . $href . "' alt=''>";
    }

    return $img;
}

function pdfs()
{
    $ruta='pdf/'.$_POST["id"].'/';
    $pdfs = "";
    $files = scandir($ruta);
    $array = array();
    $img = "";
    foreach ($files as $file) {
        if ($file == "." || $file == "..")
            continue;
        $id = str_replace(" ", "_", explode(".", $file)[0]);
        $ext=".".explode(".", $file)[1];
        rename($ruta.$file,$ruta.$id.$ext);
        $pdfs .= "<div class='col-xs-4'>
    <a style='font-size: xx-large;' role='button' onclick='sendArchivo(\"$ruta$id$ext\")'>$id</a>
</div>";
    }

    return $pdfs;
}