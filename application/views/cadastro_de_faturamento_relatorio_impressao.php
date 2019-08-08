<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <?php if ($dados_geral['dados_faturamento'] != null) { ?>
<div class="col-md-12 nao-imprime">
    <div class="row">
    <div class="col-md-6">
    <br />
    <link href="<?= base_url(); ?>assets/css/grade-impressao.css" rel="stylesheet">
   <a href="JavaScript:window.print();"  name="imprimir" class="btn btn-primary"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
    </div>
    <div class="col-md-6">
    <br />
    <button id="btn" class="btn btn-danger"> <i class="fa fa-warning" aria-hidden="true"></i> Sair</button>
    </div>
    </div>
</div>
   <script type="text/javascript">
    document.getElementById('btn').addEventListener('click', function()
{
    window.close();
}, false);
    </script> 
<div class="col-md-12 nao-imprime">
<div class="nao-imprime" style="margin-top: 10%; height : 65px; border-bottom: 1px solid;">
    <div class="conteudo" style="margin-top: -10%; height : 65px; border-bottom: 1px solid" >
      <!-- <br>
        <div style="position: relative ; top: 6px;"><img style="float : left; width: 10%;" width="10px;" src="<?= base_url(); ?>assets/images/logo.JPG" /></div>
        <br>-->
        <!--span style="font-size:20px;">GPA Web 1.0</span
        <span style="font-size:13px; margin-left:20px;">Rua Apeninos, 485 – Paraíso – São Paulo – SP - Telefone: (11) 4810 2041</span>
-->
    </div>
    <br>
    <br>
    <fieldset style="border-bottom: 1px solid"> <legend> DADOS DO FATURAMENTO: </legend>
    <?php foreach ($dados_geral['dados_faturamento'] as $result) {
                        ?>
     
        <span><b>CLIENTE: </b> <?php echo $result->nome_cliente; ?></span> <br />
        <span><b>CONTRATO: </b> <?php echo $result->cont_numero; ?></span>
        <span style="margin-left: 10%;"><b>DATA DE CORTE: </b> <?php echo $result->cont_dta_vcto; ?></span> 
        <span style="float: right"><b>ANEXOU FATURA: </b>
        <?php if ($result->dta_envio == null) {
                                echo 'Não';
                            } else {
                                echo $result->dta_envio;
                                } ?>
        </span><br />
        <span style="">VALOR: $<b><?php echo $result->vl_fatura; ?></b></span>
        <span style="float: right;"><b>FOI ENVIADO E-MAIL</b> <?php if ($result->email_enviado == 1) { ?>
        <img style="margin-top: -2%;" src="<?= base_url(); ?>assets\images\check.png" height="20" width="" class="img" title="FATURA JÁ ENVIADA">
        <?php } else {     echo 'Não enviado';} ?>
        </span>
        <hr>
    
    <?php }
?>
<br />
</fieldset> 
    <br />
    <br />
    <br />
    <br />
    <br />
  <!--  <span style="margin-left: 25%;"><b> _________________________________________________________________</b></span><br />
    <span style="margin-left: 40%;"><b>Assinatura</b></span>-->

</div>

</div>






<div class="imprime" style="margin-top: 10%; height : 65px; border-bottom: 1px solid;">
    <div class="conteudo" style="margin-top: -10%; height : 65px; border-bottom: 1px solid" >
        <br>
        <div style="position: relative ; top: 6px;"><img style="float : left; width: 10%;" width="10px;" src="<?= base_url(); ?>assets/images/logo.JPG" /></div>
        <br>
        <!--span style="font-size:20px;">GPA Web 1.0</span-->
        <span style="font-size:13px; margin-left:20px;">Rua Apeninos, 485 – Paraíso – São Paulo – SP - Telefone: (11) 4810 2041</span>

    </div>
    <br>
    <br>
    <fieldset style="border-bottom: 1px solid"> <legend> DADOS DO FATURAMENTO: </legend>
    <?php foreach ($dados_geral['dados_faturamento'] as $result) {
                        ?>
     
        <span><b>CLIENTE: </b> <?php echo $result->nome_cliente; ?></span> <br />
        <span><b>CONTRATO: </b> <?php echo $result->cont_numero; ?></span>
        <span style="margin-left: 10%;"><b>DATA DE CORTE: </b> <?php echo $result->cont_dta_vcto; ?></span> 
        <span style="float: right"><b>ANEXOU FATURA: </b>
        <?php if ($result->dta_envio == null) {
                                echo 'Não';
                            } else {
                                echo $result->dta_envio;
                                } ?>
        </span><br />
        <span style="">VALOR: $<b><?php echo $result->vl_fatura; ?></b></span>
        <span style="float: right;"><b>FOI ENVIADO E-MAIL</b> <?php if ($result->email_enviado == 1) { ?>
        <img style="margin-top: -2%;" src="<?= base_url(); ?>assets\images\check.png" height="20" width="" class="img" title="FATURA JÁ ENVIADA">
        <?php } else {     echo 'Não enviado';} ?>
        </span>
        <hr>
    
    <?php }
?>
<br />
</fieldset> 
    <br />
    <br />
    <br />
    <br />
    <br />
    <span style="margin-left: 25%;"><b> _________________________________________________________________</b></span><br />
    <span style="margin-left: 40%;"><b>Assinatura</b></span>

</div>
<?php }?>

