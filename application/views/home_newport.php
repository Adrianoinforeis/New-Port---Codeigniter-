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
                <?php $session_logado = $this->session->userdata('logado');
                ?>
                <form action="<?= base_url(); ?>cadastrar/criacao_de_atendimento" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                    <input type="hidden" name="url" value="<?php echo $session_logado[0]->nome ?>">
                    <input type="hidden" value="<?php echo $session_logado[0]->nome ?>" name="nome_solicitante">
                    <input type="hidden" id="id_beneficiario" name="id_beneficiario" value="<?php echo $session_logado[0]->id_beneficiario ?>">
                    <input type="hidden" value="OUTROS ATENDIMENTOS" name="categoria">
                    <input type="hidden" value="ABERTO" name="status">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nome">NOME BENEFICIÁRIO / SOLICITANTE </label>
                            <input disabled="" type="text" value="<?php echo $session_logado[0]->nome ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="nome">
                        </div>
                        <div class="col-md-4">
                            <label for="Empresa">EMPRESA</label>
                            <input disabled="" type="text" value="<?php echo limitChars($session_logado[0]->empresa, 3);?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="cliente">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-4">
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
                                <option value="CONSULTA" selected="">CONSULTA</option>
                                <option value="EXAME" selected="">EXAME</option>
                                <option value="TERAPIAS" selected="">TERAPIAS</option>
                                <option value="TERAPIAS" selected="">INTERNAÇÃO</option>
                                <option value="OUTROS" selected="">OUTROS</option>
                            </select>
                        </div> 
                    </div>
                  <!--  <div class="row">

                        <div class="col-md-4">
                            <label for="plano">PLANO</label>
                            <input disabled="" type="text" value="<?php //echo $dados_geral['dados_beneficiario']->nome_plano;  ?>" onkeyup="maiuscula(this)" class="form-control campos_form" name="plano">
                        </div>
                        <input type="hidden" value="<?php //$dados_geral['categoria'] ?>" name="categoria">
                        <?php //if ($dados_geral['categoria'] == 'REEMBOLSO') { ?>
                        <div class="col-md-2">
                            <label for="Data">DATA RECIBO</label>
                            <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="data_recibo" value="" placeholder="xx/xx/xxxx">
                        </div>  
                        <div class="col-md-2">
                            <label for="Data">DATA REEMBOLSO</label>
                            <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="data_reembolso" value="" placeholder="xx/xx/xxxx">
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Data">INI/PROC/OPERADORA</label>
                            <input maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" class="form-control campos_form" name="ini_pro_operadora" value="" placeholder="xx/xx/xxxx">
                        </div> 
                        <div class="col-md-2">
                            <label for="vlrecibo">VALOR RECIBO</label>
                            <input type="text" class="form-control campos_form dinheiro" name="vlrecibo" value="" placeholder="R$">
                        </div>  
                        <div class="col-md-2">
                            <label for="vlrecibo">VALOR REEMBOLSO</label>
                            <input type="text" class="form-control campos_form dinheiro" name="vlrembolso" value="" placeholder="R$">
                        </div>
                        <div class="col-md-2">
                            <label for="vlrecibo">PREV. PAGAMENTO</label>
                            <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="prevpagamento" value="" placeholder="xx/xx/xxxx">
                        </div>
                    </div>-->
                    <div class="row" style="margin-top: 5%;">
                        <div class="col-md-12" style="background-color: #f4f2f2;">
                            <h4>POR GENTILEZA, DESCREVA A BAIXO A SUA SOLICITAÇÃO</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                            <div class="col-md-6">
                                <label for="Data">PREV. RETORNO</label>
                                <input value="<?php echo date('d/m/Y');?>" disabled="" type="text" placeholder="xx/xx/xxxx" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  class="form-control campos_form" name="data_prev_ret">
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

                            <label for="desc">OBSERVAÇÃO</label>
                            <textarea class="form-control campos_form" rows="8" minlength="10" cols="1" name="observacao" id="obs" placeholder="Descreva a dúvida ou problema com no mínimo 10 caracteres" required data-error="Por favor, informe a descrição do chamado" onkeyup="mostrarResultado(this.value, 500, 'spcontando');maiuscula(this);contarCaracteres(this.value, 500, 'sprestante')"></textarea>
                            <span id="spcontando" class="badge">Mínimo de 10 caracteres...</span><br />
                            <span id="sprestante" class="badge"></span>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="col-md-6">   
                        <br />
                       <input type = "file" style="float: left;" name = "thumb" class = "btn btn-info">                
                    </div>
                    <div class="col-md-6">   
                        <br />
                        <button type = "submit" style="float: right;" name = "btn_abcham" class = "btn btn-success" onclick="redirecionar();"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR</button>                      
                    </div>
                </form>
            </div>
            <!--Listando usuários-->
            <!-- <div class="col-md-12">
                 <legend class="legend">ANDAMENTOS</legend>
                 <div class="table-responsive">
                     <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                         <thead>
                             <tr>
                                 <th>STATUS</th>
                                 <th>PREV. RET</th>
                                 <th>DATA</th>
                                 <th>OBS</th>
                             </tr>
 
                         </thead>
                         <tbody> 
                         <script type="text/javascript">
                             //pesquisa socio por nome
                             var base_url = "<?php echo base_url(); ?>"
                             $(function () {
                                 $('#andamento').change(function () {
                                     var id_beneficiario = $('#id_beneficiario').val();
                                     var status = $('#status').val();
                                     var prev_retorno = $('#prev_retorno').val();
                                     var dta_ini = $('#dta_ini').val();
                                     var obs = $('#obs').val();
                                     $.post(base_url + 'Ajax/addAndamentos', {
                                         id_beneficiario: id_beneficiario,
                                         status: status,
                                         prev_retorno: prev_retorno,
                                         dta_ini: dta_ini,
                                         obs: obs,
                                     }, function (data) {
                                         //console.log(data); //imprime com f12
                                         $('#ncontratos').html(data);
                                         $('#ncontratos').removeAttr('disabled');
                                     });
                                 });
                             });
                         </script>
                         <tr>
 
                             <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $item->estipulante;         ?></td>
                             <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $item->sub_estipulante;         ?></td>
                             <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $item->empresa;         ?></td>
                             <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $item->empresa;        ?></td>
                         </tr>
            <?php
            //}
            ?>
                         </tbody>
                     </table>
                 </div> 
 
             </div> --><!--faturamento-->
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

