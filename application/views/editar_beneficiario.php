<?php date_default_timezone_set('America/Sao_Paulo'); ?>
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


 $(document).ready(function () {
        // $("#cep_pesq").mask("00000000");
        // $('#telefone').mask("(00) 0000-00000");
        // $("#cpf").mask("00.000.000-00");
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua_1").val("");
            $("#bairro_1").val("");
            $("#cidade_1").val("");
            $("#uf_1").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep_1").blur(function () {
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
                    $("#rua_1").val("...");
                    $("#bairro_1").val("...");
                    $("#cidade_1").val("...");
                    $("#uf_1").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua_1").val(dados.logradouro.toUpperCase());
                            $("#bairro_1").val(dados.bairro.toUpperCase());
                            $("#cidade_1").val(dados.localidade.toUpperCase());
                            $("#uf_1").val(dados.uf.toUpperCase());
                            $("#ibge").val(dados.ibge);
                            document.getElementById('numero').focus();

                            $("#rua_1").removeAttr('readonly');
                            $("#bairro_1").removeAttr('readonly');
                            $("#cidade_1").removeAttr('readonly');
                            $("#uf_1").removeAttr('readonly');
                            $("#ibge").removeAttr('readonly');
                            $("#numero_1").removeAttr('readonly');
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
<script type="text/javascript">
    $(document).ready(function () {
        $("a.menutoggle").trigger("click");
    });
</script>
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
            <div class="col-sm-4">
                <form style="margin-bottom: 5%;" method="post" action="">   
                    <fieldset class="scheduler-border">
                        <div class="mostra">
                            <input name="tipo" type="radio" value="Sim" checked="">
                            <label for="tipo" style="font-size: 13px;">BENEFICIÁRIO</label>

                            <input name="tipo" type="radio" value="Nao" >
                            <label for="tipo" style="font-size: 13px;">DEPENDENTE</label>
                            <div class="col-md-12 form-group" id="beneficiario">
                                <input type="text" class="form-control" onkeyup="maiuscula(this)" placeholder="DIGITE O NOME DO BENEFICIÁRIO" id="pesquisa">
                            </div>
                            <div class="col-md-12 form-group" style="display: none;" id="dependente">
                                <input type="text" onkeyup="maiuscula(this)" class="form-control" placeholder="DIGITE O NOME DO DEPENDENTE" id="pesquisa_dependente">
                            </div>  

                            <script type="text/javascript">
                                $('input[name="tipo"]').change(function () {
                                    if ($('input[name="tipo"]:checked').val() === "Sim") {
                                        $('#beneficiario').show();
                                        $('#dependente').hide();
                                        // $('.nao_socio').attr('required', 'required');
                                        //  $('.requer').removeAttr('required', 'required');
                                    } else if ($('input[name="tipo"]:checked').val() === "Nao") {
                                        $('#beneficiario').hide();
                                        $('#dependente').show();
                                    }
                                });


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
                            <script type="text/javascript">
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
                                function maiuscula(z) {
                                    v = z.value.toUpperCase();
                                    z.value = v;
                                }
//FIM DA FUNÇÃO MASCARA MAIUSCULA
                            </script>

                             <!-- <button type="submit" value="" name="" class="btn btn-success" ><i class="fa fa-check-circle" aria-hidden="true"></i> Consultar</button>-->

                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-4" style="text-align:right;margin-bottom: 4%;">
                <a href="#" title="Criar atendimento" class="btn btn-success" data-toggle="modal" data-target=".cria-chamado-modal-lg"><i class="fa fa-bars" aria-hidden="true"></i> CRIAR ATENDIMENTO</a>
            </div>
            <div class="col-sm-4" style="text-align:right;margin-bottom: 4%;">
                <a href="#" title="Inserir" class="btn btn-success" data-toggle="modal" data-target=".inserir_modal-modal-lg"><i class="fa fa-save"></i> INSERIR BENEFICIÁRIOS</a>
            </div>
            <div class="col-md-12" id="minhaDiv">
                <legend class="legend">BENEFICIÁRIO</legend>

                <div class="col-md-12" style="margin-bottom: 2%;" >
                    <style>
                        .campos_form{
                            padding: 5px;  
                        }
                    </style>
                    <?php
                    $dominio = $_SERVER['HTTP_HOST'];
                    $url_ben = "http://" . $dominio . '/Intranet/cadastro_de_funcionarios';
                    ?>
                    <?php
                    $dominio = $_SERVER['HTTP_HOST'];
                    $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                    ?>
                    <script type="text/javascript">
                        function deletar_benef(id) {
                            if (confirm("Deseja remover esse beneficiário?")) {
                                window.location = "<?= base_url(); ?>Deletar/deletar_beneficiario?acao=deletar&id=" + id + "&url=<?php echo $url_ben; ?>";
                                // = "cadastro_usuarios.php?acao=deletar&id=" + id;
                            }
                        }
                    </script>
                    <script language="javascript">
                        function CPF() {
                            "user_strict";
                            function r(r) {
                                for (var t = null, n = 0; 9 > n; ++n)
                                    t += r.toString().charAt(n) * (10 - n);
                                var i = t % 11;
                                return i = 2 > i ? 0 : 11 - i
                            }
                            function t(r) {
                                for (var t = null, n = 0; 10 > n; ++n)
                                    t += r.toString().charAt(n) * (11 - n);
                                var i = t % 11;
                                return i = 2 > i ? 0 : 11 - i
                            }
                            var n = "CPF Inválido", i = "CPF Válido";
                            this.gera = function () {
                                for (var n = "", i = 0; 9 > i; ++i)
                                    n += Math.floor(9 * Math.random()) + "";
                                var o = r(n), a = n + "-" + o + t(n + "" + o);
                                return a
                            }, this.valida = function (o) {
                                for (var a = o.replace(/\D/g, ""), u = a.substring(0, 9), f = a.substring(9, 11), v = 0; 10 > v; v++)
                                    if ("" + u + f == "" + v + v + v + v + v + v + v + v + v + v + v)
                                        return n;
                                var c = r(u), e = t(u + "" + c);
                                return f.toString() === c.toString() + e.toString() ? i : n
                            }
                        }

                        var CPF = new CPF();

                        $(document).ready(function () {
                            $("#cpf_edita").keyup(function () {
                                var teste = CPF.valida($(this).val());
                                $("#resposta_edita").html(teste);
                                if (teste == "CPF Válido") {
                                    document.getElementById('resposta_edita').style.color = 'green';
                                    //$("#cadastrar").removeAttr("disabled");
                                } else {
                                    document.getElementById('resposta_edita').style.color = 'red';
                                    // $("#cadastrar").attr("disabled", true);
                                }
                            });

                            $("#cpf_edita").blur(function () {
                                var teste = CPF.valida($(this).val());
                                $("#resposta_edita").html(teste);
                                if (teste == "CPF Válido") {
                                    document.getElementById('resposta_edita').style.color = 'green';
                                    //  $("#cadastrar").removeAttr("disabled");
                                } else {
                                    document.getElementById('resposta_edita').style.color = 'red';
                                    // $("#cadastrar").attr("disabled", true);
                                }
                            });

                        });
                        //controla a quantidade de dígitos no campo CPf
                        function limitarInput(obj) {
                            obj.value = obj.value.substring(0, 11); //Aqui eu pego o valor e só deixo o os 10 primeiros caracteres de valor no input
                        }
                    </script>
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_beneficiario?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input type="hidden" name="id_beneficiario" value="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>">
                        <div class="tab-content">
                            <?php //var_dump($dados_geral['dados_beneficiario'])?>
                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="empresa" class="control-label">NOME FANTASIA</label>
                                            <input disabled="" type="text" name="nome_ben" id="nome" class="form-control campos_form" required value="<?php echo $dados_geral['dados_beneficiario']->nome_cliente; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">NOME DO SEGURADO</label>
                                            <input onkeyup="maiuscula(this)" type="text" name="nome_ben" id="nome" class="form-control campos_form" required value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="razao" id="resposta_edita" class="control-label">CPF</label>
                                            <input type="tel" name="cpf" maxlength="11" onkeyup="maskNumeroc(this);
                                                    limitarInput(this)" onclick="maskNumeroc(this)" onkeypress="maskNumeroc(this)" id="cpf_edita" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->cpf; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">RG</label>
                                            <input type="text" name="rg" maxlength="13" onkeyup="maskRg(this)" onclick="maskRg(this)" onkeypress="maskRg(this)" id="razao" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->rg; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">DATA EMISSÃO</label>
                                            <input type="text" name="dtaEmissao" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" id="razao" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->dtaEmissao; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">ORGÃO EXPEDIDOR</label>
                                            <select class="form-control campos_form" name="orgexp" style="height: 30px;">
                                                <option value="<?php echo $dados_geral['dados_beneficiario']->orgexp; ?>"><?php echo $dados_geral['dados_beneficiario']->orgexp; ?></option>
                                                <option value="SSP">SSP - Secretaria de Segurança Pública</option>
                                                <option value="COREN">COREN - Conselho Regional de Enfermagem</option>
                                                <option value="CRA">CRA - Conselho Regional de Administração</option>
                                                <option value="CRAS">CRAS - Conselho Regional de Assistentes Sociais</option>
                                                <option value="CRB">CRB - Conselho Regional de Biblioteconomia</option>
                                                <option value="CRC">CRC - Conselho Regional de Contabilidade</option>
                                                <option value="CRE">CRE - Conselho Regional de Estatística</option>
                                                <option value="CREA">CREA - Conselho Regional de Engenharia Arquitetura e Agronomia</option>
                                                <option value="CRECI">CRECI - Conselho Regional de Corretores de Imóveis</option>
                                                <option value="CREFIT">CREFIT - Conselho Regional de Fisioterapia e Terapia Ocupacional</option>
                                                <option value="CRF">CRF - Conselho Regional de Farmácia</option>
                                                <option value="CRM">CRM - Conselho Regional de Medicina</option>
                                                <option value="CRN">CRN - Conselho Regional de Nutrição</option>
                                                <option value="CRO">CRO - Conselho Regional de Odontologia</option>
                                                <option value="CRP">CRP - Conselho Regional de Psicologia</option>
                                                <option value="CRPRE">CRPRE - Conselho Regional de Profissionais de Relações Públicas</option>
                                                <option value="CRQ">CRQ - Conselho Regional de Química</option>
                                                <option value="CRRC">CRRC - Conselho Regional de Representantes Comerciais</option>
                                                <option value="CRMV">CRMV - Conselho Regional de Medicina Veterinária</option>
                                                <option value="DPF">DPF - Polícia Federal</option>
                                                <option value="EST">EST - Documentos Estrangeiros</option>
                                                <option value="I CLA">I CLA - Carteira de Identidade Classista</option>
                                                <option value="MAE">MAE - Ministério da Aeronáutica</option>
                                                <option value="MEX">MEX - Ministério do Exército</option>
                                                <option value="MMA">MMA - Ministério da Marinha</option>
                                                <option value="OAB">OAB - Ordem dos Advogados do Brasil</option>
                                                <option value="OMB">OMB - Ordens dos Músicos do Brasil</option>
                                                <option value="IFP">IFP - Instituto de Identificação Félix Pacheco</option>
                                                <option value="OUT">OUT - Outros Emissores</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">DTA. NASC</label>
                                            <input id="editidade" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" name="dtaNascimento" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->dtaNascimento; ?>">
                                        </div>
                                    </div>
                                    <?php
                                    if ($dados_geral['dados_beneficiario']->dtaNascimento != null) {
                                        $data_nasc = $dados_geral['dados_beneficiario']->dtaNascimento;
                                    } else {
                                        $data_nasc = date("d/m/Y");
                                    }
                                    $dataP = explode('/', $data_nasc);
                                    $dataNoFormatoParaOBranco = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];
                                    $nascido = $dataNoFormatoParaOBranco . date(" H:i:s");

                                    $data_hora = date("Y-m-d H:i:s");
                                    $data1 = new DateTime($data_hora);
                                    $data2 = new DateTime($nascido);
                                    //Calcula a diferença
                                    $intervalo = $data1->diff($data2);
                                    $anos = ($intervalo->y);
                                    $meses = ($intervalo->m);
                                    $dias_d = ($intervalo->d);
                                    $multiplicames = ($meses * 30);
                                    $transformandomesemdias = ($multiplicames + $dias_d);
                                    $tempo_em_aberto = "Dias: $transformandomesemdias / Horas: &nbsp;{$intervalo->h}:{$intervalo->i}:{$intervalo->s}";
                                    ?>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="idade" class="control-label">IDADE</label>
                                            <input id="resedita" disabled="" type="text" name="idade" class="form-control campos_form" value="<?php echo $anos;  ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">SEXO</label>
                                            <select class="form-control campos_form" name="sexo">
                                                <option value="MASCULINO" <?php echo ($dados_geral['dados_beneficiario']->sexo == 'MASCULINO' ? 'selected="selected"' : ''); ?>>MASCULINO</option> 
                                                <option value="FEMININO" <?php echo ($dados_geral['dados_beneficiario']->sexo == 'FEMININO' ? 'selected="selected"' : ''); ?>>FEMININO</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group campos_form">
                                            <label class="control-label">ESTADO CIVIL</label>
                                            <select class="form-control campos_form" name="estadocivil">
                                                <option value="<?php echo $dados_geral['dados_beneficiario']->estadocivil; ?>" ><?php echo $dados_geral['dados_beneficiario']->estadocivil; ?></option>
                                                <option value="CASADO">CASADO</option>
                                                <option value="SOLTEIRO (A)">SOLTEIRO (A)</option>
                                                <option value="SEPARADO (A)">SEPARADO (A)</option>
                                                <option value="OUTROS">OUTROS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">ADMISSÃO</label>
                                            <input type="text" name="admissao" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" id="razao" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->admissao; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">NOME DA MÃE</label>
                                            <input type="text" onkeyup="maiuscula(this)" name="nomemae" id="razao" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->nome_mae; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CEP</label>
                                            <div class="input-group">
                                                <input type="text" maxlength="8" onkeyup="maskCep(this)" onclick="maskCep(this)" onkeypress="maskCep(this)" class="form-control campos_form" name="cep" id="cep" value="<?php echo $dados_geral['dados_beneficiario']->cep; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CIDADE</label>
                                            <div class="input-group">
                                                <input type="text" onkeyup="maiuscula(this)" class="form-control campos_form" name="cidade" id="cidade" value="<?php echo $dados_geral['dados_beneficiario']->cidade; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" >
                                        <div class="form-group">
                                            <label for="uf" class="control-label">UF: </label>
                                            <select class="form-control campos_form" id="uf" name="uf">
                                                <option value="<?php echo $dados_geral['dados_beneficiario']->uf; ?>"><?php echo $dados_geral['dados_beneficiario']->uf; ?></option>
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
                                            <input type="text" onkeyup="maiuscula(this)" name="endereco" id="rua" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->endereco; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">NÚMERO</label>
                                            <input type="text" name="numero" id="numero" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->numero; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">BAIRRO</label>
                                            <input type="text" onkeyup="maiuscula(this)" name="bairro" id="bairro" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->bairro; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">E-MAIL</label>
                                            <input type="text" name="benef_email" id="endereco" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->benef_email; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="telefone" class="control-label">TELEFONE</label>
                                            <input type="text" maxlength="13" onkeyup="masktel(this)" onclick="masktel(this)" onkeypress="masktel(this)" name="telefone" id="" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->telefone; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">CELULAR</label>
                                            <input type="text" maxlength="14" onkeyup="maskCel(this)" onclick="maskCel(this)" onkeypress="maskCel(this)" name="carteirinha" id="" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->carteirinha; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">STATUS</label>
                                            <div class="input-group">
                                                <select class="form-control campos_form" name="status" id="status_interacao">
                                                    <option value="ATIVO" <?php echo ($dados_geral['dados_beneficiario']->status == 'ATIVO' ? 'selected="selected"' : ''); ?>>ATIVO</option> 
                                                    <option value="INATIVO" <?php echo ($dados_geral['dados_beneficiario']->status == 'INATIVO' ? 'selected="selected"' : ''); ?>>INATIVO</option> 
                                                    <option value="MOVIMENTAÇÃO" <?php echo ($dados_geral['dados_beneficiario']->status == 'MOVIMENTAÇÃO' ? 'selected="selected"' : ''); ?>>MOVIMENTAÇÃO</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CRIAR ATENDIMENTO</label>
                                            <div class="input-group">
                                                <select class="form-control campos_form" name="criaratendimento" id="">
                                                    <option value="">--</option> 
                                                    <option value="SIM">SIM</option> 
                                                    <option value="NAO">NÃO</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="display: none;" id="mostra_interacoes">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">INTERAÇÕES</label>
                                            <textarea name="interacoes" onkeyup="maiuscula(this)" id="obs" class="form-control campos_form"><?php echo $dados_geral['dados_beneficiario']->obs; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea name="obs" onkeyup="maiuscula(this)" id="obs" class="form-control campos_form"><?php echo $dados_geral['dados_beneficiario']->obs; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="width: 15%;">
                                    <br />
                                    <input type="hidden" name="cadastrar_user" value="cad" />
                                    <button type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> ALTERAR</button>
                                </div>
                                <div class="col-md-2" style="width: 15%;">
                                    <br />
                                    <button type="button" id="btn_abcham" onclick="deletar_benef(<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>)" name="btn_abcham" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-times" aria-hidden="true"></i> EXCLUIR</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            //Chama o evento após selecionar um valor
                            $('#status_interacao').on('change', function () {
                                //Verifica se o valor é igual a 1 e mostra a divCnpj
                                if (this.value == 'MOVIMENTAÇÃO')
                                {
                                    //$("#usur_escolhido").hide();
                                    $("#mostra_interacoes").show();
                                }
                                //Se não for nem 1 nem 2 esconde as duas
                                else {
                                    $("#mostra_interacoes").hide();
                                    //  $("#divCpf").hide();
                                }
                            });
                        });
                    </script>
                </div>
                <div class="row fluid"> 
