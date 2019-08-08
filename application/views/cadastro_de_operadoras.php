<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<div class="contentpanel"><!--Início da classe geral-->
    <div id="page-wrapper">

        <div class="container-fluid" style="background-color: #fff; margin-bottom: 10%;">

            <!-- Page Heading -->
            <div class="row">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">

                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <form style="margin-bottom: 5%;" method="post" action="<?= base_url(); ?>Cadastrar/portaria">   
                    <fieldset class="scheduler-border">
                        <div class="mostra">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" onkeyup="maiuscula(this)" placeholder="DIGITE O NOME DA OPERADORA" id="pesquisa">

                            </div>
                             <script type="text/javascript">
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
                        function maiuscula(z) {
                            v = z.value.toUpperCase();
                            z.value = v;
                        }
//FIM DA FUNÇÃO MASCARA MAIUSCULA
                    </script>
                             <script type="text/javascript">
                                function Mudarestado(el) {
                                    var display = document.getElementById(el).style.display;
                                    if (display == "none")
                                        document.getElementById(el).style.display = 'block';
                                    else
                                        document.getElementById(el).style.display = 'block';
                                }
                            </script>
                            
                            <div class="col-md-12 form-group">
                                <ul class="list-group resultado" style="list-style-type: none;" onclick="Mudarestado('minhaDiv')">
                                </ul>
                            </div>
                           
                                                        <!-- <button type="submit" value="" name="" class="btn btn-success" ><i class="fa fa-check-circle" aria-hidden="true"></i> Consultar</button>-->

                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-6" style="text-align:right;margin-bottom: 4%;">
                <a href="#" title="Inserir Operadora" class="btn btn-success" data-toggle="modal" data-target=".inserir_modal-modal-lg"><i class="fa fa-save"></i> INSERIR OPERADORA</a>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
</div><!--Fim cadastro-->
</div><!-- mainpanel -->
</section>

