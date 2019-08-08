<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("a.menutoggle").trigger("click");
    });
</script>

<div class="contentpanel"><!--Início da classe geral-->
    <div id="page-wrapper" style="background-color: #fff; margin-bottom: 20%;">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <script type="text/javascript">
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
                    function maiuscula(z) {
                        v = z.value.toUpperCase();
                        z.value = v;
                    }
//FIM DA FUNÇÃO MASCARA MAIUSCULA
                </script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $("input.dinheiro").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "."});
                    });
                </script>
<?php //var_dump($dados_geral['dados_beneficiario'])?>
                <div class="col-md-6">
                    <h3 class="page-header">DETALHES DA SOLICITAÇÃO <span style="color: #999900;">NÚMERO: <?php echo $dados_geral['dados_beneficiario']->id_atend; ?> </span></h3>
                </div>
                <div class="col-md-6">
                    <form style="margin-top: 7%;" action="<?= base_url(); ?>cadastrar/criacao_de_interacao" method="post" >
                        <?php
                        $session_logado = $this->session->userdata('logado');
                        if ($session_logado[0]->tipo_acesso == 'Colaborador') {
                            ?>
                            <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_beneficiario']->id_atend; ?>">
                            <?php if ($dados_geral['dados_beneficiario']->analista != null) { ?>
                                <button disabled="" class="btn btn-success xs btn-mini" type="submit" name="atender" value="posse"><i class="fa fa-check-circle" aria-hidden="true"></i> POSSE</button>
                            <?php } else { ?>
                                <button class="btn btn-success xs btn-mini" type="button" name="atender" value="posse" data-toggle="modal" data-target="#modal_posse" ><i class="fa fa-check-circle" aria-hidden="true"></i> POSSE</button>
                            <?php } ?>
<?php } ?>
                    </form>
                </div>
            </div>
            <!-- /.row -->
            <style>
                .campos_form{
                    padding: 5px;  
                }
            </style>
            <!-- /.row -->
            <div class="col-md-12" style="margin-bottom: 5%;">
                <?php
                $dominio = $_SERVER['HTTP_HOST'];
                $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                ?>
                <script type="text/javascript">
                    //  function deletar(id) {
                    //      if (confirm("Deseja remover esse fornecedor?")) {
                    //          window.location = "<?= base_url(); ?>Deletar/deletar_fornecedor?acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                    //= "cadastro_usuarios.php?acao=deletar&id=" + id;
                    //     }
                    //  }
                </script>
                <form action="<?= base_url(); ?>cadastrar/criacao_de_interacao" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                   <!-- <input type="hidden" name="url" value="<?php //echo $url;    ?>">-->
                    <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_beneficiario']->id_atend; ?>">
                    <input type="hidden" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>" name="nome_solicitante">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nome">NOME BENEFICIÁRIO / SOLICITANTE </label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_atendimento; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="nome">
                        </div>
                        <div class="col-md-4">
                            <label for="titular">TITULAR</label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="nome">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-2">
                            <label for="tipo">TIPO</label>
                            <select class="form-control campos_form" name="tipo">
                                <option value="CONSULTA" <?php echo ($dados_geral['dados_beneficiario']->tipo == 'CONSULTA' ? 'selected="selected"' :'');?>>CONSULTA</option>
                                <option value="EXAME" <?php echo ($dados_geral['dados_beneficiario']->tipo == 'EXAME' ? 'selected="selected"' :'');?>>EXAME</option>
                                <option value="TERAPIAS" <?php echo ($dados_geral['dados_beneficiario']->tipo == 'TERAPIAS' ? 'selected="selected"' :'');?>>TERAPIAS</option>
                                <option value="INTERNAÇÃO" <?php echo ($dados_geral['dados_beneficiario']->tipo == 'INTERNAÇÃO' ? 'selected="selected"' :'');?>>INTERNAÇÃO</option>
                                <option value="OUTROS" <?php echo ($dados_geral['dados_beneficiario']->tipo == 'OUTROS' ? 'selected="selected"' :'');?>>OUTROS</option>
                            </select>
                        </div>  
                        <div class="col-md-2">
                            <label for="status">STATUS</label>
                            <select class="form-control campos_form" name="status" required="">
                                <option value="ANÁLISE NA OPERADORA" <?php echo ($dados_geral['dados_beneficiario']->status == 'ANÁLISE NA OPERADORA' ? 'selected="selected"' :'');?>>ANÁLISE NA OPERADORA</option>
                                <option value="PAGO" <?php echo ($dados_geral['dados_beneficiario']->status == 'PAGO' ? 'selected="selected"' :'');?>>PAGO</option>
                                <option value="FINALIZADO" <?php echo ($dados_geral['dados_beneficiario']->status == 'FINALIZADO' ? 'selected="selected"' :'');?>>FINALIZADO</option>
                                <option value="NEGADO" <?php echo ($dados_geral['dados_beneficiario']->status == 'NEGADO' ? 'selected="selected"' :'');?>>NEGADO</option>
                                <option value="PENDÊNCIA" <?php echo ($dados_geral['dados_beneficiario']->status == 'PENDÊNCIA' ? 'selected="selected"' :'');?>>PENDÊNCIA</option>
                            </select>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                            <label for="Empresa">EMPRESA</label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_cliente; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="cliente">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="plano">PLANO</label>
                            <?php //echo ($dados_geral['ver_planos']->nome_plano);?>
                            <input disabled="" type="text" value="<?php 
                            $dados_geral['ver_planos']= null;  
                            //$dados_geral['dados_beneficiario']->nome_plano = null;
                            if($dados_geral['dados_beneficiario']->plano_nome == null || $dados_geral['dados_beneficiario']->plano_nome == ''){
                            if($dados_geral['ver_planos'] != null && !empty($dados_geral['ver_planos']->nome_plano))
                                {echo $dados_geral['ver_planos']->nome_plano; 
                                }else if(isset($dados_geral['dados_beneficiario']->nome_plano) && $dados_geral['dados_beneficiario']->nome_plano != null && !empty($dados_geral['dados_beneficiario']->nome_plano))
                                    { echo $dados_geral['dados_beneficiario']->nome_plano;}else{ 
                                        echo 'NÃO POSSUI PLANO VINCULADO';}
                            }else{ 
                            echo $dados_geral['dados_beneficiario']->plano_nome;   
                            }?>" 
                                        onkeyup="maiuscula(this)" class="form-control campos_form" name="plano">
                        </div>
                        <?php if ($dados_geral['dados_beneficiario']->categoria == 'REEMBOLSO') { ?>
                            <div class="col-md-2">
                                <label for="Data">DATA RECIBO</label>
                                <input disabled="" type="text" value="<?php if($dados_geral['dados_beneficiario']->dta_recibo == null || $dados_geral['dados_beneficiario']->dta_recibo == '31/12/1969' || $dados_geral['dados_beneficiario']->dta_recibo == ''){}else{echo $data = implode("/",array_reverse(explode("-",$dados_geral['dados_beneficiario']->dta_recibo)));} ?>" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="data_recibo" placeholder="xx/xx/xxxx">
                            </div>  
                            <div class="col-md-2">
                                <label for="Data">DATA PAGAMENTO</label>
                                <input type="text" style="height: 30px;" value="<?php if($dados_geral['dados_beneficiario']->dta_reembolso != null || $dados_geral['dados_beneficiario']->dta_reembolso != '31/12/1969'){echo $data = implode("/",array_reverse(explode("-",$dados_geral['dados_beneficiario']->dta_reembolso)));} ?>" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="data_reembolso" placeholder="xx/xx/xxxx">
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="Data">INI/PROC/OPERADORA</label>
                                <input type="text" style="height: 30px;" value="<?php if($dados_geral['dados_beneficiario']->ini_pro_operadora == null || $dados_geral['dados_beneficiario']->ini_pro_operadora == '31/12/1969' || $dados_geral['dados_beneficiario']->ini_pro_operadora == ''){}else{echo $data = implode("/",array_reverse(explode("-",$dados_geral['dados_beneficiario']->ini_pro_operadora)));} ?>" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="ini_pro_operadora" value="" placeholder="xx/xx/xxxx">
                            </div> 
                            <div class="col-md-2">
                                <label for="vlrecibo">VALOR RECIBO</label>
                                <input disabled="" type="text" value="<?php echo number_format($dados_geral['dados_beneficiario']->valor_recibo, 2, ',', '.'); ?>" class="form-control campos_form dinheiro" name="vlrecibo" placeholder="R$">
                            </div>  
                            <div class="col-md-2">
                                <label for="vlrecibo">VALOR PAGO</label>
                                <input type="text" value="<?php echo number_format($dados_geral['dados_beneficiario']->valor_reembolso, 2, ',', '.'); ?>" class="form-control campos_form dinheiro" name="vlrembolso" placeholder="R$">
                            </div>
                            <div class="col-md-2">
                                <label for="vlrecibo">PREV. PAGAMENTO</label>
                                <input type="text" style="height: 30px;" value="<?php if($dados_geral['dados_beneficiario']->prevpagamento == null || $dados_geral['dados_beneficiario']->prevpagamento == '31/12/1969' || $dados_geral['dados_beneficiario']->prevpagamento == ''){}else{echo $data = implode("/",array_reverse(explode("-",$dados_geral['dados_beneficiario']->prevpagamento)));} ?>" name="prevpagamento" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" placeholder="xx/xx/xxxx">
                            </div>
                            <div class="col-md-4">
                                <label for="plano">EM POSSE</label>
                                <input type="hidden" value="<?php echo $dados_geral['dados_beneficiario']->analista; ?>" name="analista_posse">
                                <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_analista; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="analista">
                            </div>
                            <div class="col-md-12">
                                <label for="vlrecibo">NOME DO PRESTADOR</label>
                                <input type="text" disabled="" onkeyup="maiuscula(this);" value="<?php echo $dados_geral['dados_beneficiario']->nome_prestador; ?>" class="form-control campos_form" name="nome_prestador">
                            </div>
                            <div class="col-md-12">

                                <label for="desc">SOLICITAÇÃO</label>
                                <textarea disabled="" class="form-control campos_form" rows="" minlength="10" cols="1" name="obschamado"><?php echo $dados_geral['dados_beneficiario']->obs; ?></textarea>

                            </div>
                        </div>
                        <?php } else {
                        ?>
                        <div class="col-md-4">
                            <label for="plano">EM POSSE</label>
                            <input type="hidden" value="<?php echo $dados_geral['dados_beneficiario']->analista; ?>" name="analista_posse">
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_analista; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="analista">
                        </div>
                        <div class="col-md-12">
                            <label for="desc">SOLICITAÇÃO</label>
                            <textarea disabled="" class="form-control campos_form" rows="" minlength="10" cols="1" name="obschamado"><?php echo $dados_geral['dados_beneficiario']->obs; ?></textarea>
                        </div>
                </div>
                <?php } ?>
            <div class="row">
                <div class="col-md-8">
                    <label for="observacao">RESOLUÇÃO DO ATENDIMENTO</label>
                    <textarea class="form-control campos_form" rows="4" minlength="6" cols="1" name="resolucao" id="obs" placeholder="Informe a resolução do atendimento" data-error="Por favor, informe a descrição do chamado" onkeyup="mostrarResultado(this.value, 500, 'spcontando');maiuscula(this);contarCaracteres(this.value, 500, 'sprestante')"><?php echo $dados_geral['dados_beneficiario']->resolucao; ?></textarea>
                    <span id="spcontando" class="badge">Mínimo de 10 caracteres...</span><br />
                    <span id="sprestante" class="badge"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-md-4">
                    <br>
                    <?php
                    $session_logado = $this->session->userdata('logado');
                    $user_logado = $session_logado[0]->id;
                    if ($dados_geral['dados_beneficiario']->andamento != 'FINALIZADO') {
                        ?>
                    <button name="dados" value="dados" style="float: right;" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR DADOS</button>
                    <!--
                    <?php //}else if($dados_geral['dados_beneficiario']->analista == $user_logado && $dados_geral['dados_beneficiario']->andamento == 'EM ATENDIMENTO'){?>
                    <button name="dados" value="dados" style="float: right;" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR DADOS</button>
                    <?php //}else if($dados_geral['dados_beneficiario']->andamento == 'ABERTO'){?>
                    <button name="dados" value="dados" style="float: right;" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR DADOS</button>
                    <?php //}else{?>
                    <button style="float: right;" disabled="" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR DADOS</button>
                   -->
                     <?php }?>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 7%;">
            <div class="col-md-12" style="background-color: #f4f2f2;">
                <h4>ADICIONAR INTERAÇÕES NO ATENDIMENTO</h4>
            </div>
        </div>
        <?php
        $session_logado = $this->session->userdata('logado');
        if ($session_logado[0]->tipo_acesso == 'Colaborador') {
            ?>
            <div class="row">
                <div class="col-md-6">
                    <label for="observacao">OBSERVAÇÃO</label>
                    <textarea class="form-control campos_form" rows="2" minlength="6" cols="1" name="observacao" placeholder="Descreva a dúvida ou problema com no mínimo 10 caracteres" required data-error="Por favor, informe a descrição do chamado"></textarea>
                    <span id="sprestante" class="badge"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-md-2">
                    <label for="Data">PREV. RETORNO</label>
                    <input type="hidden" name="data_abertura" value="<?php //echo date('d/m/Y', strtotime($dados_geral['dados_beneficiario']->data_inicio));  ?>">
                    <input required="" value="<?php echo date('d/m/Y');?>" id="prev_retorno" type="text" style="height: 30px;" placeholder="xx/xx/xxxx" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="prev_retorno" >
                </div> 
                <div class="col-md-4">   
                    <label>INSERIR INTERAÇÃO</label><br />
                    <button type = "submit" value="interacao" style="float: left;" name = "interacao" class = "btn btn-info">INTERAÇÃO</button>                    
                </div>
            </div>
<?php } ?>
        </form>

    <div class="col-md-12" style="margin-bottom: 3%;">
        <legend class="legend">INTERAÇÕES</legend>
        <div class="table-responsive">
            <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>DATA</th>
                        <th>PREVISÃO DE RETORNO</th>
                        <th>OBSERVAÇÃO</th>
                    </tr>

                </thead>
                <tbody> 
            <?php foreach ($dados_geral['dados_interacoes'] as $value) {
                ?>
                        <tr>
                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo date('d/m/Y H:i:s', strtotime($value->data_add)); ?></td>
                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $data = implode("/",array_reverse(explode("-",$value->prev_retorno))); ?></td>
                            <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $value->observacao; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div> 
        <form action="<?= base_url(); ?>cadastrar/encerramentoAtendimento" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
           <!-- <input type="hidden" name="url" value="<?php //echo $url;   ?>">-->
            <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_beneficiario']->id_atend; ?>">
            <?php
            $session_logado = $this->session->userdata('logado');
            if ($session_logado[0]->tipo_acesso == 'Colaborador') {
                ?>
                <div class="col-md-10">   
                    <br />
                    <?php
                    $session_logado = $this->session->userdata('logado');
                    $user_logado = $session_logado[0]->id;
                   // if ($dados_geral['dados_beneficiario']->analista == $user_logado && ($dados_geral['dados_beneficiario']->andamento != 'FINALIZADO')) {
                      if($dados_geral['dados_beneficiario']->resolucao == null || $dados_geral['dados_beneficiario']->resolucao == '' || $dados_geral['dados_beneficiario']->nome_analista == null || $dados_geral['dados_beneficiario']->nome_analista == '' || $dados_geral['dados_beneficiario']->andamento == 'FINALIZADO'){?>
                    <span style="font-size: 13; color: #ffcc00;">Atenção antes de finalizar o chamado o mesmo deverá está em posse de alguém e também informar a resolução do atendimento. </span><br />
                    <button disabled="" type = "" style="float: left; margin-top: 1%;" name = "btn_abcham" class = "btn btn-danger" onclick="redirecionar();"><i class="fa fa-check-circle" aria-hidden="true"></i> FINALIZAR</button>
                      <?php }else{ ?>
                    <button type = "button" data-toggle="modal" data-target="#modal_emails"  style="float: left; margin-top: 1%;" name = "btn_abcham" class = "btn btn-danger" onclick="redirecionar();"><i class="fa fa-check-circle" aria-hidden="true"></i> FINALIZAR</button> 
                      <?php }?>
                    <?php //} else { ?>
                       <!-- <button disabled="" type = "submit" style="float: left; margin-top: 1%;" name = "btn_abcham" class = "btn btn-danger" onclick="redirecionar();"><i class="fa fa-check-circle" aria-hidden="true"></i> FINALIZAR</button> -->
                    <?php //} ?>
                </div>
                <?php } ?>
        </form>
    </div><!--faturamento-->
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="modal_emails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:560px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">

                <form method="post" action="<?= base_url(); ?>EnviaEmail/finalizandoatendimento">
                    <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_beneficiario']->id_atend; ?>">
                    <div class="col-md-10">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title" id="myModalLabel">Envio de e-mails</h4>
                        </div>

                        <div class="modal-body">

                            <div id="msgUsu2"></div>

                            <div class="row">
                                <div class="col-md-12 form-group input_fields_wrap">
                                   <!-- <input type="" name="email_opcional" class="form-control" placeholder="UM OUTRO E-MAIL" id="">-->
                                    <button style="margin-bottom: 3%; margin-left: 2%;" type="button" class="btn add_field_button"><i class="fa fa-plus"></i> Incluir E-mail</button>

                                </div>
                            </div>

                            <!--
                            <div class="col-md-12 form-group" style="margin-bottom: 3%; margin-left: 3%;" >
                                <label>Detalhes das faturas (Opcional)</label>
                                <textarea class="form-control" name="detalhes" rows="2" cols="12"></textarea>
                            </div>-->
                        </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-9">
                                    <button onclick="at();" style="float: right;" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</button>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" onclick="" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> CONTINUAR</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            </div>
            </div>
        </div><!-- modal-content -->
        <script type="text/javascript">
$(document).ready(function() {
  var max_fields = 14; //maximum input boxes allowed
  var wrapper = $(".input_fields_wrap"); //Fields wrapper
  var add_button = $(".add_field_button"); //Add button ID

  var x = 1; //initlal text box count
  $(add_button).click(function(e) { //on add input button click
    e.preventDefault();
    var length = wrapper.find("input:text.textAdded").length;

    if (x < max_fields) { //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div class="col-md-10 form-group" id="hhh'+ x++ +'"><input maxlength="40"  placeholder="Apenas um e-mail" type="text" id="" class="form-control" name="email' + (x++) + '"></div><div class="col-md-2 form-group"><button onclick="RemoveTableRow('+ x++ +')" class="btn btn-danger remove_field"><i class="fa fa-minus"></i> Remove</button></div>'); //add input box
    }
    //Fazendo com que cada uma escreva seu name
    wrapper.find("input:text").each(function() {
      //$(this).val($(this).attr('name'))
    });
  });

  $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove();
    x = (x-2);
  })
});
function at(){
location.reload();
}
 </script>

