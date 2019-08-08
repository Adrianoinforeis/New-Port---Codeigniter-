<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("a.menutoggle").trigger("click");
    });
</script>
<div class="contentpanel"><!--Início da classe geral-->
    <!--**********************-->


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
                <div class="col-md-12">
                <!---Body content----------------------------------------------------->
                 <?php 
                 $session_logado = $this->session->userdata('logado');
                 $user_logado = $session_logado[0]->permissao;
                 if ($user_logado == 'Administrador' || $user_logado == 'Comum') {
                    ?>
                <div class="container" style="width:98%;height:1400px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
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
                                    <th style="font-size: 12px;">Protocolo</th>
                                    <th style="font-size: 12px;">Ações</th>
                                    <th style="font-size: 12px;">Detalhes</th>
                                    <th class="text-center"  style="font-size: 12px;">Status</th>
                                    <!--<th style="font-size: 12px;">Data do Envio</th>-->
                                    <th style="font-size: 12px;">Tempo em aberto</th>
                                    <th style="font-size: 10px;">Valor recibo</th>
                                    <th style="font-size: 10px;">Número</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dados_geral['atendimentos'] as $result) {
                                    ?>
                                    <tr style="align-content: center;">
                                        <td style="font-family: serif; align-content: center; size: 5px;">
                                             <?php if($result->categoria == 'REEMBOLSO'){?>
                                            <?php if($result->protocolo == 1){?>
                                            <span style="color: #009900; font-size: 11px;">Gerado</span>
                                            <?php }else{?>
                                            <span style="color: #ff9933; font-size: 11px;">Pendente</span>
                                            <?php }
                                             }else{?>
                                            --
                                              <?php }?>
                                        </td>
                                        <td class="text-center">

                                            <button  style="margin-top: 10%;" title="ENVIAR E-MAILS" onclick="funcao();" id="teste" type="button" class="btn btn-xs btn-success btn-mini" data-toggle="modal" data-target="#modal_emails" 
                                                    data-whatever_id_beneficiario="<?php echo $result->id_beneficiario; ?>"
                                                    data-whatever_id_atend="<?php echo $result->id_atend; ?>"
                                                    class="btn btn-xs btn-success btn-mini"><i class="fa fa-envelope" aria-hidden="true"></i> 
                                            </button>
                                            <a  style="margin-top: 10%;" title="EDITAR REQUISIÇÃO" class="btn btn-xs btn-minit btn-default" href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <script type="text/javascript">
//                                                function protocolo(id){
//                                                    if (confirm("Esse protocolo já foi emitido, deseja emitir novamente ?")) {
//                                                    window.location = "<?= base_url(); ?>Intranet/protocolo_reembolso_reemitir?id=" + id + "";
//                                                }
//                                                }
                                            </script>
                                           <!-- <a href="<?= base_url(); ?>Intranet/baixar?arquivo=anexos/<?php echo $result->anexo; ?>" type="button" class=" "></a> -->

                                            <button  style="margin-top: 10%;" title="ANEXAR ARQUIVOS" id="teste" type="button" class="btn btn-info btn btn-xs btn-minit" data-toggle="modal" data-target="#modal_anexos" 
                                                    data-whatever_id_beneficiario_file="<?php echo $result->id_beneficiario; ?>"
                                                    data-whatever_id_atend_file="<?php echo $result->id_atend; ?>"
                                                    class="btn btn-xs btn-success btn-mini"><i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td style="font-family: serif; align-content: center; size: 5px;">
                                            <span class="pull-left">
                                                <b style="font-size: 13px;"><?php echo $result->nome_atendimento; ?></b>
                                                <br>
                                                <span class="bold text-muted" style="font-size: 12px;">Categoria::
                                                <?php if($result->categoria == 'REEMBOLSO'){echo $result->categoria;}else{echo $result->tipo;} ?></span>
                                                <!--
                                                <span class="bold text-muted">Operadora ::</span>
                                                   Plano: Ouro I 
                                                   <span class="bold text-muted">Cartão:</span>
                                                   123-->
                                            </span>
                                            <span class="pull-right text-right">
                                                <span class="text-gray size-7" style="font-size: 11px;">Previsão: 
                                                <?php if($result->prevpagamento != null){echo date('d/m/Y', strtotime($result->prevpagamento));}else{echo 'Não informada';} ?></span>
                                                <br>
                                                <span class="text-gray size-7" style="font-size: 11px;">
                                                Cliente:  <?php echo limitChars($result->nome_cliente, 3); ?></span>
                                            </span>
                                        </td>
                                        <td class="text-center" style="font-family: initial; align-content: center; size: 5px;"><b style="font-size: 7px;"><?php echo $result->status; ?></b></td>
                                        <!--<td style="font-family: initial; align-content: center; size: 5px;"><?php //echo date('d/m/Y');             ?></td>-->
                                        <?php
                                        if($result->ini_pro_operadora != null || $result->ini_pro_operadora != ''){
                                        $data_hora_chamado = $result->ini_pro_operadora;
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
                                        }else{
                                        $tempo_em_aberto = 'Não informou data';
                                        }
                                        ?>
                                        <td style="font-family: initial; color: #a61717; align-content: center; size: 5px;"><b style="font-size: 11px;"><?php echo $tempo_em_aberto; ?></b></td>
                                        <td style="align-content: center;">
                                            <span class="text-gray size-7" style="font-size: 11px;">
                                            <?php 
                                            if($result->categoria == 'REEMBOLSO'){
                                            echo 'R$ '.number_format($result->valor_recibo,2,",",".");
                                            }else{
                                            echo '--';    
                                            }
                                            ?></span>
                                        </td>
                                        <td style="align-content: center;">
                                            <b style="font-size: 8px;">
                                                <a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>"> <?php echo $result->id_atend; ?></a>
                                            </b>
                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
                 <?php }?>

                  <script type="text/javascript">
                    $(document).ready(function () {
                        var alturaInicial = $(".atdmn").height(); //armazena a altura inicial do DIV
                        $("#meusatendimentos").on("click", function () {
                            var altura = $(".atdmn").height(); // armazena a altura do DIV quando o botão é clicado
                            if (altura == alturaInicial) { // compara as duas alturas e decide se aumenta ou diminui
                                $(".atdmn").height(600).css({
                                    cursor: "auto"
                                });
                            } else {
                                $(".atdmn").height(alturaInicial).css({
                                    cursor: "default"
                                })
                           }
                        });
                    })
                </script>

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
                <?php if($dados_geral['getAtendimentos_outros'] != null){?>
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
                                                <a style="margin-top: 4%;" title="EDITAR REQUISIÇÃO" class="btn btn-default" href="<?= base_url(); ?>Intranet/detalhes_atendimento_outros?id=<?php echo $outros->id_atend; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td style="font-family: serif; align-content: center; size: 5px;">
                                                <span class="pull-left">
                                                    <b style="font-size: 13px;"><?php echo $outros->nome_atendimento; ?></b>
                                                    <br>
                                                    <span class="bold text-muted" style="font-size: 12px;">Categoria::
                                                    <?php echo $outros->tipo; ?></span>
                                                </span>
                                                <span class="pull-right text-right" style="font-size: 11px;">
                                                    <span class="text-gray size-10">Evento:
                                                    <?php echo date('d/m/Y H:i:s', strtotime($outros->data_inicio)); ?></span>
                                                </span>
                                            </td>
                                            <td class="text-center" style="font-family: initial; align-content: center; size: 5px;"><b style="font-size: 8px;"><?php echo $outros->status; ?></b></td>
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
                                            <td style="font-family: initial; color: #a61717; align-content: center; size: 5px;"><b style="font-size: 11px;"><?php echo $tempo_em_aberto; ?></b></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>    
                        </div>
                    </div>
                </div>
                <?php }?>
                <!-------------------------------------------------------------------->
                </div>

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
    <script type="text/javascript">setInterval("window.location='<?php echo base_url();?>Intranet/home'", "180000");</script> 
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>





