<?php
$idMarca=$_POST["idMarca"];
//echo $idMarca;
if (!file_exists('pdf/'.$idMarca)) {
    mkdir('pdf/'.$idMarca, 0777, true);
}

?>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script>
            $(function(){
                $.ajax({
                    url: "pdf/"+<?php echo "'".$idMarca."'"?>,
                    success: function(data){
                        $(data).find("a:contains(.pdf)").each(function(){
                           var images=$(this).attr("href");
                           var id=images.substr(0,images.length-4);
                           var ruta ="pdf/'+<?php echo $idMarca?>+'/'+images+'";
                            $("<div class='col-xs-4' style='margin-bottom:20px'></div>").html('<a class="btn btn-default btn-lg btn-block" role="button" href="pdf/'+<?php echo $idMarca?>+'/'+images+'">'+id+'<a>').appendTo("#tablePdf");
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