<?php if ($dados_geral['atendimentos'] != null) { ?>
                        <!--Atendimentos do beneficiário-->
                        <div class="col-md-12">
                            <legend class="legend" >ATENDIMENTOS DO BENEFICIÁRIO
                            </legend>
                        </div>
                        <div class="row fluid" style="margin-bottom: 5%;">
                            <div class="col-md-12"> 
                                <div class="container" style="width:98%;height:220px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                                    <div class="table-responsive">
                                        <table id="example" class="table table-hidaction table-hover" cellspacing="0" width="100%">
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
                                                            <a title="VISUALIZAR REQUISIÇÃO" class="btn btn-info" href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                        <td style="font-family: serif; align-content: center; size: 5px;">
                                                            <span class="pull-left">
                                                                <b><?php echo limitChars($result->nome_atendimento, 2); ?></b>
                                                                <br>
                                                                <span class="bold text-muted">Categoria::</span>
        <?php echo $result->tipo; ?>
                                                            </span>
                                                            <span class="pull-right text-right">
                                                                <span class="text-gray size-10">Evento: </span>
        <?php echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?>
                                                                <br>
                                                                Cliente:  <?php echo limitChars($result->nome_cliente, 0); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-center" style="font-family: initial; align-content: center; size: 5px;"><b><?php echo $result->andamento; ?></b></td>
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
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php } ?>
                    <!--Final dos atendimentos-->
                    <div class="col-md-12">
                        <legend class="legend" >PLANOS VINCULADOS
                            <a href="#" title="Inserir" class="btn btn-info" style="float: right;margin-top: -1.6%;" data-toggle="modal" data-target=".inserir_contato-modal-lg"><i class="fa fa-save"></i> INSERIR PLANOS</a>
                        </legend>
                    </div>
                    <div class="row fluid">
                        <div class="col-md-12">
                            <div class="container" style="width:98%;height:300px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                                <div class="table-responsive">
                                    <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>OPERADORA</th>
                                                <th>DESC. DO PLANO</th>
                                                <th>NÚMERO DO CONTRATO</th>
                                                <th>RAMO</th>
                                                <th>AÇÃO</th>


                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php
                                            $dominio = $_SERVER['HTTP_HOST'];
                                            $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                                            foreach ($dados_geral['planos_sel_beneficiario'] as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value->nome_op; ?></td>
                                                    <td><?php echo $value->nome_plano; ?></td>
                                                    <td><a <a href="visualizando_contrato?identificacao=<?php echo $value->cont_id; ?>" title="Visualizar o Contrato"><?php echo $value->num_contrato; ?></a></td>
                                                    <td><?php echo $value->cont_ramo; ?></td>
                                                    <td>  <td class="text-center">
                                                        <button type="button" class="btn btn-xs btn-success btn-mini" data-toggle="modal" data-target="#editar_planos" 
                                                                data-whatever_id_plano="<?php echo $value->id_plano_esc; ?>"
                                                                data-whatever_nome_plano="<?php echo $value->nome_plano; ?>"
                                                                data-whatever_operadora="<?php echo $value->nome_op; ?>"
                                                                data-whatever_num_contrato="<?php echo $value->num_contrato; ?>"
                                                                data-whatever_obs_plano="<?php echo $value->obs; ?>"
                                                                data-whatever_dta_vigencia="<?php echo $value->dtavigencia; ?>"
                                                                data-whatever_ramo="<?php echo $value->cont_ramo; ?>"
                                                                data-whatever_valor="<?php echo $value->valor; ?>"
                                                                data-whatever_carteirinha="<?php echo $value->carteirinha; ?>"
                                                                title="EDITAR"><i class="fa fa-check-circle" aria-hidden="true" title="EDITAR"></i></button>
                                                        <button type="button" class="btn btn-xs btn-danger btn-mini" onClick="deletar_plano(<?php echo $value->id_plano_esc; ?>)"  titlee="EXCLUIR"><i class="fa fa-remove" aria-hidden="true" title="EXCLUIR"></i></button></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 5%;">
                        <legend class="legend" >DEPENDENTES VINCULADOS
                            <a href="#" title="Inserir" class="btn btn-info" style="float: right;margin-top: -1.6%;" data-toggle="modal" data-target=".inserir_dependente-modal-lg"><i class="fa fa-save"></i> INSERIR DEPENDENTES</a>
                        </legend>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 5%;">
                        <div class="container" style="width:98%;height:300px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                            <div class="table-responsive">
                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>NOME</th>
                                            <th>PARENTESCO</th>
                                            <th>DTA NASC</th>
                                            <th>NOME DA MÃE</th>
                                            <th>ATENDIMENTO</th>
                                            <th>AÇOES</th>


                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $dominio = $_SERVER['HTTP_HOST'];
                                        $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                                        foreach ($dados_geral['dados_dependentes'] as $value) {
                                            ?>
                                            <tr>  
                                                <td><?php echo $value->nome; ?></td>
                                                <td><?php echo $value->parentesco; ?></td>
                                                <td><?php if ($value->dtanasc == '0000-00-00') {
                                                
                                            } else {
                                                echo date('d/m/Y', strtotime($value->dtanasc));
                                            } ?></td>
                                                <td><?php echo $value->nomemae; ?></td>
                                                <td>
                                                    <a  style="margin-left: 20%;" href="#" title="Criar atendimento" class="btn btn-success btn-xs btn-mini" data-toggle="modal" 
                                                        data-whatever_nome_dependente="<?php echo $value->nome; ?>"
                                                        data-target=".dependente-cria-chamado-modal-lg"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-xs btn-success btn-mini" data-toggle="modal" data-target="#exampleModal" 
                                                            data-whatever_id="<?php echo $value->id_dependentes; ?>"
                                                            data-whatever_nome="<?php echo $value->nome; ?>"
                                                            data-whatever_carteirinha="<?php echo $value->carteirinha; ?>" 
                                                            data-whatever_sexo="<?php echo $value->sexo; ?>" 
                                                            data-whatever_estadocivil="<?php echo $value->estadocivil; ?>" 
                                                            data-whatever_dtanasc="<?php if ($value->dtanasc == '0000-00-00') {
                                                
                                            } else {
                                                echo date('d/m/Y', strtotime($value->dtanasc));
                                            } ?>" 
                                                            data-whatever_cpf="<?php echo $value->cpf; ?>"
                                                            data-whatever_rg="<?php echo $value->rg; ?>" 
                                                            data-whatever_emissaoRG="<?php echo date('d/m/Y', strtotime($value->dtaEmissao)); ?>" 
                                                            data-whatever_orgexp="<?php echo $value->orgexp; ?>" 
                                                            data-whatever_parentesco="<?php echo $value->parentesco; ?>" 
                                                            data-whatever_nomemae="<?php echo $value->nomemae; ?>" 
                                                            data-whatever_obs="<?php echo $value->obs; ?>" 
                                                            data-whatever_idade="<?php echo $value->idade; ?>" 
                                                            data-whatever_status_interacao="<?php echo $value->status; ?>"
                                                            title="EDITAR"><i class="fa fa-check-circle" aria-hidden="true" title="EDITAR"></i></button>
                                                    <button type="button" class="btn btn-xs btn-danger btn-mini" onClick="deletar(<?php echo $value->id_dependentes; ?>)"  titlee="EXCLUIR"><i class="fa fa-remove" aria-hidden="true" title="EXCLUIR"></i></button>
                                                </td>
                                            </tr>
    <?php
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal CADASTRO DE BENEFICIÁRIOS -->
<div class="modal fade inserir_modal-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">CADASTRO DE BENEFICIÁRIOS</h4>
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
                            if (confirm("Deseja remover esse dependente?")) {
                                window.location = "<?= base_url(); ?>Deletar/deletar_fornecedor?acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                                //= "cadastro_usuarios.php?acao=deletar&id=" + id;
                            }
                        }
                    </script>
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_beneficiario?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="empresa" class="control-label">*RAZÃO SOCIAL/NOME</label>
                                            <select class="form-control campos_form" name="id_empresa">
                                                <option value="" >--</option>
