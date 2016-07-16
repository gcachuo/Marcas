<?php
$idMarca = ($_POST["idMarca"]);
$replace = str_replace(" ", "_", $idMarca);
//echo $idMarca;
if (!file_exists('pdf/' . $replace)) {
    mkdir('pdf/' . $replace, 0777, true);
}

?>
<div class="row">
    <div class="col-xs-1">
        <a class="btn btn-default" style="cursor:pointer;" href="index.html">Regresar</a>
    </div>
</div>
<form method="post" action="archivo.php" id="frmSistema">
    <input type="hidden" name="archivo" id="archivo">
    <input type="hidden" name="idMarca" value="<?php echo $idMarca ?>">
</form>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery-2.1.4.js"></script>
<script src="js/bootstrap.js"></script>
<script>

    $(function () {
        $.post("selectArchivos.php", {ajax: "pdfs", id: "<?php echo $idMarca?>"}, function (out) {
            $("<div id='maquina<?php echo $replace?>' class='row' style='margin-bottom:20px'></div>").html(out).appendTo("#tablePdf");
        });
        $.post("selectArchivos.php", {ajax: "videos", id: "<?php echo $idMarca?>"}, function (out) {
            
            $("<div class='' style='margin-bottom:20px'></div>").html(out).appendTo("#maquina<?php echo $replace?>");

        });
        /*

         var ruta = "pdf/<?php echo $replace?>/" + images;


         $(data).find("a:contains(" + id + ".txt)").each(function () {
         var images = $(this).attr("href");
         var id = images.substr(0, images.length - 4);
         var ruta = "pdf/<?php echo $replace?>/" + images;
         var url = (readTextFile(ruta));
         $("<div class='' style='margin-bottom:20px'></div>").html('<div class="col-xs-4"><a style="font-size: xx-large;" role="button" onclick="sendArchivo(\'' + url + '\')">' + id + '<a></div>').appendTo("#maquina" + id);
         });
         if ($("#tablePdf").html() == "") {
         $("#tablePdf").html("No hay archivos");
         $("#frmUpload").html(
         '<br>Select image to upload:' +
         '<input name="filesToUpload[]" id="filesToUpload" type="file" multiple="" />' +
         '<input type="submit" value="Upload Image" name="submit">');
         }
         }
         })*/
    })
    ;
    function sendArchivo(id) {
        $("#archivo").val(id);
        $("#frmSistema").submit();
    }
    function readTextFile(file) {
        var allText;
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function () {
            if (rawFile.readyState === 4) {
                if (rawFile.status === 200 || rawFile.status == 0) {
                    allText = rawFile.responseText;
                }
            }
        }
        rawFile.send(null);
        return allText;
    }
    function listaMarca(id) {
        $("#idMarca").val(id);
        $("#frmSistema").submit();
    }
</script>
<div class="form-horizontal">
    <div class="row" style="margin-bottom:20px">
        <div class="col-xs-4">
            <label>PDF</label>
        </div>
        <div class="col-xs-4">
            <label>VIDEO</label>
        </div>
    </div>
</div>
<div class="form-horizontal" id="tablePdf"></div>
<form method="post" action="subir.php" id="frmUpload"></form>
<style>
    a {
        width: 100%
    }
</style>