<!-- Modal -->
<div class="modal fade inserir_modal-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">CADASTRO DE OPERADORA</h4>
            </div>
            <div class="panel-body panel-body-nopadding">
                <div class="col-md-12" style="margin-bottom: 5%;" >
                    <style>
                        .campos_form{
                            padding: 5px;  
                        }
                    </style>
                    <?php
                    $dominio = $_SERVER['HTTP_HOST'];
                    $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                    ?>
                    <script type="text/javascript">
                        function deletar(id) {
                            if (confirm("Deseja remover esse fornecedor?")) {
                                window.location = "<?= base_url(); ?>Deletar/deletar_fornecedor?acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                                //= "cadastro_usuarios.php?acao=deletar&id=" + id;
                            }
                        }
                    </script>
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_operadoras?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">CNPJ</label>
                                            <input type="text" name="cnpj" id="cpf_cnpj" maxlength="18" onkeyup="maskCnpj(this)" onclick="maskCnpj(this)" onkeypress="maskCnpj(this)" class="form-control campos_form" data-rule-cpfcnpj="true" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">NOME FANTASIA</label>
                                            <input type="text" name="nome" id="nome" onkeyup="maiuscula(this)" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">RAZÃO SOCIAL</label>
                                            <input type="text" name="razao" id="razao" onkeyup="maiuscula(this)" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CEP</label>
                                            <div class="input-group">
                                                <input type="text" maxlength="8" onkeyup="maskCep(this)" onclick="maskCep(this)" onkeypress="maskCep(this)" class="form-control campos_form" name="cep" id="cep" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CIDADE</label>
                                            <div class="input-group">
                                                <input type="text" onkeyup="maiuscula(this)" class="form-control campos_form" name="cidade" id="cidade" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" >
                                        <div class="form-group">
                                            <label for="uf" class="control-label">UF: </label>
                                            <select class="form-control campos_form" id="uf" name="uf">
                                                <option value="AC">AC</option>
                                                <option value="AL">AL</option>
                                                <option value="AM">AM</option>
                                                <option value="AP">AP</option>
                                                <option value="BA">BA</option>
                                                <option value="CE">CE</option>
                                                <option value="DF">DF</option>
                                                <option value="ES">ES</option>
                                                <option value="GO">GO</option>
                                                <option value="MA">MA</option>
                                                <option value="MG">MG</option>
                                                <option value="MS">MS</option>
                                                <option value="MT">MT</option>
                                                <option value="PA">PA</option>
                                                <option value="PB">PB</option>
                                                <option value="PE">PE</option>
                                                <option value="PI">PI</option>
                                                <option value="PR">PR</option>
                                                <option value="RJ">RJ</option>
                                                <option value="RN">RN</option>
                                                <option value="RO">RO</option>
                                                <option value="RR">RR</option>
                                                <option value="RS">RS</option>
                                                <option value="SC">SC</option>
                                                <option value="SE">SE</option>
                                                <option value="SP" selected="">SP</option>
                                                <option value="TO">TO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">ENDEREÇO</label>
                                            <input type="text" onkeyup="maiuscula(this)" name="endereco" id="rua" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">NÚMERO</label>
                                            <input type="text" name="numero" id="numero" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="bairro" class="control-label">BAIRRO</label>
                                            <input type="text" onkeyup="maiuscula(this)" name="bairro" id="bairro" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="descricao" class="control-label">RAMO</label>
                                            <select class="campos_form form-control" id="ramo" name="ramo" required="">
                                                <option value="">--</option>
                                                <option value="SAÚDE">SAÚDE</option>
                                                <option value="VIDA">VIDA</option>
                                                <option value="ODONTO">ODONTO</option>
                                                <option value="PREVIDÊNCIA">PREVIDÊNCIA</option>
                                                <option value="VIAGEM">VIAGEM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="descricao" class="control-label">RAMO 2º</label>
                                            <select class="campos_form form-control" id="ramo" name="ramo_1">
                                                <option value="">--</option>
                                                <option value="SAÚDE">SAÚDE</option>
                                                <option value="VIDA">VIDA</option>
                                                <option value="ODONTO">ODONTO</option>
                                                <option value="PREVIDÊNCIA">PREVIDÊNCIA</option>
                                                <option value="VIAGEM">VIAGEM</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="descricao" class="control-label">RAMO 3º</label>
                                            <select class="campos_form form-control" id="ramo" name="ramo_2">
                                                <option value="">--</option>
                                                <option value="SAÚDE">SAÚDE</option>
                                                <option value="VIDA">VIDA</option>
                                                <option value="ODONTO">ODONTO</option>
                                                <option value="PREVIDÊNCIA">PREVIDÊNCIA</option>
                                                <option value="VIAGEM">VIAGEM</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="descricao" class="control-label">RAMO 4º</label>
                                            <select class="campos_form form-control" id="ramo" name="ramo_3">
                                                <option value="">--</option>
                                                <option value="SAÚDE">SAÚDE</option>
                                                <option value="VIDA">VIDA</option>
                                                <option value="ODONTO">ODONTO</option>
                                                <option value="PREVIDÊNCIA">PREVIDÊNCIA</option>
                                                <option value="VIAGEM">VIAGEM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea name="obs" id="obs" class="form-control campos_form"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button type="submit" title="Gravar" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR</button>
                        </div>
                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <button data-dismiss="modal" title="Cancelar" aria-hidden="true" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> CANCELAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" >
    $(document).ready(function () {
        // $("#cep_pesq").mask("00000000");
        // $('#telefone').mask("(00) 0000-00000");
        // $("#cpf").mask("00.000.000-00");
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function () {
            //focus no número
            //document.getElementById("numero").focus();

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro.toUpperCase());
                            $("#bairro").val(dados.bairro.toUpperCase());
                            $("#cidade").val(dados.localidade.toUpperCase());
                            $("#uf").val(dados.uf.toUpperCase());
                            $("#ibge").val(dados.ibge);
                            document.getElementById('numero').focus();

                            $("#rua").removeAttr('readonly');
                            $("#bairro").removeAttr('readonly');
                            $("#cidade").removeAttr('readonly');
                            $("#uf").removeAttr('readonly');
                            $("#ibge").removeAttr('readonly');
                            $("#numero").removeAttr('readonly');
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });
</script>
<!-- Modal -->
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
            $(el).val(e + '');
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
<script type="text/javascript">
    //pesquisa socio por nome
    var base_url = "<?php echo base_url(); ?>"
    $("#pesquisa").keyup(function () {
        var pesquisa = $(this).val();

        //verifica se tem algo digitado
        // $('.resultado').attr('disabled', 'disabled');
        if (pesquisa != '') {
            var dados = {
                palavra: pesquisa
            }
            $.post(base_url + 'Ajax/getOperadoras', dados, function (retorna) {
                //mostra dentro da ul os resultados obtidos
                $(".resultado").html(retorna);
                //$('.resultado').removeAttr('disabled');
            });
        } else {
            $(".resultado").html('');
        }
    });
</script>