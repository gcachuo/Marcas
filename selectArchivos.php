<?php
/**
 * Created by PhpStorm.
 * User: Memo
 * Date: 16/jul/2016
 * Time: 12:29 PM
 */

 if(!empty($_POST['ajax'])){
	echo $_POST["ajax"]();
 }

function imagenes()
{
    $files = scandir('img/');
    $array = array();
    $img = "";
    foreach ($files as $file) {
        if ($file == "." || $file == ".." || $file == ".gitignore")
            continue;
        $id = str_replace(" ", "_", explode(".", $file)[0]);
        $href = $file;
        $img .= "<img onclick='listaMarca(\"" . explode(".", $file)[0] . "\")' src='img/" . $href . "' alt=''>";
    }

    return $img;
}

function pdfs()
{
    $ruta = 'pdf/' . $_POST["id"] . '/';
    $pdfs = "";
    $files = scandir($ruta);
    $array = array();
    $img = "";
    foreach ($files as $file) {
        if ($file == "." || $file == "..")
            continue;
        $id = str_replace(" ", "_", explode(".", $file)[0]);
        $ext = "." . mb_strtolower(explode(".", $file)[1]);
        if ($ext != ".pdf")
            continue;
        rename($ruta . $file, $ruta . $id . $ext);
        $pdfs .= "<div class='col-xs-5' style='border:solid'>
    <a style='font-size: xx-large;' role='button' onclick='sendArchivo(\"$ruta$id$ext\")'>$id</a>
</div>";
    }

    return $pdfs;
}

function videos()
{
    $ruta = 'pdf/' . $_POST["id"] . '/';
    $txt = "";
    $files = scandir($ruta);
    foreach ($files as $file) {
        if ($file == "." || $file == "..")
            continue;
        $id = str_replace(" ", "_", explode(".", $file)[0]);
        $ext = "." . explode(".", $file)[1];
        if ($ext != ".txt")
            continue;
        rename($ruta . $file, $ruta . $id . $ext);
        $url = file_get_contents($ruta . $file);
        $txt .= "<div class=\"col-xs-4\" style='border:solid'><a style=\"font-size: xx-large;\" role=\"button\" onclick=\"sendArchivo('$url')\">video<a></div>";
    }
    return $txt;
}