<?php foreach ($dados_geral['dados_empresa']as $value) { ?>
                                                    <option value="<?php echo $value->id_clientes; ?>" ><?php echo $value->nome_cliente; ?></option>
<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">*NOME DO SEGURADO</label>
                                            <input onkeyup="maiuscula(this)" type="text" name="nome_ben" id="nome" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" id="resposta" class="control-label">*CPF</label>
                                            <input type="tel" required="" name="cpf" maxlength="11" onkeyup="maskNumeroc(this);
                                                    limitarInput(this)" onclick="maskNumeroc(this)" onkeypress="maskNumeroc(this)" id="cpf_pes" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <br />
                                            <button style="margin-top: 4%; height: 30px; width: 100%;" type="button" class="btn-xs btn-warning btn-mini" title="Pesquisar" id="pesquisar_beneficiario"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">RG</label>
                                            <input type="text" name="rg" maxlength="13" onkeyup="maskRg(this)" onclick="maskRg(this)" onkeypress="maskRg(this)" id="razao" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">DATA EMISSÃO</label>
                                            <input type="text" name="dtaEmissao" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" id="razao" class="form-control campos_form">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">ORGÃO EXPEDIDOR</label>
                                            <select class="form-control campos_form" name="orgexp">
                                                <option value="">--</option>
                                                <option value="SSP">SSP - Secretaria de Segurança Pública</option>
                                                <option value="COREN">COREN - Conselho Regional de Enfermagem</option>
                                                <option value="CRA">CRA - Conselho Regional de Administração</option>
                                                <option value="CRAS">CRAS - Conselho Regional de Assistentes Sociais</option>
                                                <option value="CRB">CRB - Conselho Regional de Biblioteconomia</option>
                                                <option value="CRC">CRC - Conselho Regional de Contabilidade</option>
                                                <option value="CRE">CRE - Conselho Regional de Estatística</option>
                                                <option value="CREA">CREA - Conselho Regional de Engenharia Arquitetura e Agronomia</option>
                                                <option value="CRECI">CRECI - Conselho Regional de Corretores de Imóveis</option>
                                                <option value="CREFIT">CREFIT - Conselho Regional de Fisioterapia e Terapia Ocupacional</option>
                                                <option value="CRF">CRF - Conselho Regional de Farmácia</option>
                                                <option value="CRM">CRM - Conselho Regional de Medicina</option>
                                                <option value="CRN">CRN - Conselho Regional de Nutrição</option>
                                                <option value="CRO">CRO - Conselho Regional de Odontologia</option>
                                                <option value="CRP">CRP - Conselho Regional de Psicologia</option>
                                                <option value="CRPRE">CRPRE - Conselho Regional de Profissionais de Relações Públicas</option>
                                                <option value="CRQ">CRQ - Conselho Regional de Química</option>
                                                <option value="CRRC">CRRC - Conselho Regional de Representantes Comerciais</option>
                                                <option value="CRMV">CRMV - Conselho Regional de Medicina Veterinária</option>
                                                <option value="DPF">DPF - Polícia Federal</option>
                                                <option value="EST">EST - Documentos Estrangeiros</option>
                                                <option value="I CLA">I CLA - Carteira de Identidade Classista</option>
                                                <option value="MAE">MAE - Ministério da Aeronáutica</option>
                                                <option value="MEX">MEX - Ministério do Exército</option>
                                                <option value="MMA">MMA - Ministério da Marinha</option>
                                                <option value="OAB">OAB - Ordem dos Advogados do Brasil</option>
                                                <option value="OMB">OMB - Ordens dos Músicos do Brasil</option>
                                                <option value="IFP">IFP - Instituto de Identificação Félix Pacheco</option>
                                                <option value="OUT">OUT - Outros Emissores</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">*DTA. NASC</label>
                                            <input required="" id="idade" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" name="dtaNascimento" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label class="control-label">IDADE</label>
                                            <input readonly="" id="res" type="text" name="" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="control-label">SEXO</label>
                                            <select class="form-control campos_form" name="sexo">
                                                <option value="" >--</option>
                                                <option value="MASCULINO">MASCULINO</option>
                                                <option value="FEMININO">FEMININO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group campos_form">
                                            <label class="control-label">ESTADO CIVIL</label>
                                            <select class="form-control campos_form" name="estadocivil">
                                                <option value="" >--</option>
                                                <option value="CASADO">CASADO</option>
                                                <option value="SOLTEIRO (A)">SOLTEIRO (A)</option>
                                                <option value="SEPARADO (A)">SEPARADO (A)</option>
                                                <option value="OUTROS">OUTROS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">ADMISSÃO</label>
                                            <input type="text" name="admissao" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" id="razao" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">NOME DA MÃE</label>
                                            <input onkeyup="maiuscula(this)" type="text" name="nomemae" id="razao" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CEP</label>
                                            <div class="input-group">
                                                <input type="text" maxlength="8" onkeyup="maskCep(this)" onclick="maskCep(this)" onkeypress="maskCep(this)" class="form-control campos_form" name="cep" id="cep_1" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CIDADE</label>
                                            <div class="input-group">
                                                <input onkeyup="maiuscula(this)" type="text" class="form-control campos_form" name="cidade" id="cidade_1" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" >
                                        <div class="form-group">
                                            <label for="uf" class="control-label">UF: </label>
                                            <select class="form-control campos_form" id="uf_1" name="uf">
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
                                            <input onkeyup="maiuscula(this)" type="text" name="endereco" id="rua_1" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">NÚMERO</label>
                                            <input type="text" name="numero" id="numero_1" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">BAIRRO</label>
                                            <input onkeyup="maiuscula(this)" type="text" name="bairro" id="bairro_1" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">E-MAIL</label>
                                            <input type="text" name="benef_email" id="endereco" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="telefone" class="control-label">TELEFONE</label>
                                            <input type="text" maxlength="13" onkeyup="masktel(this)" onclick="masktel(this)" onkeypress="masktel(this)" name="telefone" id="endereco" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">CELULAR</label>
                                            <input type="text" maxlength="14" onkeyup="maskCel(this)" onclick="maskCel(this)" onkeypress="maskCel(this)" name="carteirinha" id="" class="form-control campos_form" value="<?php echo $dados_geral['dados_beneficiario']->carteirinha; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">STATUS</label>
                                            <div class="input-group">
                                                <select class="form-control campos_form" name="status" id="status_interacao">
                                                    <option value="MOVIMENTAÇÃO">MOVIMENTAÇÃO</option> 
                                                    <option value="ATIVO">ATIVO</option> 
                                                    <option value="INATIVO">INATIVO</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CRIAR ATENDIMENTO</label>
                                            <div class="input-group">
                                                <select class="form-control campos_form" name="criaratendimento" id="">
                                                    <option value="">--</option> 
                                                    <option value="SIM">SIM</option> 
                                                    <option value="NAO">NÃO</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea onkeyup="maiuscula(this)" name="obs" id="obs" class="form-control campos_form"></textarea>
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
                            <button title="Cancelar" data-dismiss="modal" aria-hidden="true" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> CANCELAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->


<script type="text/javascript">
    function deletar_plano(id) {
        if (confirm("Deseja desvincular esse plano?")) {
            window.location = "<?= base_url(); ?>Deletar/desvincular_plano?acao=deletar&id=" + id + "&url=<?php echo $url; ?>&beneficiario=<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>";
            //= "cadastro_usuarios.php?acao=deletar&id=" + id;
        }
    }
</script>
<!-- Modal CADASTRO DE PLANOS-->
<div class="modal fade inserir_contato-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">VINCULAR PLANOS</h4>
            </div>
            <div class="panel-body panel-body-nopadding">
                <div class="col-md-12" style="margin-bottom: 5%;" >
                    <style>
                        .campos_form{
                            padding: 5px;  
                        }
                    </style>
                    <script type="text/javascript">
                        //Função que tras e envia categoria e produto
//                        var base_url = "<?php echo base_url(); ?>"
//                        var cliente_id = "<?php echo $dados_geral['dados_beneficiario']->id_clientes; ?>"
//                        $(function () {
//                            $('#ramo').change(function () {
//                                $('#operadoras').attr('disabled', 'disabled');
//                                $('#operadoras').html("<option>Carregando...</option>");
//                                var ramo_operadora = $('#ramo').val();
//                                $.post(base_url + 'Ajax/getOperadorasRamo', {
//                                    ramo_da_operadora: ramo_operadora,
//                                    cliente_id: cliente_id
//                                }, function (data) {
//                                    //console.log(data); //imprime com f12
//                                    $('#operadoras').html(data);
//                                    $('#operadoras').removeAttr('disabled');
//                                });
//                            });
//                        });

                        //select contratos
                        var cliente_id = "<?php echo $dados_geral['dados_beneficiario']->id_clientes; ?>"
                        $(function () {
                            $('#cont_ramo_nov').change(function () {
                                //$('#ncontratos').attr('disabled', 'disabled');
                                $('#operadora_contrato').html("<option>Carregando...</option>");
                                var cont_ramo_nov = $('#cont_ramo_nov').val();
                                var dados = {
                                    num_contrato: cont_ramo_nov,
                                    cliente_id: cliente_id
                                }
                                $.post(base_url + 'Ajax/getOperadorasContratoNovo', dados, function (retorna) {
                                     var result = $.parseJSON(retorna)
                                     var nome_op = result[0].nome_op;
                                     var id_operadoras = result[0].id_operadoras;
                                     $('#operadora_contrato').val(nome_op);
                                     $('#id_da_op_planos').val(id_operadoras);
                                     document.getElementById('planos_alt').focus();
                                });
                            });
                        });

                        //habilita o plano
                        $(function () {
                            $('#ncontratos').change(function () {
                                $('#planos').removeAttr('disabled');
                                $('#idvig').removeAttr('disabled');
                                $('#numero_carteir').removeAttr('disabled');
                                $('#valor').removeAttr('disabled');
                            });
                        });
                        //habilita a data
                        $(function () {
                            $('#planos').change(function () {
                                $('#idvig').removeAttr('disabled');
                            });
                        });

                        $(document).ready(function () {
                            $("input.dinheiro").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "."});
                        });
                    </script>
                    
                        
                    <form action="<?= base_url(); ?>cadastrar/vincular_planos?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input type="hidden" name="id_beneficiario" value="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>">
                        <input type="hidden" name="id_da_op_planos" id="id_da_op_planos" value="">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">
                                <fieldset class="scheduler-border">
                                        <legend class="scheduler-border" style="font-size: 14px;">VÍNCULO: &nbsp; &nbsp;

                                            <input name="vinculoe" type="radio" value="vi1_empresa">
                                            <label for="">EMPRESA</label>

                                            <input name="vinculoe" type="radio" value="vi2_pessoal" >
                                            <label for="">PESSOAL</label>

                                        </legend>
                                    </fieldset>
                                  <script type="text/javascript">
                                    $('input[name="vinculoe"]').change(function () {
                                    if ($('input[name="vinculoe"]:checked').val() === "vi1_empresa") {
                                        $('#decisao').show();
                                        $('#pes_vin').show();
                                        $('#pes_vin_pes').hide();
                                        $('#cont_ramo_beneficiario').removeAttr('required');
                                        $('#operadora_contrato_beneficiario').removeAttr('required');
                                        $('#planos_alt').val('');
                                        $('#valor').val('');
                                        $('#cont_ramo_beneficiario').val('');
                                        $('#operadora_contrato_beneficiario').val('');
                                       // $('#dependente').hide();
                                        // $('.nao_socio').attr('required', 'required');
                                        //  $('.requer').removeAttr('required', 'required');
                                    } else if ($('input[name="vinculoe"]:checked').val() === "vi2_pessoal") {
                                        $('#decisao').show();
                                         $('#pes_vin').hide();
                                         $('#pes_vin_pes').show();
                                        $('#cont_ramo_nov').val('');
                                        $('#cont_ramo_nov').removeAttr('required');
                                        $('#operadora_contrato').val('');
                                        $('#operadora_contrato').removeAttr('required');
                                        $('#cont_ramo_beneficiario').attr('required');
                                        $('#planos_alt').val('');
                                        $('#valor').val('');
                                    }
                                });    
                
                             </script>
                                <div id="decisao" style="display: none;">
                                <div class="row fluid">
                                    <div id="pes_vin" style="display: none;">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">CONTRATOS - RAMO</label>
                                            <select required="" class="campos_form form-control mb15 cat" id="cont_ramo_nov" name="numero_contrato_alt">
                                                <option value="">Selecione o contrato</option>
                                                <?php foreach ($dados_geral['contratos_cliente'] as $cont) {?>
                                                <option value="<?php echo $cont->cont_numero;?>"><?php echo $cont->cont_numero.' - '.$cont->cont_ramo;?></option>
                                                <?php }?>
                                            </select>                                                
                                        </div>                                                
                                    </div>
                                     <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="operadoras" class="control-label">OPERADORA</label>
                                            <input required="" readonly="" id="operadora_contrato" class="campos_form form-control" name="operadoras">
                                        </div>
                                    </div>
                                    
                                    </div>
                                     <div id="pes_vin_pes" style="display: none;">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">CONTRATOS</label>
                                            <input required="" type="number" class="campos_form form-control" id="cont_ramo_beneficiario" name="numero_contrato_alt1">                                              
                                        </div>                                                
                                    </div>
                                     <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="operadoras" class="control-label">OPERADORA</label>
                                            <input required="" readonly="" id="operadora_contrato_beneficiario" class="campos_form form-control" name="operadoras1">
                                        </div>
                                    </div>
                                    
                                    </div>
                        <script type="text/javascript">
                        $("#cont_ramo_beneficiario").blur(function () {
                        var base_url = "<?php echo base_url(); ?>"
                            $('#cont_ramo_beneficiario').html("Carregando...");
                                var cont_ramo_nov = $('#cont_ramo_beneficiario').val();
                                var cliente_id = "<?php echo $dados_geral['dados_beneficiario']->id_clientes; ?>"
                                var dados = {
                                    num_contrato: cont_ramo_nov,
                                    cliente_id: cliente_id
                                }
                                $.post(base_url + 'Ajax/getOperadorasContratoNovo', dados, function (retorna) {
                                    if(retorna != 0){
                                     var result = $.parseJSON(retorna)
                                     var nome_op = result[0].nome_op;
                                     var id_operadoras = result[0].id_operadoras;
                                     var cont_numero = result[0].cont_numero;
                                     $('#operadora_contrato_beneficiario').val(nome_op);
                                     $('#id_da_op_planos').val(id_operadoras);
                                     document.getElementById('planos_alt').focus();
                                 }else{
                                     alert('Contrato não localizado !');
                                      $('#operadora_contrato_beneficiario').attr('requered');
                                     //document.getElementById('cont_ramo_beneficiario').focus();
                                 }
                                });

                            });
                        </script>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">PLANOS</label>
                                            <input required="" onkeyup="maiuscula(this)" type="text" class="campos_form form-control" id="planos_alt" name="nome_plano">                                               
                                        </div>                                                
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="valor" class="control-label">VALOR</label>
                                            <input required="" type="text" name="valor" class="dinheiro campos_form form-control" onkeyup="maiuscula(this)" id="valor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="numero_carteir" class="control-label">CARTEIRINHA</label>
                                            <input type="number" name="numero_carteir" class="campos_form form-control" onkeyup="maiuscula(this)" id="numero_carteir">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea onkeyup="maiuscula(this)" name="obs" id="obs" class="form-control campos_form"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </div>

                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button title="Gravar" type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR</button>
                        </div>
                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <button title="Cancelar" data-dismiss="modal" aria-hidden="true" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> CANCELAR</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal CADASTRO DE PLANOS-->
