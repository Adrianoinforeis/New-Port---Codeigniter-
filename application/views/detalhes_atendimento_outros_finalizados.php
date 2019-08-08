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

                <div class="col-md-6">
                    <h3 class="page-header">DETALHES DA SOLICITAÇÃO </h3>
                </div>
                <div class="col-md-6">
                    <form style="margin-top: 7%;" action="<?= base_url(); ?>cadastrar/criacao_de_interacao_outros" method="post" >
                        <?php
                        $session_logado = $this->session->userdata('logado');
                        if ($session_logado[0]->tipo_acesso == 'Colaborador') {
                            ?>
                            <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_atendimento']->id_atend; ?>">
                            <?php if ($dados_geral['dados_atendimento']->analista != null) { ?>
                                <button disabled="" class="btn btn-success xs btn-mini" type="submit" name="atender" value="posse"><i class="fa fa-check-circle" aria-hidden="true"></i> POSSE</button>
                            <?php } else { ?>
                                <button disabled=""  class="btn btn-success xs btn-mini" type="button" name="atender" value="posse" data-toggle="modal" data-target="#modal_posse" ><i class="fa fa-check-circle" aria-hidden="true"></i> POSSE</button>
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
                <form action="<?= base_url(); ?>cadastrar/criacao_de_interacao_outros" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                   <!-- <input type="hidden" name="url" value="<?php //echo $url;     ?>">-->
                    <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_atendimento']->id_atend; ?>">
                    <input type="hidden" value="<?php echo $dados_geral['dados_atendimento']->nome_atendimento; ?>" name="nome_solicitante">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nome">NOME SOLICITANTE </label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_atendimento']->nome_atendimento; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="nome">
                        </div>
                        <div class="col-md-2">
                            <label for="tipo">TIPO</label>
                            <select class="form-control campos_form" name="tipo" disabled="">
                                <option value="<?php echo $dados_geral['dados_atendimento']->tipo; ?>"><?php echo $dados_geral['dados_atendimento']->tipo; ?></option>
                                <option value="Consulta">CONSULTA</option>
                                <option value="Exame">EXAME</option>
                                <option value="TERAPIAS">TERAPIAS</option>
                                <option value="INTERNAÇÃO">INTERNAÇÃO</option>
                                <option value="OUTROS">OUTROS</option>
                            </select>
                        </div>  
                        <div class="col-md-2">
                            <label for="status">STATUS</label>
                            <select disabled=""  class="form-control campos_form" name="status" required="">
                                <option value="<?php echo $dados_geral['dados_atendimento']->status; ?>"><?php echo $dados_geral['dados_atendimento']->status; ?></option>
                                <option value="EM ANÁLISE">EM ANÁLISE</option>
                                <option value="OUTROS">OUTROS</option>
                            </select>
                        </div> 
                        <div class="col-md-4">
                            <label for="plano">EM POSSE</label>
                            <input type="hidden" value="<?php echo $dados_geral['dados_atendimento']->analista; ?>" name="analista_posse">
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_atendimento']->nome_analista; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="analista">
                        </div>
                        <div class="col-md-12">
                            <label for="desc">SOLICITAÇÃO</label>
                            <textarea disabled="" class="form-control campos_form" rows="" minlength="10" cols="1" name="obschamado"><?php echo $dados_geral['dados_atendimento']->obs; ?></textarea>
                        </div>
                    <div class="col-md-8">
                        <label for="observacao">RESOLUÇÃO DO ATENDIMENTO</label>
                        <textarea disabled=""  class="form-control campos_form" rows="4" minlength="6" cols="1" name="resolucao" id="obs" placeholder="Informe a resolução do atendimento" data-error="Por favor, informe a descrição do chamado" onkeyup="mostrarResultado(this.value, 500, 'spcontando');maiuscula(this);contarCaracteres(this.value, 500, 'sprestante')"><?php echo $dados_geral['dados_atendimento']->resolucao; ?></textarea>
                        <span id="spcontando" class="badge">Mínimo de 10 caracteres...</span><br />
                        <span id="sprestante" class="badge"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <?php
                        $session_logado = $this->session->userdata('logado');
                        $user_logado = $session_logado[0]->id;
                        if ($dados_geral['dados_atendimento']->analista == $user_logado && ($dados_geral['dados_atendimento']->andamento != 'FINALIZADO')) {
                            ?>
                            <button name="dados" value="dados" disabled=""  style="float: left;" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR DADOS</button>
                        <?php } else if ($dados_geral['dados_atendimento']->analista == $user_logado && $dados_geral['dados_atendimento']->andamento == 'EM ATENDIMENTO') { ?>
                            <button name="dados" value="dados" disabled=""  style="float: left;" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR DADOS</button>
                        <?php } else if ($dados_geral['dados_atendimento']->andamento == 'ABERTO') { ?>
                            <button name="dados" value="dados" disabled=""  style="float: left;" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR DADOS</button>
                        <?php } else { ?>
                            <button style="float: right;" disabled="" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR DADOS</button>
                        <?php } ?>
                    </div>
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
                    <input type="hidden" name="data_abertura" value="<?php //echo date('d/m/Y', strtotime($dados_geral['dados_beneficiario']->data_inicio));   ?>">
                    <input required="" value="<?php echo date('d/m/Y H:i:s'); ?>" id="prev_retorno" type="date" style="height: 30px;" placeholder="xx/xx/xxxx" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="prev_retorno" >
                </div> 
                <div class="col-md-4">   
                    <label>INSERIR INTERAÇÃO</label><br />
                    <button disabled=""  type = "submit" value="interacao" style="float: left;" name = "interacao" class = "btn btn-info">INTERAÇÃO</button>                    
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
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $value->prev_retorno; ?></td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $value->observacao; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div> 
            <form action="<?= base_url(); ?>cadastrar/encerramentoAtendimento" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
               <!-- <input type="hidden" name="url" value="<?php //echo $url;    ?>">-->
                <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_atendimento']->id_atend; ?>">
                <?php
                $session_logado = $this->session->userdata('logado');
                if ($session_logado[0]->tipo_acesso == 'Colaborador') {
                    ?>
                    <div class="col-md-12">   
                        <br />
                        <?php
                        $session_logado = $this->session->userdata('logado');
                        $user_logado = $session_logado[0]->id;
                        if ($dados_geral['dados_atendimento']->analista == $user_logado && ($dados_geral['dados_atendimento']->andamento != 'FINALIZADO')) {
                            ?>
                            <button disabled=""  onclick="funcao()" type = "submit" style="float: right;" name = "btn_abcham" class = "btn btn-danger" onclick="redirecionar();"><i class="fa fa-check-circle" aria-hidden="true"></i> FINALIZAR</button>                      
                        <?php } else { ?>
                            <button disabled=""  onclick="funcao()" disabled="" type = "submit" style="float: right;" name = "btn_abcham" class = "btn btn-danger" onclick="redirecionar();"><i class="fa fa-check-circle" aria-hidden="true"></i> FINALIZAR</button> 
                        <?php } ?>
                    </div>
                <?php } ?>
            </form>
        </div><!--faturamento-->
    </div>
</div>
</div>
</div>
</div>

<script type="text/javascript" language="javascript">

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
                <form method="post" action="<?= base_url(); ?>cadastrar/criacao_de_interacao_outros">
                    <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_atendimento']->id_atend; ?>">
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
                                        <?php if ($va->login == 'admin') { ?>
                                        <?php } else { ?>
                                            <option value="<?php echo $va->id; ?>"><?php echo $va->nome; ?> &nbsp;--&nbsp;<?php echo $va->email; ?></option>
                                        <?php }
                                    } ?>
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

