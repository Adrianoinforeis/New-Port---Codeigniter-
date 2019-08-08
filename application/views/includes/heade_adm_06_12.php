<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv=”content-type” content=”text/html; charset=UTF-8″ />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.jpg" class="img-circle img-responsive" style="border-radius: 10px;" type="image/png">

        <title></title>

        <link href="<?= base_url(); ?>/assets/css/gold.css" rel="stylesheet">
    </head>
    <body>




        <script src="<?= base_url(); ?>/assets/js/jquery-1.10.2.min.js"></script>
       
        <script src="<?= base_url(); ?>/assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery-ui-1.10.3.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/modernizr.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery.sparkline.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/toggles.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/retina.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery.cookies.js"></script>
        <script src="<?= base_url(); ?>/assets/js/chosen.jquery.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/livequery.js"></script>
        <!--<script src="<?= base_url(); ?>/assets/js/jquery.maskMoney.min.js"></script>-->

        <script src="<?= base_url(); ?>/assets/js/jquery.maskedinput.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery.form.js"></script>
        <script src="<?= base_url(); ?>/assets/js/bootstrap-fileupload.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery.maskMoney.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery.imgareaselect.min.js"></script>
        <!-- Carrega scripts JS automaticamente -->

        <!--table-->
        <link rel="stylesheet" href="table/css/bootstrap.css">
        <link href="<?= base_url(); ?>assets/css/grade-impressao.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/table/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/table/font-awesome/css/font-awesome.css">
        <!--Javascript-->    
        <?php
        $dominio = $_SERVER['HTTP_HOST'];
        $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
        if($_SERVER['REQUEST_URI'] != '/newport/Intranet/filtro_relatorio_detalhado'){
        ?>
       <script src="assets/table/js/jquery-1.10.2.js"></script>
        <script src="<?= base_url(); ?>assets/table/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/table/js/dataTables.bootstrap.min.js"></script>          
        <script src="<?= base_url(); ?>assets/table/js/bootstrap.js"></script>
        <script src="<?= base_url(); ?>assets/table/js/lenguajeusuario.js"></script>  
   <?php }?>   
       
<!--       <script src="<?= base_url(); ?>assets/table2/js/buttons.flash.min.js"></script>
        <script src="<?= base_url(); ?>assets/table2/js/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>assets/table2/js/buttons.print.min.js"></script>          
        <script src="<?= base_url(); ?>assets/table2/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>assets/table2/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/table2/js/jquery-3.3.1.js"></script>
<script src="<?= base_url(); ?>assets/table2/js/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/table2/js/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/table2/js/vfs_fonts.js"></script>-->





        <script src="<?= base_url(); ?>/assets/js/custom.js"></script>

        <!--Aqui -->
        <script src="<?= base_url(); ?>assets/js/validar_campos/validator.min.js"></script> 
        <script src="<?= base_url(); ?>assets/js/validar_campos/validator.js"></script>
      <body onload="pisca(), mueveReloj();">
</html>    


