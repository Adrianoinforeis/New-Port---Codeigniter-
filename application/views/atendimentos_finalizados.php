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

<div id="page-wrapper">

    <div class="container-fluid">
        <!--CSS-->    




        <div class="span10">
            <!---Body content----------------------------------------------------->

            <div> 
                <!---Body content----------------------------------------------------->
                <div class="container" style="width:98%;height:1300px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
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
                                    <th style="font-size: 12px;">Ações</th>
                                    <th style="font-size: 12px;">Detalhes</th>
                                    <th class="text-center"  style="font-size: 12px;">Status</th>
                                    <!--<th style="font-size: 12px;">Data do Envio</th>-->
                                    <th style="font-size: 12px;">Responsável</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dados_geral['atendimentos'] as $result) {
                                    ?>
                                    <tr style="align-content: center;">
                                        <td class="text-center">

                                           <button title="ENVIAR E-MAILS" onclick="funcao();" id="teste" type="button" class="btn btn-xs btn-success btn-mini" data-toggle="modal" data-target="#modal_emails" 
                                                    data-whatever_id_beneficiario="<?php echo $result->id_beneficiario; ?>"
                                                    data-whatever_id_atend="<?php echo $result->id_atend; ?>"
                                                    class="btn btn-xs btn-success btn-mini"><i class="fa fa-envelope" aria-hidden="true"></i> 
                                            </button>
                                            <a title="VISUALIZAR REQUISIÇÃO" class="btn btn-xs btn-info btn-mini" href="<?= base_url(); ?>Intranet/detalhes_atendimento_finalizado?id=<?php echo $result->id_atend; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                           <!-- <a href="<?= base_url(); ?>Intranet/baixar?arquivo=anexos/<?php echo $result->anexo; ?>" type="button" class=" "></a> -->

                                           <button title="ANEXAR ARQUIVOS" id="teste" type="button"  data-toggle="modal" data-target="#modal_anexos" 
                                                    data-whatever_id_beneficiario_file="<?php echo $result->id_beneficiario; ?>"
                                                    data-whatever_id_atend_file="<?php echo $result->id_atend; ?>"
                                                    class="btn btn-xs btn-success btn-mini"><i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td style="font-family: serif; align-content: center; size: 5px;">
                                            <span class="pull-left">
                                                <b><?php echo limitChars($result->nome_atendimento, 2); ?></b>
                                                <br>
                                                <span class="bold text-muted">Categoria::</span>
                                                <?php echo $result->categoria; ?>
                                                <!--
                                                <span class="bold text-muted">Operadora ::</span>
                                                   Plano: Ouro I 
                                                   <span class="bold text-muted">Cartão:</span>
                                                   123-->
                                            </span>
                                            <span class="pull-right text-right">
                                                <span class="text-gray size-10">Evento: </span>
                                                <?php echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?>
                                                <br>
                                                Cliente:  <?php echo  limitChars($result->nome_cliente, 0); ?>
                                            </span>
                                        </td>
                                        <td class="text-center" style="font-family: initial; align-content: center; size: 5px;"><b><?php echo $result->andamento; ?></b></td>
                                        <!--<td style="font-family: initial; align-content: center; size: 5px;"><?php //echo date('d/m/Y');            ?></td>-->
                                        <?php
                                        $data_hora_chamado = $result->data_inicio;
                                        $data_hora = date("Y-m-d H:i:s");
                                        $data1 = new DateTime($data_hora);
                                        $data2 = new DateTime($data_hora_chamado);
                                        //Calcula a diferença
                                        $intervalo = $data1->diff($data2);
                                        $meses = ($intervalo->m);
                                        $dias_d = ($intervalo->d);
                                        $multiplicames = ($meses * 30);
                                        $transformandomesemdias = ($multiplicames + $dias_d);
                                        $tempo_em_aberto = "Dias: $transformandomesemdias / Horas: &nbsp;{$intervalo->h}:{$intervalo->i}:{$intervalo->s}";
                                        ?>
                                        <td style="font-family: initial; color: #a61717; align-content: center; size: 5px;"><?php echo limitChars($result->nome_analista, 0); ?></td>
                                    </tr>
                                    <!-- Modal Arquivos anexos-->
                                    <!--    <div class="modal fade" id="myModal_anexo" tabindex="-1" role="dialog" aria-labelledby="myModal">
                                                <div class="modal-dialog" role="document" style="width: 690px; height: 410px; margin-top: 10%; margin-left: 30%;">
                                                    <form action="" method="post" name="_login" id="_login" data-toggle="validator" role="form">
            
                                                        <div class="modal-content">
                                                            <img src="<?= base_url(); ?>anexos/<?php //echo $result->anexo;          ?>" title="" width="689" height="400">
                                                            <a href="baixar.php?arquivo=../upload/<?php //echo $nomeimagem;           ?>" type="submit" class="btn btn-success">Baixar</a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div> -->

                                <?php }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        var alturaInicial = $(".atdmn_esp").height(); //armazena a altura inicial do DIV
                        $("#meusatendimentos_esp").on("click", function () {
                            var altura = $(".atdmn_esp").height(); // armazena a altura do DIV quando o botão é clicado
                            if (altura == alturaInicial) { // compara as duas alturas e decide se aumenta ou diminui
                                $(".atdmn_esp").height(300).css({
                                    cursor: "auto"
                                });
                            } else {
                                $(".atdmn_esp").height(alturaInicial).css({
                                    cursor: "default"
                                })
                           }
                        });
                    })
                </script>
                <div class="col-md-12" style="margin-top: 6%;">
                    <button class="btn btn-info" name=""  id="meusatendimentos_esp"><i class="fa fa-plus" aria-hidden="true"></i>
                        Atendimentos especiais
                    </button>
                </div>
                <div class="atdmn_esp" style="height: 150px; margin-bottom: 10%;">
                    <div class="container atdmn_esp" style="width:98%;height:150px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                        <div class="box-body table-responsive">

                            <table id="example" class="table table-bordered table-striped table-hover dataTable no-footer" arial-describedby="tablist_info" role="grid" cellspacing="0" width="100%">
                                <thead>
                                    <tr role="row" class="odd">
                                        <th style="font-size: 12px;">Ações</th>
                                        <th style="font-size: 12px;">Detalhes</th>
                                        <th class="text-center"  style="font-size: 12px;">Status</th>
                                        <!--<th style="font-size: 12px;">Data do Envio</th>-->
                                        <th style="font-size: 12px;">Tempo em aberto</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dados_geral['getAtendimentos_outros'] as $outros) {
                                        ?>
                                        <tr style="align-content: center;">
                                            <td class="text-center">
                                                <a title="EDITAR REQUISIÇÃO" class="btn btn-default" href="<?= base_url(); ?>Intranet/detalhes_atendimento_outros_finalizados?id=<?php echo $outros->id_atend; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td style="font-family: serif; align-content: center; size: 5px;">
                                                <span class="pull-left">
                                                    <b><?php echo limitChars($outros->nome_atendimento, 2); ?></b>
                                                    <br>
                                                    <span class="bold text-muted">Categoria::</span>
                                                    <?php echo $outros->tipo; ?>
                                                </span>
                                                <span class="pull-right text-right">
                                                    <span class="text-gray size-10">Evento: </span>
                                                    <?php echo date('d/m/Y H:i:s', strtotime($outros->data_inicio)); ?>
                                                </span>
                                            </td>
                                            <td class="text-center" style="font-family: initial; align-content: center; size: 5px;"><b><?php echo $outros->andamento; ?></b></td>
                                            <!--<td style="font-family: initial; align-content: center; size: 5px;"><?php //echo date('d/m/Y');             ?></td>-->
                                            <?php
                                            $data_hora_chamado = $outros->data_inicio;
                                            $data_hora = date("Y-m-d H:i:s");
                                            $data1 = new DateTime($data_hora);
                                            $data2 = new DateTime($data_hora_chamado);
                                            //Calcula a diferença
                                            $intervalo = $data1->diff($data2);
                                            $meses = ($intervalo->m);
                                            $dias_d = ($intervalo->d);
                                            $multiplicames = ($meses * 30);
                                            $transformandomesemdias = ($multiplicames + $dias_d);
                                            $tempo_em_aberto = "Dias: $transformandomesemdias / Horas: &nbsp;{$intervalo->h}:{$intervalo->i}:{$intervalo->s}";
                                            ?>
                                            <td style="font-family: initial; color: #a61717; align-content: center; size: 5px;"><?php echo $tempo_em_aberto; ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>    
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------------------------------------------------------->
        </div>
    </div><!--fluid-->
</div><!--container-->

<!-- Modal anexos-->
<div class="modal fade" id="modal_anexos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>Intranet/uploadArquivos">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Anexar arquivo (s)</h4>
                    </div>

                    <div class="modal-body">

                        <div id="msgUsu2"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="id_atend" id="id_atend">
                                <input type="hidden" name="id_beneficiario" id="id_beneficiario">
                                <label for="Paciente">FAZER UPLOAD: </label>
                                <div class="col-md-12 form-group">
                                   <!-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                    <input type="file" name="arquivo[]" multiple="multiple" />-->
                                    <input type="file" name="arquivo" class="form-control">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>DESCRIÇÃO</label>
                                    <input required="" type="text" name="descricao" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="table-responsive">
                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ANEXOS(S)</th>
                                        </tr>

                                    </thead>
                                    <tbody id="anexo_resultado"> 

                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" style="float: left;" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</button>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" style="float: left;"  class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> POSTAR</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- anexos fim -->


<!-- Modal envia e-mails -->
<div class="modal fade" id="modal_emails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">
                <form method="post" action="<?= base_url(); ?>EnviaEmail/enviandoemail">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Envio de e-mails</h4>
                    </div>

                    <div class="modal-body">

                        <div id="msgUsu2"></div>

                        <div class="row">
                            <input type="hidden" name="id_atend" id="id_atend">
                            <input type="hidden" name="id_beneficiario" id="id_beneficiario">
                            <div class="col-md-6">
                            <div class="table-responsive">
                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>EMAIL CLIENTE</th>
                                            <th></th>
                                        </tr>

                                    </thead>
                                    <tbody id="mail_resultado"> 

                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="table-responsive">
                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>EMAIL BENEFICIÁRIO</th>
                                            <th></th>
                                        </tr>

                                    </thead>
                                    <tbody id="mail_resultado_beneficiario"> 

                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <td>
                                <div class="col-md-12 form-group">
                                    <input type="text" name="email_opcional" class="form-control" placeholder="UM OUTRO E-MAIL" id="">

                                </div>
                            </td>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-10">
                                <button style="float: right;" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</button>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" onclick="disparaEmail();" class="btn btn-success"><i class="fa fa-envelope" aria-hidden="true"></i> ENVIAR</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->

<!-- Bootstrap Core JavaScript -->
<script type="text/javascript">setInterval("window.location=''", "180000");</script> 
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>


<!--**********************-->
</div><!-- contentpanel fim geral-->

</div><!-- mainpanel -->


<script type="text/javascript">
    // INICIO FUNÇÃO DE MASCARA MAIUSCULA
    function maiuscula(z) {
        v = z.value.toUpperCase();
        z.value = v;
    }
    //FIM DA FUNÇÃO MASCARA MAIUSCULA
    
    //email
    function disparaEmail(){
        alert('E-mail disparado com sucesso');
    }
</script>
</section>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>"
    ///alteração de planos
    $('#modal_emails').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var whatever_id_beneficiario = button.data('whatever_id_beneficiario') // Extract info from data-* attributes
        var whatever_id_atend = button.data('whatever_id_atend')
        var modal = $(this)
        //  modal.find('.modal-title').text('ID do Dependente: ' + whatever_id)
        modal.find('#id_beneficiario').val(whatever_id_beneficiario)
        modal.find('#id_atend').val(whatever_id_atend)
        // alert(whatever_id_beneficiario);
        $.post(base_url + 'Ajax/getEmailsChamado', {
            id_beneficiario: whatever_id_beneficiario
        }, function (data) {
            // console.log(data); 
            $('#mail_resultado').html(data);
        });
//pega email funcionario
        $.post(base_url + 'Ajax/getEmailsChamadoBeneficiario', {
            id_beneficiario: whatever_id_beneficiario
        }, function (data) {
            // console.log(data); 
            $('#mail_resultado_beneficiario').html(data);
        });
        
        
        
    })



    $('#modal_anexos').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var whatever_id_beneficiario = button.data('whatever_id_beneficiario_file') // Extract info from data-* attributes
        var whatever_id_atend = button.data('whatever_id_atend_file')
        var modal = $(this)
        //  modal.find('.modal-title').text('ID do Dependente: ' + whatever_id)
        modal.find('#id_beneficiario').val(whatever_id_beneficiario)
        modal.find('#id_atend').val(whatever_id_atend)
        // alert(whatever_id_beneficiario);
        $.post(base_url + 'Ajax/getAnexosChamado', {
            id_do_chamado: whatever_id_atend
        }, function (data) {
            // console.log(data); 
            $('#anexo_resultado').html(data);
        });

    })

</script>


