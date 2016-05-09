        <?php
        $archivo=$_POST["archivo"];
        $idMarca=$_POST["idMarca"];
        ?>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
<script>
$(function(){
});
   function regresar(id){
                $("#idMarca").val(id);
                $("#frmSistema").submit();
            }
</script>
<form method="post" action="marcas.php" id="frmSistema">
            <input type="hidden" name="idMarca" value="<?php echo $idMarca?>">
        </form>
<a class="btn btn-default" style="cursor:pointer;" onclick="regresar('<?php echo $idMarca?>')">Regresar</a>
<embed src="<?php echo $archivo;?>" frameborder="0" style="width: 100%; height: 100vh;">