<div class="modal fade" id="editar_planos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">ALTERAÇÃO DE PLANOS</h4>
            </div>
            <div class="panel-body panel-body-nopadding">
                <div class="col-md-12" style="margin-bottom: 5%;" >
                    <style>
                        .campos_form{
                            padding: 5px;  
                        }
                    </style>
                    <script type="text/javascript">
                        //Função que tras e envia categoria e produto
                        var base_url = "<?php echo base_url(); ?>"
                        var cliente_id = "<?php echo $dados_geral['dados_beneficiario']->id_clientes; ?>"
                        $(function () {
                            $('#ramo').change(function () {
                                $('#operadoras').attr('disabled', 'disabled');
                                $('#operadoras').html("<option>Carregando...</option>");
                                var ramo_operadora = $('#ramo').val();
                                $.post(base_url + 'Ajax/getOperadorasRamo', {
                                    ramo_da_operadora: ramo_operadora,
                                    cliente_id: cliente_id
                                }, function (data) {
                                    //console.log(data); //imprime com f12
                                    $('#operadoras').html(data);
                                    $('#operadoras').removeAttr('disabled');
                                });
                            });
                        });

                        //select contratos
                        var cliente_id = "<?php echo $dados_geral['dados_beneficiario']->id_clientes; ?>"
                        $(function () {
                            $('#operadoras').change(function () {
                                $('#ncontratos').attr('disabled', 'disabled');
                                $('#ncontratos').html("<option>Carregando...</option>");
                                var id_operadora = $('#operadoras').val();
                                $.post(base_url + 'Ajax/getOperadorasContrato', {
                                    id_operadora: id_operadora,
                                    cliente_id: cliente_id
                                }, function (data) {
                                    //console.log(data); //imprime com f12
                                    $('#ncontratos').html(data);
                                    $('#ncontratos').removeAttr('disabled');
                                });
                            });
                        });
                        //habilita a data
                        $(function () {
                            $('#planos').change(function () {
                                $('#idvig').removeAttr('disabled');
                            });
                        });
                    </script>