<script type="text/javascript">
    // INICIO FUNÇÃO DE MASCARA MAIUSCULA
    function maiuscula(z) {
        v = z.value.toUpperCase();
        z.value = v;
    }
    //FIM DA FUNÇÃO MASCARA MAIUSCULA

    //email
    function disparaEmail() {
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

<?php if($dados_geral['aniversariantes'] != null){?>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>"
    $(document).ready(function(){
     // $('#modal_aniversariantes').modal('show');  
    });
    
   // $.post(base_url + 'Ajax/getAnexosFaturamento', {
         //   id_da_fatura: <?php //echo $dados_geral['retorno']['id_faturamento'];?>
      //  }, function (data) {
            // console.log(data); 
          //  $('#anexo_resultado_show').html(data);
       // });
    </script>
<?php }?>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Aniversariante-->
<div  class="modal fade" id="modal_aniversariantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg rounded" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 15%; margin-left: 20%;">
            <div class="modal-content" style=" background-color: #ff9933;">
                <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>EnviaEmail/aniversariantes">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <!--<marquee> <h6 class="modal-title" id="myModalLabel" style="margin-left: 25%;">ANIVERSARIANTES DE HOJE</h6></marquee>-->
                       <img src="<?= base_url(); ?>assets/images/parabens.jpg" class="img img-responsive img-circle"style="height: 120px; margin-top: -18%; margin-left: 35%;" title="">
                       <h8>ANIVERSARIANTES DE HOJE</h8>
                     </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table style=" background-color: #ff9933;" id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style=" background-color: #ff9933;">NOME</th>
                                                <th style=" background-color: #ff9933;">EMAIL</th>
                                                <th style=" background-color: #ff9933;">NASCIMENTO</th>
                                                <th style=" background-color: #ff9933;">IDADE</th>
                                            </tr>
                                        </thead>
                                         <tbody> 
                                           <?php  $enviaemail = null;
                                           foreach ($dados_geral['aniversariantes'] as $item) {?>
                                             <tr>
                                                 <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><span class="badge badge-pill badge-warning"><?php echo $item->nome_ben;?></span></td>
                                                 <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><span class="badge badge-pill badge-warning"><?php echo $item->benef_email;?></span></td>
                                                 <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><span class="badge badge-pill badge-warning"><?php echo $item->dtaNascimento;?></span></td>
                                                 <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><span class="badge badge-pill badge-warning"><?php echo $item->idade;?></span></td>
                                             </tr>
                                             <?php if($item->benef_email != ''){ $enviaemail = 'sim';?>
                                           <?php } }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                           <!-- <div class="col-md-4">
                                <button type="button" style="float: left;" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</button>
                            </div>-->
                           <?php if($enviaemail != null){?>
                           <div class="col-md-3" style="float: right;">
                               <button type="submit" style="float: left; background-color: #cc6600;"  class="btn btn-success"><i class="fa fa-envelope" aria-hidden="true"></i> ENVIAR-EMAIL</button>
                            </div>
                           <?php }else{?>
                            <div class="col-md-3" style="float: right;">
                                <button onClick="jarvis()" type="button" style="float: left; background-color: #cc6600;"  class="btn btn-success"><i class="fa fa-envelope" aria-hidden="true"></i> ENVIAR E-MAIL</button>
                            </div>
                           <?php }?>
                        </div>
                    </div>
                </form>
            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>

<script type="text/javascript">
                    function jarvis() {
                        alert('Atenção para disparar o e-mail é necessário que o(s) beneficiários possua e-mail cadastrado, por gentileza inclua o email para cada beneficiário.');
                    }
</script>
