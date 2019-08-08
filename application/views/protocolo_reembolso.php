<div class="contentpanel"><!--Início da classe geral-->
    <!--**********************-->
    <?php
//seta a data para o estado sp
    date_default_timezone_set('America/Sao_Paulo');

//#########################################################################
    ?>
    <script type="text/javascript">
        // INICIO FUNÇÃO DE MASCARA MAIUSCULA
        function maiuscula(z) {
            v = z.value.toUpperCase();
            z.value = v;
        }
        //FIM DA FUNÇÃO MASCARA MAIUSCULA
    </script>

    <div class="collapse navbar-collapse navbar-ex1-collapse">

    </div>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper nao-imprime">

    <div class="container-fluid">
        <!--CSS-->    
        <div class="span10">
            <!---Body content----------------------------------------------------->

            <div> 
                <!---Body content----------------------------------------------------->
                <div class="container nao-imprime" style="width:98%;height:1200px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                    <div class="col-md-12" style="margin-bottom: 5%;">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" name="" action="<?= base_url() ?>Intranet/protocolo_reembolso_gravado">
                                    <input value="<?php echo $dados_geral['dados_protocolo'][0]->id_atend; ?>"  type="hidden" class="form-control" name="id_atend">
                                    <input value="<?php echo $dados_geral['dados_protocolo'][0]->id_beneficiario; ?>"  type="hidden" class="form-control" name="id_beneficiario">
                                    <input type="hidden" value="<?php if(isset($_GET['data'])){echo $_GET['data'];}?>" name="dta_atendimento">
                                    <h3>PROTOCOLO DE DOCUMENTO</h3> 
                                    
<!--                                    <?php if($dados_geral['dados_foreach'] != null && $dados_geral['dados_foreach'] != 0){?>
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> Dados localizado.
                                  </div>
                                    <?php }else if(isset($_GET['dta_at']) && $dados_geral['dados_foreach'] == 0){?>
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Atenção!</strong> Dados não localizado.
                                  </div>
                                    <?php }?>                                 -->
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Operadora</label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->nome_op; ?>"  type="text" class="form-control" name="operadora">
                                        </div>
                                        <div class="col-md-4">
                                            <label>A/C</label>
                                            <input onkeyup="maiuscula(this)" value="DEPARTAMENTO DE REEMBOLSO " type="text" class="form-control" name="ac">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Endereço 01 <input type="radio" checked="" name="gender" value="1"></label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->endereco; ?>, <?php echo $dados_geral['dados_protocolo'][0]->numero; ?>, <?php echo $dados_geral['dados_protocolo'][0]->cep; ?>"  type="text" class="form-control" name="endereco">
                                        </div>
                                         <div class="col-md-8">
                                            <label>Endereço 02 <input type="radio" name="gender" value="2"></label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->endereco2; ?>, <?php echo $dados_geral['dados_protocolo'][0]->numero2; ?>, <?php echo $dados_geral['dados_protocolo'][0]->cep2; ?>"  type="text" class="form-control" name="endereco2">
                                        </div>
                                         <div class="col-md-8">
                                            <label>Endereço 03 <input type="radio" name="gender" value="3"></label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->endereco3; ?>, <?php echo $dados_geral['dados_protocolo'][0]->numero3; ?>, <?php echo $dados_geral['dados_protocolo'][0]->cep3; ?>"  type="text" class="form-control" name="endereco3">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Reembolso - Cliente</label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->nome_cliente; ?>"  type="text" class="form-control" name="cliente">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Paciente</label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->nome_atendimento; ?>"  type="text" class="form-control" name="paciente">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Titular</label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->nome_ben; ?>"  type="text" class="form-control" name="titular">
                                        </div>
                                        <div class="col-md-8">
                                            <label>CPF - Titular</label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->cpf; ?>"  type="text" class="form-control" name="cpf">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Contrato/Apólice</label>
                                            <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_protocolo'][0]->cont_numero; ?>"  type="text" class="form-control" name="contrato">
                                        </div>
                                    </div>
                                    <?php if($dados_geral['dados_foreach'] != null){?>
                                        <div class="box-body table-responsive">

                                            <table id="" class="table table-bordered table-striped table-hover dataTable no-footer" arial-describedby="tablist_info" role="grid" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr role="row" class="odd">
                                                        <th style="font-size: 12px;">Tipo</th>
                                                        <th style="font-size: 12px;">Data do evento</th>
                                                        <th style="font-size: 12px;">Procedimento</th>
                                                        <th style="font-size: 12px;">Prestador</th>
                                                        <th style="font-size: 12px;">Registro Prestador</th>
                                                        <th style="font-size: 12px;">Data Recibo</th>
                                                        <th style="font-size: 12px;">Valor Recibo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $geral = 0;
                                                    $total = 0;
                                                    foreach ($dados_geral['dados_foreach'] as $result) {
                                                        ?>
                                                        <tr style="align-content: center;">
                                                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo $result->doc; ?></b></td>
                                                             <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?></b></td>
                                                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->tipo; ?></td>
                                                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->nome_prestador; ?></td>
                                                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo '--'; ?></td>
                                                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo date('d/m/Y', strtotime($result->dta_recibo)); ?></td>
                                                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo number_format($result->valor_recibo, 2, ',', '.'); ?></td>
                                                        </tr>
                                                        <?php
                                                        $total = ($result->valor_recibo);
                                                        $geral += $total;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>   
                                            <div class="col-md-12">
                                                <hr>
                                                Total: <span style="float: right; color: #ff0000">R$:  <?php echo number_format($geral, 2, ",", "."); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <br />
                                            <button  style="float: right;"type="submit" class="btn btn-success" name=""><i class="fa fa-check-circle" aria-hidden="true"></i> OK</button>
                                        </div>
                                    <?php }?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------------------------------------------------------->
        </div>
    </div><!--fluid-->
</div><!--container-->

<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
</div><!-- contentpanel fim geral-->

</div><!-- mainpanel -->
</section>
<script type="text/javascript">
function vCampos(el, er)
{
    var e = $(el).val().replace(er, '');
    $(el).val(e);
}
</script>
<script type="text/javascript">
    function num(el)
    {
        VCampos(el, /^0-9/g);
    }
</script>
<script type="text/javascript">//00000-000
    function maskNascimento(el)
    {
        vCampos(el, /[^0-9\)/\(\/-]/g);
        var e = $(el).val();
        if (e.length == 2)
            $(el).val(e + '/');
        if (e.length == 5)
            $(el).val(e + '/');
    }
</script> 
<script type="text/javascript">
//    function pes_atendimento(){
//    var base_url = '<?php //echo base_url();?>';
//    var id_ben = '<?php //echo $dados_geral['dados_protocolo'][0]->id_beneficiario; ?>';
//    var id_prot = '<?php //echo $dados_geral['dados_protocolo'][0]->id_atend; ?>';
//    var dta_at = $('#dta_atendimento').val();
//    if(dta_at != ''){
//    var dados = {
//    data:dta_at, id_ben:id_ben, id_prot:id_prot
//    }
//     location.href = base_url + 'Intranet/protocolo_reembolso_filtro?dta_at=' + dta_at + '&id_ben=' + id_ben + '&id_prot=' + id_prot;  
////    $.post(base_url + 'Intranet/protocolo_reembolso_filtro', dados, function (result) {
////    })
//    }else{
//    alert('Informe a data !');
//     document.getElementById("dta_atendimento").focus();
//    }
//    
//    }
</script>