<?php //echo ; ?>
                    <form action="<?= base_url(); ?>cadastrar/alterar_planos_vinculados?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input type="hidden" name="id_beneficiario" value="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>">
                        <input type="hidden" name="id_plano_esc" id="id_plano_esc">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="descricao" class="control-label">RAMO</label>
                                            <select class="campos_form form-control" id="ramo" name="ramo" disabled="">
                                                <option value="">--</option>
                                                <option value="SAÚDE">SAÚDE</option>
                                                <option value="VIDA">VIDA</option>
                                                <option value="ODONTO">ODONTO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">OPERADORA</label>
                                            <input class="campos_form form-control mb15 cat" id="nome_op" name="nome_op" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">N. CONTRATOS</label>
                                            <input class="campos_form form-control mb15 cat" id="num_contrato" name="num_contrato" disabled="">                                             
                                        </div>                                                
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">PLANOS</label>
                                            <input type="text" onkeyup="maiuscula(this)" class="campos_form form-control" id="planos" name="planos">                                               
                                        </div>                                                
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="valor" class="control-label">VALOR</label>
                                            <input type="text" name="valor" class="dinheiro campos_form form-control" onkeyup="maiuscula(this)" id="valor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="numero_carteir" class="control-label">CARTEIRINHA</label>
                                            <input type="number" name="numero_carteir" class="campos_form form-control" onkeyup="maiuscula(this)" id="numero_carteir">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea onkeyup="maiuscula(this)" name="obs" id="obs" class="form-control campos_form"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button title="Gravar" type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR</button>
                        </div>
                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <button title="Cancelar" data-dismiss="modal" aria-hidden="true" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> CANCELAR</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->


