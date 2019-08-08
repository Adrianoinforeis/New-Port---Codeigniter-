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
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_beneficiario?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input type="hidden" name="id_beneficiario" value="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nome">Nome do segurado / Paciente </label>
                            <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="nome">
                        </div>
                        <div class="col-md-4">
                            <label for="titular">Titular</label>
                             <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="nome">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-2">
                            <label for="tipo">Tipo</label>
                            <select class="form-control campos_form" name="tipo">
                                <option value="Consulta" selected="">CONSULTA</option>
                                <option value="Exame" selected="">EXAME</option>
                                <option value="Medicamento" selected="">MEDICAMENTO</option>
                                <option value="Exterior" selected="">EXTERIOR</option>
                            </select>
                        </div>  
                        <div class="col-md-2">
                            <label for="status">Status</label>
                            <select class="form-control campos_form" name="status">
                                <option value="">--</option>
                                <option value="EM ANDAMENTO" selected="">EM ANDAMENTO</option>
                            </select>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Carteirinha">Carteirinha</label>
                             <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->carteirinha; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="carteirninha">
                        </div>
                        <?php if ($dados_geral['categoria'] == 'REEMBOLSO') { ?>
                            <div class="col-md-4">
                            <?php } else { ?>
                                <div class="col-md-3">
                                <?php } ?>
                                <label for="Empresa">Empresa</label>
                                <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_cliente; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="cliente">
                                <div class="help-block with-errors"></div>
                            </div>
                            <?php if ($dados_geral['categoria'] == 'REEMBOLSO') { ?>
                                <div class="col-md-2">
                                    <label for="Data">Data Recibo</label>
                                    <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="data_recibo" value="" >
                                </div>  
                                <div class="col-md-2">
                                    <label for="Data">Data Reembolso</label>
                                    <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="data_reembolso" value="" >
                                </div> 

                            </div>
                            <div class="row">
                            <?php } ?>
                            <div class="col-md-3">
                                <label for="plano">Plano</label>
                                <input disabled="" type="text" value="<?php echo $dados_geral['dados_beneficiario']->nome_plano; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="plano">
                            </div>
                            <?php if ($dados_geral['categoria'] == 'REEMBOLSO') { ?>
                                <div class="col-md-3">
                                <?php } else { ?>
                                    <div class="col-md-2">
                                    <?php } ?>
                                    <label for="operadora">Operadora</label>
                                    <input disabled="" type="text" value="<?php //echo $dados_geral['dados_beneficiario']->nome_op; ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="operadora">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <?php if ($dados_geral['categoria'] == 'REEMBOLSO') { ?>
                                    <div class="col-md-2">
                                        <label for="Data">Iní/Proc/Operadora</label>
                                        <input maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" class="form-control campos_form" name="data_reembolso" value="">
                                    </div> 
                                    <div class="col-md-2">
                                        <label for="vlrecibo">Valor Recibo</label>
                                        <input type="text" class="form-control campos_form" name="vlrecibo" value="" placeholder="R$">
                                    </div>  
                                    <div class="col-md-2">
                                        <label for="vlrecibo">Valor Reembolso</label>
                                        <input type="text" class="form-control campos_form" name="vlrembolso" value="" placeholder="R$">
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row" style="margin-top: 5%;">
                                <div class="col-md-12" style="background-color: #f4f2f2;">
                                    <h4>Complemento de Andamento</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="operadora">Status</label>
                                    <select class="form-control campos_form" name="status">
                                        <option value="AGUARDANDO DOCUMENTAÇÃO" selected="">AGUARDANDO DOCUMENTAÇÃO</option>
                                        <option value="APROVADO" >APROVADO</option>
                                        <option value="NÃO AUTORIZADO" >NÃO AUTORIZADO</option>
                                        <option value="EM ANÁLISE" >EM ANÁLISE</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="Data">Prev.Retorno</label>
                                    <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="data_prev_ret" value="" >
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="Data">Data</label>
                                    <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="data_status" value="" >
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 1%; float: right;">
                                    <button type="submit" id="thumb" name="thumb" class="btn btn-warning"> <i class="fa fa-check-circle" aria-hidden="true"></i> Incluir Andamento</button>
                                </div>
                            </div>
                            <div class="col-md-9" style="margin-left: 25%; margin-top: -18%;">
                                <label for="desc">Observações</label>
                                <textarea class="form-control campos_form" rows="8" minlength="10" cols="1" name="desc" id="desc" placeholder="Descreva a dúvida ou problema com no mínimo 10 caracteres" required data-error="Por favor, informe a descrição do chamado" onkeyup="mostrarResultado(this.value, 500, 'spcontando');contarCaracteres(this.value, 500, 'sprestante')"></textarea>
                                <span id="spcontando" class="badge">Mínimo de 10 caracteres...</span><br />
                                <span id="sprestante" class="badge"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">   
                        <br />
                        <button type = "submit" style="float: right;" name = "btn_abcham" class = "btn btn-success" onclick="redirecionar();"><i class="fa fa-check-circle" aria-hidden="true"></i> Gravar</button>                      
                    </div>
                </form>
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


