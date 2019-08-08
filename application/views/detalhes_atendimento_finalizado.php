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
                    <h3 class="page-header">SOLICITAÇÃO FINALIZADA</h3>
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
                                <button disabled=""  class="btn btn-success xs btn-mini" type="submit" name="atender" value="posse"><i class="fa fa-check-circle" aria-hidden="true"></i> POSSE</button>
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
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="nome">
                        </div>
                        <div class="col-md-4">
                            <label for="titular">TITULAR</label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="nome">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-2">
                            <label for="tipo">TIPO</label>
                            <select class="form-control campos_form" name="tipo" disabled="">
                                <option value="<?php echo $dados_geral['dados_beneficiario']->tipo; ?>"><?php echo $dados_geral['dados_beneficiario']->tipo; ?></option>
                                <option value="Consulta">CONSULTA</option>
                                <option value="Exame">EXAME</option>
                                <option value="TERAPIAS">TERAPIAS</option>
                                <option value="INTERNAÇÃO">INTERNAÇÃO</option>
                                <option value="OUTROS">OUTROS</option>
                            </select>
                        </div>  
                        <div class="col-md-2">
                            <label for="status">STATUS</label>
                            <select class="form-control campos_form" name="status" disabled="">
                                <option value="<?php echo $dados_geral['dados_beneficiario']->status; ?>"><?php echo $dados_geral['dados_beneficiario']->status; ?></option>
                                <option value="ANÁLISE NA OPERADORA">ANÁLISE NA OPERADORA</option>
                                <option value="PAGO">PAGO</option>
                                <option value="NEGADO">NEGADO</option>
                                <option value="PENDÊNCIA">PENDÊNCIA</option>
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
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_plano; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="plano">
                        </div>
<?php if ($dados_geral['dados_beneficiario']->categoria == 'REEMBOLSO') { ?>
                            <div class="col-md-2">
                                <label for="Data">DATA RECIBO</label>
                                <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->dta_recibo; ?>" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="data_recibo" placeholder="xx/xx/xxxx">
                            </div>  
                            <div class="col-md-2">
                                <label for="Data">DATA REEMBOLSO</label>
                                <input disabled="" type="date" style="height: 30px;" value="<?php echo $dados_geral['dados_beneficiario']->dta_reembolso; ?>" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="data_reembolso" placeholder="xx/xx/xxxx">
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="Data">INI/PROC/OPERADORA</label>
                                <input disabled="" type="date" style="height: 30px;" value="<?php echo $dados_geral['dados_beneficiario']->ini_pro_operadora; ?>" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="ini_pro_operadora" value="" placeholder="xx/xx/xxxx">
                            </div> 
                            <div class="col-md-2">
                                <label for="vlrecibo">VALOR RECIBO</label>
                                <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->valor_recibo; ?>" class="form-control campos_form dinheiro" name="vlrecibo" placeholder="R$">
                            </div>  
                            <div class="col-md-2">
                                <label for="vlrecibo">VALOR REEMBOLSO</label>
                                <input type="text" disabled="" value="<?php echo $dados_geral['dados_beneficiario']->valor_reembolso; ?>" class="form-control campos_form dinheiro" name="vlrembolso" placeholder="R$">
                            </div>
                            <div class="col-md-2">
                                <label for="vlrecibo">PREV. PAGAMENTO</label>
                                <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->prev_retorno; ?>" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="prevpagamento" placeholder="xx/xx/xxxx">
                            </div>
                            <div class="col-md-4">
                                <label for="plano">FINALIZADO POR</label>
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
                            <label for="plano">FINALIZADO POR</label>
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
                <div class="col-md-12">
                    <label for="observacao">RESOLUÇÃO DO ATENDIMENTO</label>
                    <textarea disabled="" class="form-control campos_form" rows="4" minlength="6" cols="1" name="resolucao" id="obs"><?php echo $dados_geral['dados_beneficiario']->resolucao; ?></textarea>
                    <span id="sprestante" class="badge"></span>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="row" style="margin-top: 5%;">
                <div class="col-md-12" style="background-color: #f4f2f2;">
                    <h4>COMPLEMENTO DOS ANDAMENTOS</h4>
                </div>
            </div>
            <?php
            $session_logado = $this->session->userdata('logado');
            if ($session_logado[0]->tipo_acesso == 'Colaborador') {
                ?>
                <div class="row">
                    <div class="col-md-4">

                        <div class="col-md-6">
                            <label for="Data">PREV. RETORNO</label>
                            <input type="hidden" name="data_abertura" value="<?php echo date('d/m/Y', strtotime($dados_geral['dados_beneficiario']->data_inicio)); ?>">
                            <input disabled="" required="" id="prev_retorno" type="date" style="height: 30px;" placeholder="xx/xx/xxxx" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="prev_retorno" >
                        </div> 

                        <div class="row">
                            <!--    <div class="col-md-2">
                                    <label for="Data">DATA/INÍ.</label>
                                    <input id="dta_ini" type="text" placeholder="xx/xx/xxxx" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="data_status" value="" >
                                </div> -->
                        </div>
                        <!-- <div class="row"  style="margin-top: 30%;">
                             <div class="col-md-10">
                                 <button type="button" id="andamento" name="andamento" class="btn btn-warning"> <i class="fa fa-check-circle" aria-hidden="true"></i> INCLUIR ANDAMENTO</button>
                             </div>
                         </div>-->
                    </div>
                    <div class="col-md-8">

                        <label for="observacao">OBSERVAÇÃO</label>
                        <textarea disabled="" class="form-control campos_form" rows="4" minlength="10" cols="1" name="observacao" id="obs" placeholder="Descreva a dúvida ou problema com no mínimo 10 caracteres" required data-error="Por favor, informe a descrição do chamado" onkeyup="mostrarResultado(this.value, 500, 'spcontando');maiuscula(this);contarCaracteres(this.value, 500, 'sprestante')"></textarea>
                        <span id="spcontando" class="badge">Mínimo de 10 caracteres...</span><br />
                        <span id="sprestante" class="badge"></span>
                        <div class="help-block with-errors"></div>

                    </div>
                </div>
                <div class="col-md-6">   
                    <br />
                    <label>INSERIR INTERAÇÃO</label><br />
                    <button disabled=""  type = "submit" value="interacao" style="float: left;" name = "interacao" class = "btn btn-info">INTERAÇÃO</button>                    
                </div>
<?php } ?>
            </form>
        </div>
        <div class="col-md-12" style="margin-bottom: 5%;">
            <legend class="legend">ANDAMENTOS</legend>
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
               <!-- <input type="hidden" name="url" value="<?php //echo $url;   ?>">-->
                <input type="hidden" id="id_beneficiario" name="id_chamado" value="<?php echo $dados_geral['dados_beneficiario']->id_atend; ?>">
                <?php
                $session_logado = $this->session->userdata('logado');
                if ($session_logado[0]->tipo_acesso == 'Colaborador') {
                    ?>
                    <div class="col-md-12">   
                        <br />
                        <?php
                        $session_logado = $this->session->userdata('logado');
                        $user_logado = $session_logado[0]->id;
                        if ($dados_geral['dados_beneficiario']->analista == $user_logado) {
                            ?>
                            <button disabled="" onclick="funcao()" type = "submit" style="float: right;" name = "btn_abcham" class = "btn btn-danger" onclick="redirecionar();"><i class="fa fa-check-circle" aria-hidden="true"></i> FINALIZAR</button>                      
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