<!-- Modal DePENDENTES -->
<div class="modal fade inserir_dependente-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">CADASTRO DE DEPENDENTE</h4>
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
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_dependentes?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input type="hidden" name="id_beneficiario" value="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">NOME</label>
                                            <input onkeyup="maiuscula(this)" required="" type="text" name="nome" class="form-control campos_form" data-rule-cpfcnpj="true" value="">
                                        </div>
                                    </div>
                                    <!--  <div class="col-sm-3">
                                          <label for="cep" class="control-label">CARTEIRINHA</label>
                                          <div class="input-group">
                                              <input type="number" class="form-control campos_form" name="carteirinha" value="">
                                          </div>
                                      </div>-->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">SEXO</label>
                                            <select class="form-control campos_form" name="sexo">
                                                <option value="" >--</option>
                                                <option value="MASCULINO">MASCULINO</option>
                                                <option value="FEMININO">FEMININO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group campos_form">
                                            <label class="control-label">ESTADO CIVIL</label>
                                            <select class="form-control campos_form" name="estadocivil">
                                                <option value="" >--</option>
                                                <option value="CASADO">CASADO</option>
                                                <option value="SOLTEIRO (A)">SOLTEIRO (A)</option>
                                                <option value="SEPARADO (A)">SEPARADO (A)</option>
                                                <option value="OUTROS">OUTROS</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">DTA. NASC</label>
                                            <div class="input-group">
                                                <input id="cadidadedep" type="text" required="" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="dtanasc" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">CPF</label>
                                            <input type="text" name="cpf" maxlength="14" onkeyup="maskCpf(this)" onclick="maskCpf(this)" onkeypress="maskCpf(this)" id="razao" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">RG/DEC. NASC.</label>
                                            <input type="text" name="rg" maxlength="13" onkeyup="maskRg(this)" onclick="maskRg(this)" onkeypress="maskRg(this)" id="razao" class="form-control campos_form" value="">
                                        </div>
                                    </div>                               
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">DATA EMISSÃO</label>
                                            <input type="text" name="dtaEmissao" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" id="razao" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">ORGÃO EXPEDIDOR</label>
                                            <select class="form-control campos_form" name="orgexp">
                                                <option value="">--</option>
                                                <option value="SSP">SSP - Secretaria de Segurança Pública</option>
                                                <option value="COREN">COREN - Conselho Regional de Enfermagem</option>
                                                <option value="CRA">CRA - Conselho Regional de Administração</option>
                                                <option value="CRAS">CRAS - Conselho Regional de Assistentes Sociais</option>
                                                <option value="CRB">CRB - Conselho Regional de Biblioteconomia</option>
                                                <option value="CRC">CRC - Conselho Regional de Contabilidade</option>
                                                <option value="CRE">CRE - Conselho Regional de Estatística</option>
                                                <option value="CREA">CREA - Conselho Regional de Engenharia Arquitetura e Agronomia</option>
                                                <option value="CRECI">CRECI - Conselho Regional de Corretores de Imóveis</option>
                                                <option value="CREFIT">CREFIT - Conselho Regional de Fisioterapia e Terapia Ocupacional</option>
                                                <option value="CRF">CRF - Conselho Regional de Farmácia</option>
                                                <option value="CRM">CRM - Conselho Regional de Medicina</option>
                                                <option value="CRN">CRN - Conselho Regional de Nutrição</option>
                                                <option value="CRO">CRO - Conselho Regional de Odontologia</option>
                                                <option value="CRP">CRP - Conselho Regional de Psicologia</option>
                                                <option value="CRPRE">CRPRE - Conselho Regional de Profissionais de Relações Públicas</option>
                                                <option value="CRQ">CRQ - Conselho Regional de Química</option>
                                                <option value="CRRC">CRRC - Conselho Regional de Representantes Comerciais</option>
                                                <option value="CRMV">CRMV - Conselho Regional de Medicina Veterinária</option>
                                                <option value="DPF">DPF - Polícia Federal</option>
                                                <option value="EST">EST - Documentos Estrangeiros</option>
                                                <option value="I CLA">I CLA - Carteira de Identidade Classista</option>
                                                <option value="MAE">MAE - Ministério da Aeronáutica</option>
                                                <option value="MEX">MEX - Ministério do Exército</option>
                                                <option value="MMA">MMA - Ministério da Marinha</option>
                                                <option value="OAB">OAB - Ordem dos Advogados do Brasil</option>
                                                <option value="OMB">OMB - Ordens dos Músicos do Brasil</option>
                                                <option value="IFP">IFP - Instituto de Identificação Félix Pacheco</option>
                                                <option value="OUT">OUT - Outros Emissores</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">PARENTESCO</label>
                                            <select class="form-control campos_form" name="parentesco">
                                                <option value="">--</option>
                                                <option value="FILHA">FILHA</option>
                                                <option value="FILHO">FILHO</option>
                                                <option value="ESPOSA">ESPOSA</option>
                                                <option value="MARIDO">MARIDO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">NOME DA MÃE</label>
                                            <input onkeyup="maiuscula(this)" type="text" class="form-control campos_form" name="nomemae" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="idade" class="control-label">IDADE</label>
                                            <input readonly="" id="cadidadedep_exibe" type="text" name="idade" class="form-control campos_form">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="idade" class="control-label">STATUS</label>
                                            <select class="form-control campos_form" name="status" id="status_interacao" required="">
                                                <option value="">--</option> 
                                                <option value="ATIVO">ATIVO</option>  
                                                <option value="MOVIMENTAÇÃO">MOVIMENTAÇÃO</option> 
                                                <option value="INATIVO">INATIVO</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CRIAR ATENDIMENTO</label>
                                            <select class="form-control campos_form" name="criaratendimento" id="">
                                                <option value="">--</option> 
                                                <option value="SIM">SIM</option> 
                                                <option value="NAO">NÃO</option> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="container" style="width:98%;height:110px;border:1px solid #D6D6D6; padding:4px;margin-top:7px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>PLANOS</th>
                                                            <th>VINCULAR</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $dominio = $_SERVER['HTTP_HOST'];
                                                        $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                                                        $total_planos = $dados_geral['total_planos'];
                                                        $check = 0;
                                                        foreach ($dados_geral['planos_sel_beneficiario'] as $value) {
                                                            if ($value != null) {
                                                                $check++;
                                                            }
                                                            ?>


                                                            <tr>
                                                                <td><?php echo $value->nome_plano; ?></td>
                                                                <td><input type="checkbox" value="<?php echo $value->nome_plano; ?>" name="<?php echo $check; ?>_check"></td>  
                                                            </tr>
    <?php
}
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="table-responsive">
                                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>CARTEIRINHA</th>
                                                         <!-- <th>VINCULAR</th>-->
                                                        </tr>

                                                    </thead>
                                                    <tbody>                                                    
<?php for ($nplanos = 1; $nplanos <= $total_planos; $nplanos++) { ?>
                                                            <tr>
                                                                <td><input style="height: 24px;" type="text" value="" name="<?php echo $nplanos; ?>_carteirinha"></td> 
                                                            </tr>
    <?php
}
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea onkeyup="maiuscula(this)" name="obs" id="obs" class="form-control campos_form"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button title="Gravar" type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> CADASTRAR</button>
                        </div>
                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <button title="Cancelar" data-dismiss="modal" aria-hidden="true" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> CANCELAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->


<!-- Modal EDITAR DEPENDENTES-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">ALTERAÇÃO DE DEPENDENTE</h4>
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
                            if (confirm("Deseja remover esse dependente?")) {
                                window.location = "<?= base_url(); ?>Deletar/deletar_dependente?acao=deletar&id=" + id + "&beneficiario=<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>&url=<?php echo $url; ?>";
                                //= "cadastro_usuarios.php?acao=deletar&id=" + id;
                            }
                        }
                    </script>
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_dependentes?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input id="id_dependente" type="hidden" name="id_dependente" value="">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nome" class="control-label">NOME</label>
                                            <input onkeyup="maiuscula(this)" required="" value="" id="nome" type="text" name="nome" class="form-control campos_form" data-rule-cpfcnpj="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">SEXO</label>
                                            <select class="form-control campos_form" id="sexo" name="sexo">
                                                <option value="" >--</option>
                                                <option value="MASCULINO">MASCULINO</option>
                                                <option value="FEMININO">FEMININO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group campos_form">
                                            <label class="control-label">ESTADO CIVIL</label>
                                            <select id="estadocivil" class="form-control campos_form" name="estadocivil">
                                                <option value="" >--</option>
                                                <option value="CASADO">CASADO</option>
                                                <option value="SOLTEIRO (A)">SOLTEIRO (A)</option>
                                                <option value="SEPARADO (A)">SEPARADO (A)</option>
                                                <option value="OUTROS">OUTROS</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">DTA. NASC</label>
                                            <div class="input-group">
                                                <input id="dtanasc" type="text" required="" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="dtanasc" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">CPF</label>
                                            <input type="text" id="cpf" name="cpf" maxlength="14" onkeyup="maskCpf(this)" onclick="maskCpf(this)" onkeypress="maskCpf(this)" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">RG</label>
                                            <input type="text" id="rg" name="rg" maxlength="13" onkeyup="maskRg(this)" onclick="maskRg(this)" onkeypress="maskRg(this)" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="idade" class="control-label">IDADE</label>
                                            <input type="text" readonly="" id="dtanasc_exibe" name="idade" class="form-control campos_form">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="idade" class="control-label">STATUS</label>
                                            <select class="form-control campos_form" name="status" id="status_interacao">
                                                <option value="">--</option> 
                                                <option value="ATIVO">ATIVO</option>  
                                                <option value="MOVIMENTAÇÃO">MOVIMENTAÇÃO</option> 
                                                <option value="INATIVO">INATIVO</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CRIAR ATENDIMENTO</label>
                                            <select class="form-control campos_form" name="criaratendimento" id="">
                                                <option value="">--</option> 
                                                <option value="SIM">SIM</option> 
                                                <option value="NAO">NÃO</option> 
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">DATA EMISSÃO</label>
                                            <input id="teste2" type="text" name="teste2" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">ORGÃO EXPEDIDOR</label>
                                            <select id="orgexp" class="form-control campos_form" name="orgexp">
                                                <option value="">--</option>
                                                <option value="SSP">SSP - Secretaria de Segurança Pública</option>
                                                <option value="COREN">COREN - Conselho Regional de Enfermagem</option>
                                                <option value="CRA">CRA - Conselho Regional de Administração</option>
                                                <option value="CRAS">CRAS - Conselho Regional de Assistentes Sociais</option>
                                                <option value="CRB">CRB - Conselho Regional de Biblioteconomia</option>
                                                <option value="CRC">CRC - Conselho Regional de Contabilidade</option>
                                                <option value="CRE">CRE - Conselho Regional de Estatística</option>
                                                <option value="CREA">CREA - Conselho Regional de Engenharia Arquitetura e Agronomia</option>
                                                <option value="CRECI">CRECI - Conselho Regional de Corretores de Imóveis</option>
                                                <option value="CREFIT">CREFIT - Conselho Regional de Fisioterapia e Terapia Ocupacional</option>
                                                <option value="CRF">CRF - Conselho Regional de Farmácia</option>
                                                <option value="CRM">CRM - Conselho Regional de Medicina</option>
                                                <option value="CRN">CRN - Conselho Regional de Nutrição</option>
                                                <option value="CRO">CRO - Conselho Regional de Odontologia</option>
                                                <option value="CRP">CRP - Conselho Regional de Psicologia</option>
                                                <option value="CRPRE">CRPRE - Conselho Regional de Profissionais de Relações Públicas</option>
                                                <option value="CRQ">CRQ - Conselho Regional de Química</option>
                                                <option value="CRRC">CRRC - Conselho Regional de Representantes Comerciais</option>
                                                <option value="CRMV">CRMV - Conselho Regional de Medicina Veterinária</option>
                                                <option value="DPF">DPF - Polícia Federal</option>
                                                <option value="EST">EST - Documentos Estrangeiros</option>
                                                <option value="I CLA">I CLA - Carteira de Identidade Classista</option>
                                                <option value="MAE">MAE - Ministério da Aeronáutica</option>
                                                <option value="MEX">MEX - Ministério do Exército</option>
                                                <option value="MMA">MMA - Ministério da Marinha</option>
                                                <option value="OAB">OAB - Ordem dos Advogados do Brasil</option>
                                                <option value="OMB">OMB - Ordens dos Músicos do Brasil</option>
                                                <option value="IFP">IFP - Instituto de Identificação Félix Pacheco</option>
                                                <option value="OUT">OUT - Outros Emissores</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="parentesco" class="control-label">PARENTESCO</label>
                                            <select id="parentesco" class="form-control campos_form" name="parentesco">
                                                <option value="">--</option>
                                                <option value="FILHA">FILHA</option>
                                                <option value="FILHO">FILHO</option>
                                                <option value="ESPOSA">ESPOSA</option>
                                                <option value="MARIDO">MARIDO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">NOME DA MÃE</label>
                                            <input onkeyup="maiuscula(this)" id="nomemae" type="text" class="form-control campos_form" name="nomemae" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <label class="control-label">Planos Vinculados</label>
                                    <div class="container" style="width:98%;height:110px;border:1px solid #D6D6D6; padding:4px;margin-top:7px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>PLANOS</th>
                                                            <th>CARTEIRINHA</th>
                                                            <th>VINCULADO</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody id="resultado_planos">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="control-label">Vincular Outros Planos</label>
                                    <div class="container" style="width:98%;height:110px;border:1px solid #D6D6D6; padding:4px;margin-top:7px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 

                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>PLANOS</th>
                                                            <th>VINCULAR</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $dominio = $_SERVER['HTTP_HOST'];
                                                        $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                                                        $total_planos = $dados_geral['total_planos'];
                                                        $check = 0;
                                                        foreach ($dados_geral['planos_sel_beneficiario'] as $value) {
                                                            if ($value != null) {
                                                                $check++;
                                                            }
                                                            ?>


                                                            <tr>
                                                                <td><?php echo $value->nome_plano; ?></td>
                                                                <td><input type="checkbox" value="<?php echo $value->nome_plano; ?>" name="<?php echo $check; ?>_check"></td>  
                                                            </tr>
    <?php
}
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="table-responsive">
                                                <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>CARTEIRINHA</th>
                                                         <!-- <th>VINCULAR</th>-->
                                                        </tr>

                                                    </thead>
                                                    <tbody>                                                    
