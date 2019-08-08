<div class="contentpanel"><!--Início da classe geral-->
    <!--**********************-->
    <?php
//seta a data para o estado sp
    date_default_timezone_set('America/Sao_Paulo');

//#########################################################################
    ?>


    <div class="collapse navbar-collapse navbar-ex1-collapse">

    </div>
    <!-- /.navbar-collapse -->
</nav>
 <style>
                fieldset.scheduler-border {
                    border: solid 1px #DDD !important;
                    padding: 0 10px 10px 10px;
                    border-bottom: none;
                    margin-top: 4%;
                }

                legend.scheduler-border {
                    width: auto !important;
                    border: none;
                    font-size: 14px;
                }
                 #pisca {
                color: #000;
                transition: color .7s;
                }
                .mostrar {
                color: #f34 !important;
                }
            </style>
<div id="page-wrapper nao-imprime">

    <div class="container-fluid">
        <!--CSS-->    




        <div class="span10">
            <!---Body content----------------------------------------------------->

            <div> 
                <!---Body content----------------------------------------------------->
                <div class="container nao-imprime" style="width:98%;height:1200px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                    <div class="row">
                        <div class="col-md-12">
                        <form method="post" name="" action="<?= base_url() ?>Intranet/filtro_relatorio_outros_atendimentos">
                            <div class="col-md-2">
                                <fieldset class="scheduler-border" style="height: 110px;">
                                    <legend class="scheduler-border">Data início</legend>
                                <input style="height: 30px;" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  type="text" class="form-control" name="dta_inicio">
                                </fieldset>
                            </div>
                            <div class="col-md-2">
                                <fieldset class="scheduler-border" style="height: 110px;">
                                    <legend class="scheduler-border">Data fim</legend>
                                <input style="height: 30px;" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  type="text" class="form-control" name="dta_fim">
                                </fieldset>
                            </div>

                            <div class="col-md-2">
                                 <fieldset class="scheduler-border" style="height: 110px;">
                                    <legend class="scheduler-border">Andamento</legend>
                                <input style="height: 30px;" onkeyup="maiuscula(this)"  type="text" class="form-control" name="andamento">
                                 </fieldset>
                            </div>

                            <div class="col-md-3">
                                <fieldset class="scheduler-border" style="height: 110px;">
                                    <legend class="scheduler-border">Cliente</legend>
                                <input style="height: 30px;" onkeyup="maiuscula(this)"  type="text" class="form-control" name="cliente">
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                                <fieldset class="scheduler-border" style="height: 110px;">
                                    <legend class="scheduler-border">Beneficiário</legend>
                                <input style="height: 30px;" onkeyup="maiuscula(this)" type="text" class="form-control" name="beneficiario">
                                </fieldset>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 5%;">
                                 <fieldset class="scheduler-border" style="height: 110px;">
                                    <legend class="scheduler-border"></legend>
                                    <br />
                                <button type="submit" class="btn btn-success" name=""><i class="fa fa-check-circle" aria-hidden="true"></i> Pesquisar</button>
                                 </fieldset>
                            </div>
                    </form>
                    </div>
                    </div>
                     <!--   <fieldset> <legend> <small> </small>  </legend> </fieldset>  --> 
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                    <div class="box-body table-responsive">

                        <table id="example" class="table table-bordered table-striped table-hover dataTable no-footer" arial-describedby="tablist_info" role="grid" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row" class="odd">
                                    <th style="font-size: 12px;">Visualizar</th>
                                    <th style="font-size: 12px;">Solicitante</th>
                                    <th style="font-size: 12px;">Cliente</th>
                                    <th style="font-size: 12px;">Data</th>
                                    <th style="font-size: 12px;">Andamento</th>
                                    <th style="font-size: 12px;">Status</th>
                                    <th style="font-size: 12px;">Categoria</th>
                                    <th style="font-size: 12px;">Tipo</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dados_geral['atendimentos'] as $result) {
                                    ?>
                                    <tr style="align-content: center;">
                                        <td class="text-center">
                                            <a style="float: left;" title="VISUALIZAR REQUISIÇÃO" class="btn btn-success btn-xs btn-mini" href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo limitChars($result->nome_atendimento, 2); ?></b></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo limitChars($result->nome_cliente, 1); ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->andamento; ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->status; ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->categoria; ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->tipo; ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                    <div class="col-md-4">
                        <br />
                        <link href="<?= base_url(); ?>assets/css/grade-impressao.css" rel="stylesheet">
                        <a href="JavaScript:window.print();"  name="imprimir" class="btn btn-primary"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
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

<div class="imprime" style="margin-top: -140%; height : 65px; border-bottom: 1px solid;">
    <div class="conteudo" style="margin-top: -10%; height : 65px; border-bottom: 1px solid" >
        <br>
        <div style="position: relative ; top: 6px;"><img style="float : left; width: 20%;" width="10px;" src="<?= base_url(); ?>assets/images/logo.JPG" /></div>
        <br>
        <!--span style="font-size:20px;">GPA Web 1.0</span-->
        <span style="font-size:13px; margin-left:20px;">Rua Apeninos, 485 – 4º andar – Paraíso – São Paulo – SP - Telefone: (11) 4810 2041</span>

    </div>
    <br>
    <br>
    <?php  if($dados_geral['atendimentos'] != null){
                    foreach ($dados_geral['atendimentos'] as $result) {
                        ?>
    <fieldset style="border-bottom: 1px solid"> <legend> DADOS DO ATENDIMENTO: </legend> 
        <span><b>NOME DO SOLICITANTE: </b> <?php echo $result->nome_atendimento; ?></span> 
        <span style="float: right;"><b>TIPO: </b> <?php echo $result->tipo; ?></span><br> 
        <hr>
        <span><b>NOME DO CLIENTE: </b> <?php echo $result->nome_cliente; ?></span> 
        <span style="float: right;"><b>STATUS: </b> <?php echo $result->status; ?></span><br> 
        <hr>
        <span><b>DATA DA SOLICITAÇÃO: </b> <?php echo date('d/m/Y', strtotime($result->data_inicio)); ?></span> 
        <span style="float: right;"><b>CATEGORIA: </b> <?php echo $result->categoria; ?></span><br>
        <hr>
    </fieldset> 
    <br>
                    <?php }
    }?>


    <br />
    <br />
    <br />
    <br />
    <br />
    <span style="margin-left: 25%;"><b> _____________________________________</b></span><br />
    <span style="margin-left: 40%;"><b>Assinatura</b></span>

</div>
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


