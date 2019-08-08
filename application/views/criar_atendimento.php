<?php date_default_timezone_set('America/Sao_Paulo'); ?>

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

                <div class="col-lg-12">
                    <h3 class="page-header">CRIAR SOLICITAÇÃO
                    </h3>
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
                <form action="<?= base_url(); ?>cadastrar/criacao_de_atendimento" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nome">NOME BENEFICIÁRIO / SOLICITANTE </label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['nome_do_solicitante']; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="">
                        </div>
                        <div class="col-md-4">
                            <label for="titular">TITULAR</label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-2">
                            <label for="Empresa">EMPRESA</label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_cliente; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="cliente">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-2">
                            <label for="plano">PLANO</label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_plano; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="plano">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5%;">
                        <div class="col-md-12" style="background-color: #f4f2f2;">
                            <h4>COMPLEMENTO DOS ANDAMENTOS</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div style="float: right;" class="col-md-4">
<!--
                            <div class="col-md-7">
                                <label for="Data">PREV. RETORNO</label>
                                <input id="prev_retorno" type="date" style="height: 30px;" placeholder="xx/xx/xxxx" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="data_prev_ret" value="" >
                            </div> -->
                        </div>
                    </div>
                     <div class="col-md-6">   
                        <br />
                       <!-- <input type = "file" style="float: left;" name = "thumb" class = "btn btn-info"> -->                    
                    </div>
                    <div class="col-md-6">   
                        <br />
                        <button style="float: right;" title="ENVIAR E-MAILS" id="teste" type="button" class="btn btn-xs btn-success btn-mini" data-toggle="modal" data-target="#modal_emails" 
                                                    data-whatever_id_beneficiario="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>"
                                                    data-whatever_id_atend="<?php //echo $result->id_atend; ?>"
                                                    data-whatever_tipo="tipo"
                                                    class="btn btn-success "><i class="fa fa-check-circle" aria-hidden="true"></i> CONTINUAR 
                       </button>                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" language="javascript">
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
<div class="modal fade" id="modal_emails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">   
            <form action="<?= base_url(); ?>cadastrar/criacao_de_atendimento" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">               
            <!-- <input type="hidden" name="url" value="<?php //echo $url; ?>">-->
                    <input type="hidden" id="id_beneficiario" name="id_beneficiario" value="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>">
                    <input type="hidden" value="<?php echo $dados_geral['nome_do_solicitante']; ?>" name="nome_solicitante">
                   <input type="hidden" value="<?php echo $dados_geral['dados_beneficiario']->benef_email; ?>" name="email">
                   <input type="hidden" value="<?php echo $dados_geral['categoria']; ?>" name="atendimento_tipo">
                   <input type="hidden" value="<?php echo $dados_geral['dados_beneficiario']->nome_plano; ?>" name="plano_nome"> 
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">CONTINUIDADE DO ATENDIMENTO</h4>
                    </div>

                    <div class="modal-body">

                        <div id="msgUsu2"></div>

                        <div class="row">
          <?php if ($dados_geral['categoria'] == 'REEMBOLSO') { ?>
                   <div class="row">
                        <input type="hidden" value="REEMBOLSO" name="categoria">
                        <div class="col-md-3">
                            <label for="tipo">TIPO</label>
                            <select class="form-control campos_form" name="tipo" required="" id="tipo">
                                <option value="" selected="">--</option>
                                <option value="CONSULTA" selected="">CONSULTA</option>
                                <option value="EXAME" selected="">EXAME</option>
                                <option value="TERAPIAS" selected="">TERAPIAS</option>
                                <option value="TERAPIAS" selected="">INTERNAÇÃO</option>
                                <option value="OUTROS" selected="">OUTROS</option>
                            </select>
                        </div> 
                        <div class="col-md-4">
                            <label for="status">STATUS</label>
                            <select class="form-control campos_form" name="status" required="">
                                <option value="">--</option>
                                <option value="ANÁLISE NA OPERADORA" selected="">ANÁLISE NA OPERADORA</option>
                                <option value="PAGO">PAGO</option>
                                <option value="NEGADO">NEGADO</option>
                                <option value="PENDÊNCIA">PENDÊNCIA</option>
                            </select>
                        </div>
                          <div class="col-md-3">
                                <label for="Data">*DATA RECIBO</label>
                                <input required="" type="text" style="height: 30px;" maxlength="10" id="dtarecibo" class="form-control campos_form" name="data_recibo" value="<?php echo date('d/m/Y');?>" placeholder="xx/xx/xxxx">
                            </div> 
                            <div class="col-md-2">
                                <label for="Data">*OPERADORA</label>
                                <input required="" type="text" style="height: 30px;" maxlength="10" id="dtaoperadora" class="form-control campos_form" name="ini_pro_operadora" value="" placeholder="xx/xx/xxxx">
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="vlrecibo">*VALOR RECIBO</label>
                                <input required="" type="text" class="form-control campos_form dinheiro" name="vlrecibo" value="" placeholder="R$">
                            </div> 
                            
                            <div class="col-md-2" style="width: 170px;">
                                <label for="vlrecibo">*PREV.PGTO</label>
                                <input required="" id="prevpagamento" type="text" class="form-control campos_form" name="prevpagamento" value="" placeholder="xx/xx/xxxx">
                            </div>
                            <div class="col-md-7">
                                <label for="vlrecibo">NOME DO PRESTADOR</label>
                                <input type="text" onkeyup="maiuscula(this);" class="form-control campos_form" name="nome_prestador">
                            </div>
                            <div class="col-md-3" style="width: 170px;">
                              <label for="vlrecibo">DOC.</label>
                              <select  class="form-control campos_form" name="documento">
                                  <option value="RECIBO">RECIBO</option>
                                   <option value="NOTA FISCAL">NOTA FISCAL</option>
                              </select> 
                            </div>
                        </div>
                        <?php }else{ ?>
                       <div class="row">
                        <input type="hidden" value="OUTROS ATENDIMENTOS" name="categoria">
                         <div class="col-md-3">
                            <label for="tipo">TIPO</label>
                            <select class="form-control campos_form" name="tipo" required="">
                                <option value="" selected="">--</option>
                                <option value="2º VIA DA CARTEIRINHA" selected="">2º VIA DA CARTEIRINHA</option>
                                <option value="INCLUSAO" selected="">INCLUSAO</option>
                                <option value="EXCLUSÃO" selected="">EXCLUSÃO</option>
                                <option value="ALTERAÇÃO" selected="">ALTERAÇÃO</option>
                                <option value="EXTENSÃO" selected="">EXTENSÃO</option>
                                <option value="DÚVIDAS" selected="">DÚVIDAS</option>
                                <option value="FATURAMENTO" selected="">FATURAMENTO</option>
                                <option value="OUTROS" selected="">OUTROS</option>
                            </select>
                        </div> 
                        <div class="col-md-3">
                            <label for="status">STATUS</label>
                            <select class="form-control campos_form" name="status" required="">
                                <option value="">--</option>
                                <option value="ABERTO" selected="">ABERTO</option>
                                <option value="ANÁLISE  NA OPERADORA">ANÁLISE  NA OPERADORA</option>
                                <option value="CONCLUÍDO">CONCLUÍDO</option>
                            </select>
                        </div> 
                        <div class="col-md-6">
                                <label for="vlrecibo">NOME DO PRESTADOR</label>
                                <input type="text" onkeyup="maiuscula(this);" class="form-control campos_form" name="nome_prestador">
                         </div>
                       </div>
                        <?php } ?>
                        <div class="row">
                        <div class="col-md-12">
                            <label for="observacao">OBSERVAÇÃO</label>
                            <textarea class="form-control campos_form" rows="3" minlength="10" cols="1" name="observacao" id="obs" placeholder="Descreva a dúvida ou problema com no mínimo 10 caracteres" required data-error="Por favor, informe a descrição do chamado" onkeyup="mostrarResultado(this.value, 500, 'spcontando');maiuscula(this);contarCaracteres(this.value, 500, 'sprestante')"></textarea>
                            <span id="spcontando" class="badge">Mínimo de 10 caracteres...</span><br />
                            <span id="sprestante" class="badge"></span>
                            <div class="help-block with-errors"></div>

                        </div>
                            <div class="col-md-12">
                                <label>SELECIONE UM COLABORADOR (Atribuir posse)</label>
                                <select class="form-control" name="analistas" style="font-size: 15px;">
                                    <option value="">--</option>
                                        <?php foreach ($dados_geral['dados_analistas'] as $va) { ?>
                                        <?php if($va->login == 'admin'){?>
                                        <?php }else{ ?>
                                        <option value="<?php echo $va->id; ?>"><?php echo $va->nome; ?> &nbsp;--&nbsp;<?php echo $va->email; ?></option>
                                        <?php } }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 2%;">
                            <div class="table-responsive">
                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>E-MAIL (Beneficiário)</th>
                                        </tr>

                                    </thead>
                                    <tbody id="mail_resultado_beneficiario"> 
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="col-md-6" style="margin-top: 2%;">
                            <div class="table-responsive">
                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>CÓPIAS</th>
                                        </tr>

                                    </thead>
                                    <tbody> 
                                        <tr>
                                            <td><input style='background-color: #ffff99; border: 1;' type="text" name="email_opcional1" class="form-control" placeholder="CÓPIA 1º" id=""></td>
                                        </tr>
                                        <tr>
                                            <td><input style='background-color: #ffff99; border: 1;' type="text" name="email_opcional2" class="form-control" placeholder="CÓPIA 2º" id=""></td>
                                        </tr>
                                        <tr>
                                            <td><input style='background-color: #ffff99; border: 1;' type="text" name="email_opcional3" class="form-control" placeholder="CÓPIA 3º" id=""></td>
                                        </tr>
                                        <tr>
                                            <td><input style='background-color: #ffff99; border: 1;' type="text" name="email_opcional4" class="form-control" placeholder="CÓPIA 4º" id=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>                       
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-10" style="margin-left: -2%;">
                                <button style="float: right;" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</button>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" onclick="disparaEmail();" class="btn btn-success"><i class="fa fa-envelope" aria-hidden="true"></i> CONTINUAR</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->

<script type="text/javascript">
    $(document).ready(function () {
        $("#prevpagamento").mask("99/99/9999");
        $("#prevpagamento").datepicker({
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
        
         $("#dtarecibo").mask("99/99/9999");
        $("#dtarecibo").datepicker({
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
        
        
          $("#dtaoperadora").mask("99/99/9999");
        $("#dtaoperadora").datepicker({
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
 $('#modal_emails').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var whatever_id_beneficiario = button.data('whatever_id_beneficiario') // Extract info from data-* attributes
        
        var modal = $(this)
        //  modal.find('.modal-title').text('ID do Dependente: ' + whatever_id)
        modal.find('#id_beneficiario').val(whatever_id_beneficiario)        

        //pega email funcionario
        $.post(base_url + 'Ajax/getEmailsChamadoBeneficiario', {
            id_beneficiario: whatever_id_beneficiario
        }, function (data) {
          //  console.log(data); 
            $('#mail_resultado_beneficiario').html(data);
        });
        
    })

</script>
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