<?php for ($nplanos = 1; $nplanos <= $total_planos; $nplanos++) { ?>
                                                            <tr>
                                                                <td><input style="height: 24px;" type="text" value="" name="<?php echo $nplanos; ?>_carteirinha"></td> 
                                                            </tr>
    <?php
}
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea onkeyup="maiuscula(this)" name="obs" id="obs" class="form-control campos_form"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button title="Alterar" type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> ALTERAR</button>
                        </div>
                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <button title="Cancelar" data-dismiss="modal" aria-hidden="true" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> CANCELAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal abrir atendimento Dependente-->
<div class="modal fade dependente-cria-chamado-modal-lg" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Novo Atendimento</h4>
                </div>
                <form method="get" action="<?= base_url(); ?>Intranet/atendimento" data-toggle="validator" role="form">
                    <input type="hidden" name="id" value="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>">
                    <input name="nome" id="" type="hidden" value="<?php //echo $dados_geral['dados_beneficiario']->nome_ben;  ?>">   
                    <div class="modal-body">

                        <div id="msgUsu2"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tipo_categoria">Categoria: </label>
                                    <select id="tipo_categoria" name="cat" required="" class="form-control">
                                        <option value="">--</option>
                                        <option value="REEMBOLSO">REEMBOLSO</option>
                                        <option value="OUTROS ATENDIMENTOS">OUTROS ATENDIMENTOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo_categoria">RAMO: </label>
                                    <select name="ramo" required="" class="form-control" id="ramo_plano">
                                        <option value="">Selecione o Ramo</option> 
                                        <option value="SAÚDE">SAÚDE</option>  
                                        <option value="VIDA">VIDA </option> 
                                        <option value="ODONTO">ODONTO </option> 
                                        <option value="OUTROS">OUTROS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="tipo" style="font-size: 13px;">BENEFICIÁRIO</label>

                                    <div class="col-md-12 form-group" id="beneficiario">
                                        <input name="nome" class="form-control" id="nome_dependente_chamado" type="text" value="">  
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</button>
                      <button type="submit" class="btn btn-success" id="insCat" name="insCat"><i class="fa fa-check-circle" aria-hidden="true"></i> Continuar</button>-->
                        <button title="CRIAR" id="teste" type="submit" class="btn btn-success ">
                            <i class="fa fa-check-circle" aria-hidden="true"></i> CONTINUAR</button>                     
                    </div>

                </form>
            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->




<!-- Modal abrir atendimento Beneficiario-->
<div class="modal fade cria-chamado-modal-lg" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Novo Atendimento</h4>
                </div>
                <form method="get" action="<?= base_url(); ?>Intranet/atendimento" data-toggle="validator" role="form">
                    <input type="hidden" name="id" value="<?php echo $dados_geral['dados_beneficiario']->id_beneficiario; ?>">
                    <input name="nome" type="hidden" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>">   
                    <div class="modal-body">

                        <div id="msgUsu2"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tipo_categoria">Categoria: </label>
                                    <select id="tipo_categoria" name="cat" required="" class="form-control">
                                        <option value="">--</option>
                                        <option value="REEMBOLSO">REEMBOLSO</option>
                                        <option value="OUTROS ATENDIMENTOS">OUTROS ATENDIMENTOS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo_categoria">RAMO: </label>
                                    <select name="ramo" required="" class="form-control" id="ramo_plano">
                                        <option value="">Selecione o Ramo</option> 
                                        <option value="SAÚDE">SAÚDE</option>  
                                        <option value="VIDA">VIDA </option> 
                                        <option value="ODONTO">ODONTO </option> 
                                        <option value="OUTROS">OUTROS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="tipo" style="font-size: 13px;">BENEFICIÁRIO</label>

                                    <div class="col-md-12 form-group" id="beneficiario">
                                        <input name="nome_exibir" type="text" onkeyup="maiuscula(this)" class="form-control" value="<?php echo $dados_geral['dados_beneficiario']->nome_ben; ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</button>
                      <button type="submit" class="btn btn-success" id="insCat" name="insCat"><i class="fa fa-check-circle" aria-hidden="true"></i> Continuar</button>-->
                        <button title="CRIAR" id="teste" type="submit" class="btn btn-success ">
                            <i class="fa fa-check-circle" aria-hidden="true"></i> CONTINUAR</button>                     
                    </div>

                </form>
            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->






<script type="text/javascript">
    //alteração de dependentes
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var whatever_id = button.data('whatever_id') // Extract info from data-* attributes
        var whatever_nome = button.data('whatever_nome')
        var whatever_carteirinha = button.data('whatever_carteirinha')
        var whatever_sexo = button.data('whatever_sexo')
        var whatever_estadocivil = button.data('whatever_estadocivil')
        var whatever_dtanasc = button.data('whatever_dtanasc')
        var whatever_cpf = button.data('whatever_cpf')
        var whatever_rg = button.data('whatever_rg')
        var whatever_emissaoRG = button.data('whatever_emissaoRG')
        var whatever_orgexp = button.data('whatever_orgexp')
        var whatever_parentesco = button.data('whatever_parentesco')
        var whatever_nomemae = button.data('whatever_nomemae')
        var whatever_idade = button.data('whatever_idade')
        var whatever_obs = button.data('whatever_obs')
        var whatever_status_interacao = button.data('whatever_status_interacao')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //  modal.find('.modal-title').text('ID do Dependente: ' + whatever_id)
        modal.find('#id_dependente').val(whatever_id)
        modal.find('#nome').val(whatever_nome)
        modal.find('#carteirinha').val(whatever_carteirinha)
        modal.find('#sexo').val(whatever_sexo)
        modal.find('#estadocivil').val(whatever_estadocivil)
        modal.find('#dtanasc').val(whatever_dtanasc)
        modal.find('#cpf').val(whatever_cpf)
        modal.find('#rg').val(whatever_rg)
        modal.find('#teste2').val(whatever_emissaoRG)
        modal.find('#orgexp').val(whatever_orgexp)
        modal.find('#parentesco').val(whatever_parentesco)
        modal.find('#nomemae').val(whatever_nomemae)
        modal.find('#dtanasc_exibe').val(whatever_idade)
        modal.find('#obs').val(whatever_obs)
        modal.find('#status_interacao').val(whatever_status_interacao)



        //enviara os dados do plano para edição no dependente
        $.post(base_url + 'Ajax/getDadosPlanosDependente', {
            id_do_dependente: whatever_id
        }, function (data) {
            // console.log(data); 
            $('#resultado_planos').html(data);
        });
    })


    ///alteração de planos
    $('#editar_planos').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var whatever_id_plano = button.data('whatever_id_plano') // Extract info from data-* attributes
        var whatever_ramo = button.data('whatever_ramo')
        var whatever_nome_plano = button.data('whatever_nome_plano')
        var whatever_operadora = button.data('whatever_operadora')
        var whatever_num_contrato = button.data('whatever_num_contrato')
        var whatever_obs_plano = button.data('whatever_obs_plano')
        var whatever_dta_vigencia = button.data('whatever_dta_vigencia')
        var whatever_carteirinha = button.data('whatever_carteirinha')
        var whatever_valor = button.data('whatever_valor')
        var modal = $(this)
        //  modal.find('.modal-title').text('ID do Dependente: ' + whatever_id)
        modal.find('#id_plano_esc').val(whatever_id_plano)
        modal.find('#ramo').val(whatever_ramo)
        modal.find('#nome_op').val(whatever_operadora)
        modal.find('#planos').val(whatever_nome_plano)
        modal.find('#num_contrato').val(whatever_num_contrato)
        modal.find('#dtavigencia').val(whatever_dta_vigencia)
        modal.find('#obs').val(whatever_obs_plano)
        modal.find('#numero_carteir').val(whatever_carteirinha)
        modal.find('#valor').val(whatever_valor)
    })


    //Abrir chaados dependente
    $('.dependente-cria-chamado-modal-lg').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var whatever_nome_dependente = button.data('whatever_nome_dependente') // Extract info from data-* attributes
        var whatever_ramo = button.data('whatever_ramo')
        var modal = $(this)
        //  modal.find('.modal-title').text('ID do Dependente: ' + whatever_id)
        modal.find('#nome_dependente_chamado').val(whatever_nome_dependente)
        modal.find('#ramo').val(whatever_ramo)
    })