<script type="text/javascript" language="javascript">
function RemoveTableRow(item) {
   var cor = (item - 2);
   var el = document.getElementById('hhh'+cor);
   el.parentNode.removeChild( el );	
}
    function funcao()
    {
        alert("Atendimento encerrado com sucesso");
    }
    function mostrarResultado(box, num_max, campospan) {
        var contagem_carac = box.length;
        if (contagem_carac != 0) {
            document.getElementById(campospan).innerHTML = contagem_carac + " Caracteres digitados";
            if (contagem_carac == 1) {
                document.getElementById(campospan).innerHTML = contagem_carac + " Caracter digitado";
            }
            if (contagem_carac >= num_max) {
                document.getElementById(campospan).innerHTML = "Desculpe mas, foi atingido a limite máximo de caracteres!";
            }
        } else {
            document.getElementById(campospan).innerHTML = "Ainda não temos nada digitado..";
        }
    }

    function contarCaracteres(box, valor, campospan) {
        var conta = valor - box.length;
        document.getElementById(campospan).innerHTML = "Você ainda pode digitar " + conta + ", caracteres";
        if (box.length >= valor) {
            document.getElementById(campospan).innerHTML = "Você já digitou 500 caracteres.";
            document.getElementById("desc").value = document.getElementById("desc").value.substr(0, valor);
        }
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
<!-- /.row -->
</div>
<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>


<!--**********************-->
</div><!-- contentpanel fim geral-->

</div><!-- mainpanel -->



</section>
<!-- Modal envia e-mails -->
<div class="modal fade" id="modal_posse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:460px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">
                <form method="post" action="<?= base_url(); ?>cadastrar/criacao_de_interacao">
                    <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_beneficiario']->id_atend; ?>">
                    <input type="hidden" name="atender" value="posse">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Atribuir Posse</h4>
                    </div>

                    <div class="modal-body">

                        <div id="msgUsu2"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>SELECIONE UM USUÁRIO</label>
                                <select class="form-control" name="analistas" style="font-size: 15px;" >
                                    <option value="">--</option>
                                        <?php foreach ($dados_geral['dados_analistas'] as $va) { ?>
                                        <?php if($va->login == 'admin'){?>
                                        <?php }else{ ?>
                                        <option value="<?php echo $va->id; ?>"><?php echo $va->nome; ?> &nbsp;--&nbsp;<?php echo $va->email; ?></option>
                                        <?php } }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-9">
                                <button style="float: right;" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</button>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" onclick="disparaEmail();" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> ATRIBUIR</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->
<!--Função para validar numeros e cpf, telefone-->
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
<script type="text/javascript">//(aa) 0000-0000
    function masktel(el)
    {
        vCampos(el, /[^0-9\)\(\/-]/g);
        var e = $(el).val();
        if (e.length == 0)
            $(el).val(e + '(');
        if (e.length == 3)
            $(el).val(e + ')');
        if (e.length == 8)
            $(el).val(e + '-');
    }
</script>
<script type="text/javascript">//(00)90000-0000
    function maskcel(el)
    {
        vCampos(el, /[^0-9\)\(\/-]/g);
        var e = $(el).val();
        if (e.length == 0)
            $(el).val(e + '(');
        if (e.length == 3)
            $(el).val(e + ')');
        if (e.length == 9)
            $(el).val(e + '-');
    }
</script>
<script type="text/javascript">//00000-000
    function maskCep(el)
    {
        vCampos(el, /[^0-9\)\(\/-]/g);
        var e = $(el).val();
        if (e.length == 5)
            $(el).val(e + '-');
    }
</script>
<script type="text/javascript">//00000-000
    function maskNumero(el)
    {
        vCampos(el, /[^0-9\)\(\/-]/g);
        var e = $(el).val();
        if (e.length == 10)
            $(el).val(e + );
    }
</script>
<script type="text/javascript">//(00)90000-0000 //00.000.000.000/
    function maskCnpj(el)
    {
        vCampos(el, /[^0-9\.\.\/-]/g);
        var e = $(el).val();
        if (e.length == 2)
            $(el).val(e + '.');
        if (e.length == 6)
            $(el).val(e + '.');
        if (e.length == 10)
            $(el).val(e + '/');
        if (e.length == 15)
            $(el).val(e + '-');
    }
</script>
<script type="text/javascript">//(00)90000-0000 //00.000.000.000/
    function maskCpf(el)
    {
        vCampos(el, /[^0-9\.\.\/-]/g);
        var e = $(el).val();
        if (e.length == 3)
            $(el).val(e + '.');
        if (e.length == 7)
            $(el).val(e + '.');
        if (e.length == 11)
            $(el).val(e + '-');
    }
</script>
<script type="text/javascript">//(00)90000-0000 //00.000.000.000/
    function maskRg(el)
    {
        vCampos(el, /[^0-9\.\.\/-]/g);
        var e = $(el).val();
        if (e.length == 2)
            $(el).val(e + '.');
        if (e.length == 6)
            $(el).val(e + '.');
        if (e.length == 10)
            $(el).val(e + '-');
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

