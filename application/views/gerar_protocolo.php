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
                <div class="container nao-imprime" style="width:98%;height:990px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                    <div class="col-md-12" style="margin-bottom: 5%;">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" name="" action="<?= base_url() ?>Intranet/gerar_protocolos">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Data do atendimento</label>
                                            <input type="text" required="" value="<?php if($dados_geral['data_informada'] != null){ echo $dados_geral['data_informada'];}?>" id="gerar_protocolo_inicio" class="form-control" name="dta_atendimento">
                                        </div>
                                        <div class="col-md-2" style="margin-top: 2.5%;">
                                            <button onclick="" style="height: 40px;" type="submit" class="btn btn-success" name=""> <i class="fa fa-check-circle"></i> Filtrar</button>
                                        </div>
                                    </div>
                                </form>
                                    
                                    <?php if($dados_geral['dados_foreach_protocolo'] != null){?>
                                        <div class="box-body table-responsive">

                                            <table id="" class="table table-bordered table-striped table-hover dataTable no-footer" arial-describedby="tablist_info" role="grid" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr role="row" class="odd">
                                                        <th style="font-size: 12px;">Id do Beneficiário</th>
                                                        <th style="font-size: 12px;">Data do atendimento(s)</th>
                                                        <th style="font-size: 12px;">Nome do Solicitante</th>
                                                       <!-- <th style="font-size: 12px;">Procedimento</th>-->
                                                       <!-- <th style="font-size: 12px;">Prestador</th>
                                                       <!-- <th style="font-size: 12px;">Data Recibo</th>
                                                      <!--  <th style="font-size: 12px;">Valor Recibo</th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $geral = 0;
                                                    $total = 0;
                                                    foreach ($dados_geral['dados_foreach_protocolo'] as $result) {
                                                        ?>
                                                        <tr style="align-content: center;">
                                                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo $result->id_beneficiario; ?></b></td>
                                                             <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?></b></td>
                                                             <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><a href="protocolo_reembolso_reemitir?id=<?php echo $result->id_beneficiario; ?>&data=<?php echo $dados_geral['data_informada'];?>" title="Gerar Protocolo para este beneficiário"><?php echo $result->nome_atendimento; ?></a></td>
                                                            <!--<td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->tipo; ?></td>-->
                                                           <!-- <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->nome_prestador; ?></td> -->
                                                            <!--<td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->dta_recibo; ?></td>-->
                                                           <!-- <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo number_format($result->valor_recibo, 2, ',', '.'); ?></td>-->
                                                        </tr>
                                                        <?php
                                                        $total = ($result->valor_recibo);
                                                        $geral += $total;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table> 
                                            <?php //echo count($dados_geral['dados_foreach_protocolo'])?>
                                            <!--<div class="col-md-12">
                                                <hr>
                                                Total: <span style="float: right; color: #ff0000">R$:  <?php echo number_format($geral, 2, ",", "."); ?></span>
                                            </div>-->
                                        </div>
                                      <!--  <div class="col-md-12">
                                            <br />
                                            <button  style="float: right;"type="submit" class="btn btn-success" name=""><i class="fa fa-check-circle" aria-hidden="true"></i> OK</button>
                                        </div>-->
                                    <?php }?>
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
    $(document).ready(function () {
        $("#gerar_protocolo_inicio").mask("99/99/9999");
        $("#gerar_protocolo_inicio").datepicker({
            closeText: 'Fechar',
            prevText: '&#x3c;Anterior',
            nextText: 'Pr&oacute;ximo&#x3e;',
            currentText: 'Hoje',
            monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
        });
    });
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
<style>

    .ui-datepicker {
        background-color: #fff;
        border: 1px solid #66AFE9;
        border-radius: 4px;
        box-shadow: 0 0 8px rgba(102,175,233,.6);
        display: none;
        margin-top: 4px;
        padding: 10px;
        width: 240px;
    }
    .ui-datepicker a,
    .ui-datepicker a:hover {
        text-decoration: none;
    }
    .ui-datepicker a:hover,
    .ui-datepicker td:hover a {
        color: #2A6496;
        -webkit-transition: color 0.1s ease-in-out;
        -moz-transition: color 0.1s ease-in-out;
        -o-transition: color 0.1s ease-in-out;
        transition: color 0.1s ease-in-out;
    }
    .ui-datepicker .ui-datepicker-header {
        margin-bottom: 4px;
        text-align: center;
    }
    .ui-datepicker .ui-datepicker-title {
        font-weight: 700;
    }
    .ui-datepicker .ui-datepicker-prev,
    .ui-datepicker .ui-datepicker-next {
        cursor: default;
        font-family: 'Glyphicons Halflings';
        -webkit-font-smoothing: antialiased;
        font-style: normal;
        font-weight: normal;
        height: 20px;
        line-height: 1;
        margin-top: 2px;
        width: 30px;
    }
    .ui-datepicker .ui-datepicker-prev {
        float: left;
        text-align: left;
    }
    .ui-datepicker .ui-datepicker-next {
        float: right;
        text-align: right;
    }
    .ui-datepicker .ui-datepicker-prev:before {
        content: "\e079";
    }
    .ui-datepicker .ui-datepicker-next:before {
        content: "\e080";
    }
    .ui-datepicker .ui-icon {
        display: none;
    }
    .ui-datepicker .ui-datepicker-calendar {
        table-layout: fixed;
        width: 100%;
    }
    .ui-datepicker .ui-datepicker-calendar th,
    .ui-datepicker .ui-datepicker-calendar td {
        text-align: center;
        padding: 4px 0;
    }
    .ui-datepicker .ui-datepicker-calendar td {
        border-radius: 4px;
        -webkit-transition: background-color 0.1s ease-in-out, color 0.1s ease-in-out;
        -moz-transition: background-color 0.1s ease-in-out, color 0.1s ease-in-out;
        -o-transition: background-color 0.1s ease-in-out, color 0.1s ease-in-out;
        transition: background-color 0.1s ease-in-out, color 0.1s ease-in-out;
    }
    .ui-datepicker .ui-datepicker-calendar td:hover {
        background-color: #eee;
        cursor: pointer;
    }
    .ui-datepicker .ui-datepicker-calendar td a {
        text-decoration: none;
    }
    .ui-datepicker .ui-datepicker-current-day {
        background-color: #4289cc;
    }
    .ui-datepicker .ui-datepicker-current-day a {
        color: #fff;
    }
    .ui-datepicker .ui-datepicker-calendar .ui-datepicker-unselectable:hover {
        background-color: #fff;
        cursor: default;
    }
    .format_camp{
        color: #000033;
        height: 38px;
        font-family: cursive;
    }
</style>