</script>

<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>






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
<script type="text/javascript">//(aa) 0000-0000
    function maskCel(el)
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
        vCampos(el, /[^0-9\)\(\/]/g);
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
        vCampos(el, /[^0-9\.\.\x\/-]/g);
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
<script type="text/javascript">//00000-000
    function maskNumeroc(el)
    {
        vCampos(el, /[^0-9\)\(\/]/g);
        var e = $(el).val();
        if (e.length == 11)
            $(el).val(e);
    }
</script>
<script type="text/javascript">
    //pesquisa socio por nome
    var base_url = "<?php echo base_url(); ?>"
    $("#pesquisar_beneficiario").click(function () {
        var cpf = $("#cpf_pes").val();
        // $('.resultado').attr('disabled', 'disabled');
        if (cpf != '') {
            var dados = {
                documento: cpf
            }
            $.post(base_url + 'Ajax/getBeneficiariosCpf', dados, function (retorna) {
                // $(".resultado").html(retorna);
                //$('.resultado').removeAttr('disabled');
                if (retorna == '') {
                    alert('Pode continuar, Beneficiário não possui cadastro')
                    $("#rg_pes").focus();
                } else {
                    alert('Beneficiário já cadastrado');
                    $("#cpf_pes").val("");
                    $("#cpf_pes").focus();
                }
            });
        } else {
            //$(".resultado").html('');
            alert("Informe o CPF do beneficiário");
            // document.getElementById("mytext").focus();
            $("#cpf_pes").focus();
        }
    });
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
            $.post(base_url + 'Ajax/getBeneficiarios', dados, function (retorna) {
                //mostra dentro da ul os resultados obtidos
                $(".resultado").html(retorna);
                //$('.resultado').removeAttr('disabled');
            });
        } else {
            $(".resultado").html('');
        }
    });




    //Pesquisa dependente
    $("#pesquisa_dependente").keyup(function () {
        var pesquisa = $(this).val();

        //verifica se tem algo digitado
        // $('.resultado').attr('disabled', 'disabled');
        if (pesquisa != '') {
            var dados = {
                palavra: pesquisa
            }
            $.post(base_url + 'Ajax/getDependentes', dados, function (retorna) {
                //mostra dentro da ul os resultados obtidos
                $(".resultado").html(retorna);
                //$('.resultado').removeAttr('disabled');
            });
        } else {
            $(".resultado").html('');
        }
    });
</script>
<!--
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
crossorigin="anonymous"></script>-->
<script type="text/javascript">
    $(document).ready(function () {
        $("#idade").blur(function () {
            var data = $(this).val();
            var d = new Date,
                    ano_atual = d.getFullYear(),
                    mes_atual = d.getMonth() + 1,
                    dia_atual = d.getDate(),
                    split = data.split('/'),
                    novadata = split[1] + "/" + split[0] + "/" + split[2],
                    data_americana = new Date(novadata),
                    vAno = data_americana.getFullYear(),
                    vMes = data_americana.getMonth() + 1,
                    vDia = data_americana.getDate(),
                    ano_aniversario = +vAno,
                    mes_aniversario = +vMes,
                    dia_aniversario = +vDia,
                    quantos_anos = ano_atual - ano_aniversario;
            if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
                quantos_anos--;
            }
            $("#res").val(quantos_anos);
            // return quantos_anos < 0 ? 0 : quantos_anos;
            //alert(quantos_anos);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#dtanasc").blur(function () {
            var data = $(this).val();
            var d = new Date,
                    ano_atual = d.getFullYear(),
                    mes_atual = d.getMonth() + 1,
                    dia_atual = d.getDate(),
                    split = data.split('/'),
                    novadata = split[1] + "/" + split[0] + "/" + split[2],
                    data_americana = new Date(novadata),
                    vAno = data_americana.getFullYear(),
                    vMes = data_americana.getMonth() + 1,
                    vDia = data_americana.getDate(),
                    ano_aniversario = +vAno,
                    mes_aniversario = +vMes,
                    dia_aniversario = +vDia,
                    quantos_anos = ano_atual - ano_aniversario;
            if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
                quantos_anos--;
            }
            $("#dtanasc_exibe").val(quantos_anos);
            // return quantos_anos < 0 ? 0 : quantos_anos;
            //alert(quantos_anos);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#editidade").blur(function () {
            var data = $(this).val();
            var d = new Date,
                    ano_atual = d.getFullYear(),
                    mes_atual = d.getMonth() + 1,
                    dia_atual = d.getDate(),
                    split = data.split('/'),
                    novadata = split[1] + "/" + split[0] + "/" + split[2],
                    data_americana = new Date(novadata),
                    vAno = data_americana.getFullYear(),
                    vMes = data_americana.getMonth() + 1,
                    vDia = data_americana.getDate(),
                    ano_aniversario = +vAno,
                    mes_aniversario = +vMes,
                    dia_aniversario = +vDia,
                    quantos_anos = ano_atual - ano_aniversario;
            if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
                quantos_anos--;
            }
            $("#resedita").val(quantos_anos);
// return quantos_anos < 0 ? 0 : quantos_anos;
//alert(quantos_anos);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#cadidadedep").blur(function () {
            var data = $(this).val();
            var d = new Date,
                    ano_atual = d.getFullYear(),
                    mes_atual = d.getMonth() + 1,
                    dia_atual = d.getDate(),
                    split = data.split('/'),
                    novadata = split[1] + "/" + split[0] + "/" + split[2],
                    data_americana = new Date(novadata),
                    vAno = data_americana.getFullYear(),
                    vMes = data_americana.getMonth() + 1,
                    vDia = data_americana.getDate(),
                    ano_aniversario = +vAno,
                    mes_aniversario = +vMes,
                    dia_aniversario = +vDia,
                    quantos_anos = ano_atual - ano_aniversario;
            if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
                quantos_anos--;
            }
            $("#cadidadedep_exibe").val(quantos_anos);
// return quantos_anos < 0 ? 0 : quantos_anos;
//alert(quantos_anos);
        });
    });
</script>
<script language="javascript">
    function CPF() {
        "user_strict";
        function r(r) {
            for (var t = null, n = 0; 9 > n; ++n)
                t += r.toString().charAt(n) * (10 - n);
            var i = t % 11;
            return i = 2 > i ? 0 : 11 - i
        }
        function t(r) {
            for (var t = null, n = 0; 10 > n; ++n)
                t += r.toString().charAt(n) * (11 - n);
            var i = t % 11;
            return i = 2 > i ? 0 : 11 - i
        }
        var n = "CPF Inválido", i = "CPF Válido";
        this.gera = function () {
            for (var n = "", i = 0; 9 > i; ++i)
                n += Math.floor(9 * Math.random()) + "";
            var o = r(n), a = n + "-" + o + t(n + "" + o);
            return a
        }, this.valida = function (o) {
            for (var a = o.replace(/\D/g, ""), u = a.substring(0, 9), f = a.substring(9, 11), v = 0; 10 > v; v++)
                if ("" + u + f == "" + v + v + v + v + v + v + v + v + v + v + v)
                    return n;
            var c = r(u), e = t(u + "" + c);
            return f.toString() === c.toString() + e.toString() ? i : n
        }
    }

    var CPF = new CPF();

    $(document).ready(function () {
        $("#cpf_pes").keyup(function () {
            var teste = CPF.valida($(this).val());
            $("#resposta").html(teste);
            if (teste == "CPF Válido") {
                document.getElementById('resposta').style.color = 'green';
                $("#cadastrar").removeAttr("disabled");
            } else {
                document.getElementById('resposta').style.color = 'red';
                $("#cadastrar").attr("disabled", true);
            }
        });

        $("#cpf_pes").blur(function () {
            var teste = CPF.valida($(this).val());
            $("#resposta").html(teste);
            if (teste == "CPF Válido") {
                document.getElementById('resposta').style.color = 'green';
                $("#cadastrar").removeAttr("disabled");
            } else {
                document.getElementById('resposta').style.color = 'red';
                $("#cadastrar").attr("disabled", true);
            }
        });

    });
    //controla a quantidade de dígitos no campo CPf
    function limitarInput(obj) {
        obj.value = obj.value.substring(0, 11); //Aqui eu pego o valor e só deixo o os 10 primeiros caracteres de valor no input
    }
</script>
</div><!--Fim cadastro-->
</div><!-- mainpanel -->
</section>