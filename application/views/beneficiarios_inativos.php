<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<div class="contentpanel"><!--Início da classe geral-->
    <div id="page-wrapper">
        <script type="text/javascript">
       // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
       //FIM DA FUNÇÃO MASCARA MAIUSCULA
        </script>
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
                            <input name="tipo" type="radio" value="Sim" checked="">
                                <label for="tipo" style="font-size: 13px;">BENEFICIÁRIO INATIVO</label>
                                <!--
                                <input name="tipo" type="radio" value="Nao" >
                                <label for="tipo" style="font-size: 13px;">DEPENDENTE</label>-->
                                <div class="col-md-12 form-group" id="beneficiario">
                                <input type="text" class="form-control" onkeyup="maiuscula(this)" placeholder="DIGITE O NOME DO BENEFICIÁRIO" id="pesquisa">
                                </div>
                                <!--
                                <div class="col-md-12 form-group" style="display: none;" id="dependente">
                                    <input type="text" onkeyup="maiuscula(this)" class="form-control" placeholder="DIGITE O NOME DO DEPENDENTE" id="pesquisa_dependente">
                                </div> --> 

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
                                <ul class="list-group resultado"  style="list-style-type: none;" onclick="Mudarestado('minhaDiv')">
                                </ul>
                            </div>
                             <!-- <button type="submit" value="" name="" class="btn btn-success" ><i class="fa fa-check-circle" aria-hidden="true"></i> Consultar</button>-->

                        </div>
                    </fieldset>
                </form>
            </div>
           <!-- <div class="col-sm-6" style="text-align:right;margin-bottom: 4%;">
                <a href="#" title="Inserir Beneficiario" class="btn btn-success" data-toggle="modal" data-target=".inserir_modal-modal-lg"><i class="fa fa-save"></i> INSERIR BENEFICIÁRIOS</a>
            </div>-->
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
                                        if (confirm("Deseja remover esse fornecedor?")) {
                                            window.location = "<?= base_url(); ?>Deletar/deletar_fornecedor?acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                                            //= "cadastro_usuarios.php?acao=deletar&id=" + id;
                                        }
                                    }
                    </script>
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_beneficiario?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input type="hidden" name="id_beneficiario" value="">
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
                                        <div class="control form-group">
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
                                            <label for="razao" class="control-label">RG / DNV</label>
                                            <input type="text" name="rg" maxlength="13" onkeyup="maskRg(this)" onclick="maskRg(this)" onkeypress="maskRg(this)" id="rg_pes" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">DATA EMISSÃO</label>
                                            <input type="text" style="height: 29px;" name="dtaEmissao" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" id="razao" class="form-control campos_form" value="">
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
                                            <input id="idade" required="" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" name="dtaNascimento" class="form-control campos_form" value="">
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
                                                <input type="text" maxlength="9" onkeyup="maskCep(this)" onclick="maskCep(this)" onkeypress="maskCep(this)" class="form-control campos_form" name="cep" id="cep" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CIDADE</label>
                                            <div class="input-group">
                                                <input onkeyup="maiuscula(this)" type="text" class="form-control campos_form" name="cidade" id="cep" value="">
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
                                            <input onkeyup="maiuscula(this)" type="text" name="endereco" id="endereco" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">NÚMERO</label>
                                            <input type="text" name="numero" id="endereco" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">BAIRRO</label>
                                            <input onkeyup="maiuscula(this)" type="text" name="bairro" id="endereco" class="form-control campos_form" value="">
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
                                                <select class="form-control campos_form" name="criaratendimento" id="">
                                                    <option value="">--</option> 
                                                    <option value="SIM">SIM</option> 
                                                     <option value="NAO">NÃO</option> 
                                                </select>
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
                            <button title="Gravar" type="submit" id="cadastrar" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR</button>
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
<!-- Modal 
 <script src="<?= base_url(); ?>/assets/js/jquery-3.2.1.min.js"></script>
-->

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
            $.post(base_url + 'Ajax/getBeneficiarios_inativos', dados, function (retorna) {
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