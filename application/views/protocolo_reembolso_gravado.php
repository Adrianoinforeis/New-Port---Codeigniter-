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
                <div class="container nao-imprime" style="width:98%;height:890px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                    <div class="col-md-12" style="margin-bottom: 5%;">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" name="" action="<?= base_url() ?>Intranet/protocolo_reembolso_gravado">
                                    <input onkeyup="maiuscula(this)" value="<?php echo $dados_geral['dados_recente'][0]->id_prot; ?>"  type="hidden" class="form-control" name="id_recente">
                                    <input onkeyup="maiuscula(this)"  value="<?php echo $dados_geral['dados_recente'][0]->id_atend; ?>"  type="hidden" class="form-control" name="atendimento">
                                    <h3>PROTOCOLO DE DOCUMENTO</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Operadora</label>
                                            <input onkeyup="maiuscula(this)"  disabled="" value="<?php echo $dados_geral['dados_recente'][0]->operadora; ?>"  type="text" class="form-control" name="operadora">
                                        </div>
                                        <div class="col-md-4">
                                            <label>A/C</label>
                                            <input onkeyup="maiuscula(this)" disabled="" value="<?php echo $dados_geral['dados_recente'][0]->ac; ?>" type="text" class="form-control" name="ac">
                                        </div>
                                        <div class="col-md-2">
                                            <br />
                                            <link href="<?= base_url(); ?>assets/css/grade-impressao.css" rel="stylesheet">
                                            <a href="JavaScript:window.print();"  name="imprimir" class="btn btn-primary" title="Imprimir"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
                                        </div>
                                         <div class="col-md-2">
                                            <br />
                                            <a href="<?= base_url(); ?>Intranet/home"  name="" class="btn btn-success" title="Retornar para Home"> <i class="fa fa-mail-reply-all"></i> Voltar</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Endereço</label>
                                            <input onkeyup="maiuscula(this)" disabled="" value="<?php echo $dados_geral['dados_recente'][0]->endereco; ?>"  type="text" class="form-control" name="endereco">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Reembolso - Cliente</label>
                                            <input onkeyup="maiuscula(this)" disabled="" value="<?php echo $dados_geral['dados_recente'][0]->cliente; ?>"  type="text" class="form-control" name="cliente">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Paciente</label>
                                            <input onkeyup="maiuscula(this)" disabled="" value="<?php echo $dados_geral['dados_recente'][0]->paciente; ?>"  type="text" class="form-control" name="paciente">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Titular</label>
                                            <input onkeyup="maiuscula(this)" disabled="" value="<?php echo $dados_geral['dados_recente'][0]->titular; ?>"  type="text" class="form-control" name="titular">
                                        </div>
                                        <div class="col-md-8">
                                            <label>CPF - Titular</label>
                                            <input onkeyup="maiuscula(this)" disabled="" value="<?php echo $dados_geral['dados_recente'][0]->cpf; ?>"  type="text" class="form-control" name="cpf">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Contrato/Apólice</label>
                                            <input onkeyup="maiuscula(this)" disabled="" value="<?php echo $dados_geral['dados_recente'][0]->contrato; ?>"  type="text" class="form-control" name="contrato">
                                        </div>
                                    </div>
                                    <div class="box-body table-responsive">

                                        <table id="" class="table table-bordered table-striped table-hover dataTable no-footer" arial-describedby="tablist_info" role="grid" cellspacing="0" width="100%">
                                            <thead>
                                                <tr role="row" class="odd">
                                                    <th style="font-size: 12px;">Tipo</th>
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
                                                foreach ($dados_geral['dados_protocolo'] as $result) {
                                                    ?>
                                                    <tr style="align-content: center;">
                                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo $result->doc; ?></b></td>
                                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->tipo; ?></td>
                                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->nome_prestador; ?></td>
                                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo '--'; ?></td>
                                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo date('d/m/Y', strtotime($result->dta_recibo)); ?></td>
                                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo number_format($result->valor_recibo, 2, ',', '.'); ?></td>
                                                    </tr>
                                                <?php 
                                                $total = ($result->valor_recibo);

                                                //$total = ($notas->pro_valor * $notas->pro_quant2);
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
                                    <!-- <div class="col-md-12">
                                        <br />
                                        <button  style="float: right;"type="submit" class="btn btn-warning" name=""><i class="fa fa-check-circle" aria-hidden="true"></i> ALTERAR</button>
                                    </div>-->
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


<!--**********************-->
</div><!-- contentpanel fim geral-->

</div><!-- mainpanel -->



<!--
<div class="imprime" style="margin-top: -130%; height : 65px; border-bottom: 1px solid;">
    
</div>-->

<div class="imprime" style="margin-left: 5%; margin-top: -140%; height : 65px; border-bottom: 1px solid;">
    <div class="conteudo" style="margin-top: -10%; height : 65px; border-bottom: 1px solid" >
        <br>
        <div style="position: relative ; top: 6px;"><img style="float : left; width: 20%;" width="10px;" src="<?= base_url(); ?>assets/images/logo_protocolo.png" /></div>
        <br>
        <!--span style="font-size:20px;">GPA Web 1.0</span-->
        <span style="font-size:13px; margin-left:20px;">Rua Apeninos, 485 – 4º andar – Paraíso – São Paulo – SP - Telefone: (11) 4810 2041</span>

    </div>
    <br>
    <br>
    <fieldset style="border-bottom: 1px solid; margin-top: 15%;"> <legend> PROTOCOLO DE DOCUMENTO: </legend>
        <?php
        //if($dados_geral['contratos'] != null){
        // foreach ($dados_geral['contratos'] as $result) {
        ?>
        <?php
        $mes_d = date('m');
        switch ($mes_d) {
        case 1:
            $atual_mes = 'Janeiro';
            break;
        case 2:
            $atual_mes = 'Fevereiro';
            break;
        case 3:
            $atual_mes = 'Março';
            break;
        case 4:
            $atual_mes = 'Abril';
            break;
        case 5:
            $atual_mes = 'Maio';
            break;
        case 6:
            $atual_mes = 'Junho';
            break;
        case 7:
            $atual_mes = 'Julho';
            break;
        case 8:
            $atual_mes = 'Agosto';
            break;
        case 9:
            $atual_mes = 'Setembro';
            break;
        case 10:
            $atual_mes = 'Outubro';
            break;
        case 11:
            $atual_mes = 'Novembro';
            break;
        case 12:
            $atual_mes = 'Dezembro';
            break;

            default:
                break;
        }
        ?>
        <span><b>São Paulo, </b> <?php echo date('d') ?> de <?php echo $atual_mes;?> de <?php echo date('Y');?></span> <br /> <br />
        <span><b></b> <?php echo $dados_geral['dados_recente'][0]->operadora; ?></span><br> 
        <span><b></b> A/C <?php echo $dados_geral['dados_recente'][0]->ac; ?></span><br> <br>
        
        <span><b></b> <?php echo $dados_geral['dados_recente'][0]->endereco; ?></span><br> <br>
        
        <span><b></b><?php echo $dados_geral['dados_recente'][0]->cliente; ?></span>
         <hr>
         <br>
        <span><b></b>Paciente: <?php echo $dados_geral['dados_recente'][0]->paciente; ?></span><br> 
        <span><b></b>Titular: <?php echo $dados_geral['dados_recente'][0]->titular; ?></span><br>
        <span><b></b>CPF: <?php echo $dados_geral['dados_recente'][0]->cpf; ?></span><br>
        <span><b></b>Contrato: <?php echo $dados_geral['dados_recente'][0]->contrato; ?></span><br>
       
        Segue:
        <table id="" class="table" arial-describedby="tablist_info" role="grid" cellspacing="0" width="100%">
            <thead>
                <tr role="row" class="odd">
                    <th style="font-size: 12px;">Tipo</th>
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
                foreach ($dados_geral['dados_protocolo'] as $result) {
                    ?>
                    <tr style="align-content: center;">
                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo $result->doc; ?></b></td>
                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->tipo; ?></td>
                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->nome_prestador; ?></td>
                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo '--'; ?></td>
                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo date('d/m/Y', strtotime($result->dta_recibo)); ?></td>
                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo number_format($result->valor_recibo, 2, ',', '.');  ?></td>
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
        <br />
        Atenciosamente,<br>
        Newport Consultoria e Corretora de Seguros 
    </fieldset> 
    <br />
    <br />

</div>

</section>
 <script language="JavaScript" type="text/javascript">
        window.onbeforeunload = confirmExit;
        var base_url = '<?php echo base_url();?>';
        function confirmExit() {
        location.href = base_url + 'Intranet/home'; 
        }  
</script>
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