<?php
$idMarca=($_POST["idMarca"]);
//echo $idMarca;
if (!file_exists('pdf/'.$idMarca)) {
    mkdir('pdf/'.$idMarca, 0777, true);
}

?>
<div class="row">
<div class="col-xs-1">
<a class="btn btn-default" style="cursor:pointer;" href="index.html">Regresar</a>
</div>
</div>
<form method="post" action="archivo.php" id="frmSistema">
            <input type="hidden" name="archivo" id="archivo">
            <input type="hidden" name="idMarca" value="<?php echo $idMarca?>">
        </form>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script>
            
            $(function(){
                $.ajax({
                    url: "pdf/<?php echo "".$idMarca?>",
                    success: function(data){
                        $(data).find("a:contains(.pdf)").each(function(){
                           var images=$(this).attr("href");
                           var id=images.substr(0,images.length-4);
                           var ruta ="pdf/<?php echo $idMarca?>/"+images;
                            $("<div id='maquina' class='row' style='margin-bottom:20px'></div>").html('<div class="col-xs-4"><a style="font-size: xx-large;" role="button" onclick="sendArchivo(\'pdf/<?php echo "".$idMarca?>/'+images+'\')">'+id+'<a></div>').appendTo("#tablePdf");
                    $(data).find("a:contains("+id+".txt)").each(function(){
                           var images=$(this).attr("href");
                           var id=images.substr(0,images.length-4);
                           var ruta ="pdf/<?php echo $idMarca?>/"+images;
                           var url=(readTextFile(ruta));
                            $("<div class='' style='margin-bottom:20px'></div>").html('<div class="col-xs-4"><a style="font-size: xx-large;" role="button" onclick="sendArchivo(\''+url+'\')">'+id+'<a></div>').appendTo("#maquina");
                        });    
                    });                        
                        if($("#tablePdf").html()==""){
                            $("#tablePdf").html("No hay archivos");
                            $("#frmUpload").html(
                            '<br>Select image to upload:'+
                            '<input name="filesToUpload[]" id="filesToUpload" type="file" multiple="" />'+
                            '<input type="submit" value="Upload Image" name="submit">');
                        }
                    }
                })
            });
             function sendArchivo(id){
                $("#archivo").val(id);
                $("#frmSistema").submit();
            }
            function readTextFile(file)
{
    var allText;
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                allText = rawFile.responseText;
            }
        }
    }
    rawFile.send(null);
    return allText;
}
            function listaMarca(id){
                $("#idMarca").val(id);
                $("#frmSistema").submit();
            }
        </script>
        <div class="form-horizontal" id="tablePdf"></div>
        <form method="post" action="subir.php" id="frmUpload"></form>
        <style>
            a{
                width:100%
            }
        </style>