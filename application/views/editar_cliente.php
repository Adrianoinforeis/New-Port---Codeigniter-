<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<script type="text/javascript" >
    $(document).ready(function () {
        // $("#cep_pesq").mask("00000000");
        // $('#telefone').mask("(00) 0000-00000");
        // $("#cpf").mask("00.000.000-00");
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua_prin").val("");
            $("#bairro_prin").val("");
            $("#cidade_prin").val("");
            $("#uf_prin").val("");
            $("#ibge_prin").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep_prin").blur(function () {
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
                    $("#rua_prin").val("...");
                    $("#bairro_prin").val("...");
                    $("#cidade_prin").val("...");
                    $("#uf_prin").val("...");
                    $("#ibge_prin").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua_prin").val(dados.logradouro.toUpperCase());
                            $("#bairro_prin").val(dados.bairro.toUpperCase());
                            $("#cidade_prin").val(dados.localidade.toUpperCase());
                            $("#uf_prin").val(dados.uf.toUpperCase());
                            $("#ibge_prin").val(dados.ibge);
                            document.getElementById('numero').focus();

                            $("#rua_prin").removeAttr('readonly');
                            $("#bairro_prin").removeAttr('readonly');
                            $("#cidade_prin").removeAttr('readonly');
                            $("#uf_prin").removeAttr('readonly');
                            $("#ibge_prin").removeAttr('readonly');
                            $("#numero_prin").removeAttr('readonly');
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
            <div class="col-sm-5">
                <form style="margin-bottom: 5%;" method="post" action="<?= base_url(); ?>Cadastrar/portaria">   
                    <fieldset class="scheduler-border">
                        <div class="mostra">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" onkeyup="maiuscula(this)" placeholder="DIGITE O NOME DO CLIENTE" id="pesquisa">

                            </div>
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
            <div class="col-sm-3" style="text-align:right;margin-bottom: 4%;">
                <a href="#" title="Inserir" class="btn btn-warning" data-toggle="modal" data-target=".anexo-modal-lg"><i class="fa fa-file"></i> ANEXAR ARQUIVO</a>
            </div>
            <div class="col-sm-4" style="text-align:right;margin-bottom: 4%;">
                <a href="#" title="Inserir" class="btn btn-success" data-toggle="modal" data-target=".inserir_modal-modal-lg"><i class="fa fa-save"></i> INSERIR CLIENTE</a>
            </div>
            <div class="col-md-12" id="minhaDiv">
                <legend class="legend">CLIENTE</legend>

                <div class="col-md-12" style="margin-bottom: 2%;" >
                    <style>
                        .campos_form{
                            padding: 5px;  
                        }
                    </style>
                    <?php
                    $dominio = $_SERVER['HTTP_HOST'];
                    $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                    ?>
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_clientes?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input type="hidden" name="tipo" value="<?php echo $dados_geral['dados_cliente']->tipo; ?>">
                        <input type="hidden" name="id_clientes" value="<?php echo $dados_geral['dados_cliente']->id_clientes; ?>">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <?php if ($dados_geral['dados_cliente']->tipo == 'cnpj') { ?>
                                        <div class="col-sm-3">
                                            <div class="controls form-group">
                                                <label for="nome" class="control-label">NOME FANTASIA</label>
                                                <input type="text" name="nome_fantasia" class="form-control campos_form" required  value="<?php echo $dados_geral['dados_cliente']->nome_cliente; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <?php //print_r($dados_operadora);?>
                                                <label for="cpf_cnpj" class="control-label">CNPJ</label>
                                                <input value="<?php echo $dados_geral['dados_cliente']->cnpj; ?>" type="text" name="cnpj" id="cpf_cnpj" maxlength="18" onkeyup="maskCnpj(this)" onclick="maskCnpj(this)" onkeypress="maskCnpj(this)" class="form-control campos_form" data-rule-cpfcnpj="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="razao" class="control-label">RAZÃO SOCIAL</label>
                                                <input type="text" name="razao" id="razao" class="form-control campos_form" value="<?php echo $dados_geral['dados_cliente']->razao; ?>">
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-6">
                                            <div class="controls form-group">
                                                <label for="nome" class="control-label">NOME</label>
                                                <input type="text" onkeyup="maiuscula(this)" name="nome" id="nome" class="form-control campos_form" value="<?php echo $dados_geral['dados_cliente']->nome_cliente; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="cpf_cnpj" class="control-label">CPF</label>
                                                <input type="text" name="cpf" id="cpf_cnpj" maxlength="18" onkeyup="maskCpf(this)" onclick="maskCpf(this)" onkeypress="maskCpf(this)" class="form-control campos_form" data-rule-cpfcnpj="true" value="<?php echo $dados_geral['dados_cliente']->cpf; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="razao" class="control-label">RG</label>
                                                <input type="text" maxlength="12" onkeyup="maskRg(this)" onclick="maskRg(this)" onkeypress="maskRg(this)" name="rg" id="razao" class="form-control campos_form" value="<?php echo $dados_geral['dados_cliente']->rg; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CEP</label>
                                            <div class="input-group">
                                                <input type="text" maxlength="8" onkeyup="maskCep(this)" onclick="maskCep(this)" onkeypress="maskCep(this)" class="form-control campos_form" name="cep" id="cep_prin" value="<?php echo $dados_geral['dados_cliente']->cep; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">CIDADE</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control campos_form" name="cidade" id="cep_prin" value="<?php echo $dados_geral['dados_cliente']->cidade; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" >
                                        <div class="form-group">
                                            <label for="uf" class="control-label">UF: </label>
                                            <select class="form-control campos_form" id="uf_prin" name="uf">
                                                <option value="<?php echo $dados_geral['dados_cliente']->uf; ?>"><?php echo $dados_geral['dados_cliente']->uf; ?></option>
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
                                            <input type="text" name="endereco" id="endereco_prin" class="form-control campos_form" value="<?php echo $dados_geral['dados_cliente']->endereco; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">NÚMERO</label>
                                            <input type="text" name="numero" id="numero_prin" class="form-control campos_form" value="<?php echo $dados_geral['dados_cliente']->numero; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">BAIRRO</label>
                                            <input type="text" name="bairro" id="bairro_prin" class="form-control campos_form" value="<?php echo $dados_geral['dados_cliente']->bairro; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2" >
                                        <div class="form-group">
                                            <label for="uf" class="control-label">STATUS: </label>
                                            <select class="form-control campos_form" id="" name="status">
                                                <option value="<?php echo $dados_geral['dados_cliente']->status; ?>"><?php echo $dados_geral['dados_cliente']->status; ?></option>
                                                <option value="ATIVO">ATIVO</option>
                                                <option value="INATIVO">INATIVO</option>
                                                <option value="PROSPECÇAO">PROSPECÇAO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" >
                                        <div class="form-group">
                                            <label for="uf" class="control-label">(SUB)ESTIPULANTE: </label>
                                            <select class="form-control campos_form" id="estipulante_cad" name="estipulante">
                                                <option value="NÃO" <?php echo ($dados_geral['dados_cliente']->estipulante == 'NÃO' ? 'selected="selected"' : ''); ?>>NÃO</option>
                                                <option value="SIM" <?php echo ($dados_geral['dados_cliente']->estipulante == 'SIM' ? 'selected="selected"' : ''); ?>>SIM</option>                                               
                                               <!-- <option value="<?php //echo $dados_geral['dados_cliente']->estipulante;  ?>"><?php //echo $dados_geral['dados_cliente']->estipulante;  ?></option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <?php if ($dados_geral['dados_cliente']->estipulante == 'SIM') { ?>
                                        <div class="col-sm-3" id="estip_dep">
                                        <?php } else { ?>
                                            <div class="col-sm-3" id="estip_dep" style="display: none;">
                                            <?php } ?>
                                            <div class="form-group">
                                                <label for="uf" class="control-label">CLIENTE: </label>
                                                <select class="form-control campos_form" id="" name="id_estipulante">
                                                    <option value="<?php echo $dados_geral['dados_cliente']->id_estipulante; ?>"><?php echo $dados_geral['dados_cliente']->id_estipulante; ?></option>
                                                    <?php foreach ($dados_geral['dados_cliente_cadastrados'] as $value) { ?>
                                                        <option value="<?php echo $value->nome_cliente; ?>"><?php echo $value->nome_cliente; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php //} ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $('#estipulante_cad').on('change', function () {
                                                    if (this.value == 'SIM')
                                                    {
                                                        $("#estip_dep").show();
                                                    } else if (this.value == 'NÃO')
                                                    {
                                                        $("#estip_dep").hide();
                                                    } else {
                                                        // $("#estp_final").show();
                                                        $("#estip_dep").hide();
                                                    }
                                                });
                                            });
                                        </script>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                                <textarea name="obs" id="obs" class="form-control campos_form"><?php echo $dados_geral['dados_cliente']->obs; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-2" style="width: 15%;">
                                            <br />
                                            <input type="hidden" name="cadastrar_user" value="cad" />
                                            <button type="submit" title="Gravar" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR</button>
                                        </div>
                                        <div class="col-md-10" style="text-align:right;margin-bottom: 4%; margin-top: 2%;">
                                            <a href="#" title="Inserir Contato" class="btn btn-info" data-toggle="modal" data-target=".inserir_contato-modal-lg"><i class="fa fa-save"></i> INSERIR CONTATO</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                  <?php
                    $dominio = $_SERVER['HTTP_HOST'];
                    $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                    ?>
                    <script type="text/javascript">
                        function deletar(id, arq) {
                            if (confirm("Deseja remover esse anexo?")) {
                                window.location = "<?= base_url(); ?>Deletar/deletar_anexo_cliente?arq=" + arq + "&acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                            }
                        }
                    </script>
                <div class="col-md-12" style="margin-bottom: 5%; background-color: #ebebf0;">
               <legend class="legend">ANEXO(S) DO CLIENTE</legend>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <script>
                            $(document).ready(function () {
                                $('[data-toggle="tooltip"]').tooltip();
                            });
                        </script>
                        <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>DESCRIÇÃO</th>
                                    <th>TIPO DO ARQUIVO</th>
                                    <th>DATA DA POSTAGEM</th>
                                    <th>AÇÃO</th>

                                </tr>

                            </thead>
                            <tbody> 
                                        <?php
                                        $dominio = $_SERVER['HTTP_HOST'];
                                                $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                                            foreach ($dados_geral['anexos_cliente'] as $value) {
                                            ?>
                                    <tr>
                                      <!--  -->
                                <form style="border: 0; margin: 0;" method="POST" name="" id="" action="<?= base_url(); ?>Cadastrar/anexos_cliente?url=<?= $url; ?>">    
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input style="height: 13px;" size="21" type="text" name="descricao_anexo"  onkeyup="maiuscula(this)" class="form-control" value="<?php echo $value->descricao; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><?php echo substr($value->nome_arquivo, -4); ?></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><?php echo date('d/m/Y H:i:s', strtotime($value->criado_em)); ?></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;">
                                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                                        <input type="hidden" value="<?php echo $value->id_anexo; ?>" name="id_anexo" id="" >
                                        <button title="Gravar" type="submit" name="alterar_user" id="alterar_user" class="btn btn-xs btn-mini btn-success" ><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                        <a href='baixar?arquivo=anexos/<?php echo $value->nome_arquivo; ?>&url=<?php echo $url;?>&desc=<?php echo $value->descricao; ?>&ex=<?php echo substr($value->nome_arquivo, -4); ?>' title="Baixar arquivo"  class="btn btn-xs btn-mini btn-info" ><i class="fa fa-download"></i></a>
                                        <button type="button" name="excluir_reg" id="excluir_reg"
                                                class="btn btn-xs btn-danger btn-mini" value="" onClick="deletar('<?php echo $value->id_anexo;?>','<?php echo $value->nome_arquivo;?>')"><i class="fa fa-times" aria-hidden="true" title="Excluir"></i></button> 
                                    </td> 
                                    </tr>
                                </form>
                                <?php
                                      }
                                ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
                </div>
                <div class="col-md-12">
                <legend class="legend">CONTATOS</legend>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <script>
                            $(document).ready(function () {
                                $('[data-toggle="tooltip"]').tooltip();
                            });
                        </script>
                        <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>DESCRIÇÃO</th>
                                    <th>DATA DA POSTAGEM</th>
                                    <th>CARGO</th>
                                    <th>DTA. NASC</th>
                                    <th>TEL. FIXO</th>
                                    <th>TEL. CEL</th>
                                    <th>E-MAIL</th>
                                    <th>AÇÃO</th>

                                </tr>

                            </thead>
                            <tbody> 
<?php
$dominio = $_SERVER['HTTP_HOST'];
$url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
foreach ($dados_geral['dados_contato'] as $value) {
    ?>
                                    <tr>
                                <form style="border: 0; margin: 0;" method="POST" name="" id="" action="<?= base_url(); ?>Cadastrar/contatos_cliente?url=<?= $url; ?>">   
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input size="15" type="text" name="nome" class="" value="<?php echo $value->nome; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input size="6" type="text" name="area" class="" value="<?php echo $value->area; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input size="10" type="text" name="cargo" class="" value="<?php echo $value->cargo; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input size="7" style="height: 24px;" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" name="dtaNascimento" class="campos_form" value="<?php echo $value->dtaNascimento; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input size="11" maxlength="13" onkeyup="masktel(this)" onclick="masktel(this)" onkeypress="masktel(this)" type="text" name="telFixo" class="" value="<?php echo $value->telFixo; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input size="12" maxlength="14" onkeyup="maskcel(this)" onclick="maskcel(this)" onkeypress="maskcel(this)" type="text" name="telCelular" class="" value="<?php echo $value->telCelular; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input size="16" type="email" name="email" class="" value="<?php echo $value->email; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;">

                                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                                        <input type="hidden" value="<?php echo $value->id_cliente; ?>" name="id_cliente" id="" >
                                        <input type="hidden" value="<?php echo $value->id_contato; ?>" name="id_contato" id="" >
                                        <button title="Gravar" type="submit" name="alterar_user" id="alterar_user" class="btn btn-xs btn-mini btn-success" ><i class="fa fa-check-circle" aria-hidden="true"></i></button>

                                    </td> 

                                    OBSERVAÇÃO:
                                    <textarea style="width: 100%;" rows="2"> <?php echo $value->obs; ?></textarea>
                                    </tr>
                                </form>
    <?php
}
?>
                            </tbody>
                        </table>
                    </div> 
                </div>
                </div>


                <div class="col-md-12" style="margin-top: 5%;">
                    <legend class="legend">CONTRATO(S) DO CLIENTE</legend>
                    <div class="table-responsive">
                        <script>
                            $(document).ready(function () {
                                $('[data-toggle="tooltip"]').tooltip();
                            });
                        </script>
                        <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>RAMO</th>
                                    <th>NÚMERO</th>
                                    <th>DTA CORTE</th>
                                    <th>DTA VENCIMENTO</th>
                                    <th>VIGÊNCIA INICIAL</th>
                                    <th>VIGÊNCIA FINAL</th>
                                    <th>STATUS</th>
                                </tr>

                            </thead>
                            <tbody> 
<?php
foreach ($dados_geral['dados_contrato'] as $dados) {
    ?>
                                    <tr> 
                                        <td><a href="visualizando_contrato?identificacao=<?php echo $dados->cont_id; ?>" title="Visualizar o Contrato"><?php echo $dados->cont_ramo; ?></a></td>
                                        <td><a href="visualizando_contrato?identificacao=<?php echo $dados->cont_id; ?>" title="Visualizar o Contrato"><?php echo $dados->cont_numero; ?></a></td>
                                        <td><a href="visualizando_contrato?identificacao=<?php echo $dados->cont_id; ?>" title="Visualizar o Contrato"><?php echo $dados->cont_dta_corte; ?></a></td>
                                        <td><a href="visualizando_contrato?identificacao=<?php echo $dados->cont_id; ?>" title="Visualizar o Contrato"><?php echo $dados->cont_dta_vcto; ?></a></td>
                                        <td><a href="visualizando_contrato?identificacao=<?php echo $dados->cont_id; ?>" title="Visualizar o Contrato"><?php echo date('d/m/Y', strtotime($dados->cont_vige_inic)); ?></a></td>
                                        <td><a href="visualizando_contrato?identificacao=<?php echo $dados->cont_id; ?>" title="Visualizar o Contrato"><?php echo date('d/m/Y', strtotime($dados->cont_vig_fin)); ?></a></td>
                                         <td><a href="visualizando_contrato?identificacao=<?php echo $dados->cont_id; ?>" title="Visualizar o Contrato"><?php echo $dados->status; ?></a></td>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#estipulante').on('change', function () {
            if (this.value == 'SIM')
            {
                $("#estp_final").show();
            } else if (this.value == 'NÃO')
            {
                $("#estp_final").hide();
            } else {
                $("#estp_final").hide();
            }
        });
    });
</script>
<!-- Modal -->
<div class="modal fade inserir_modal-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">CADASTRO DE CLIENTE</h4>
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
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_clientes?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border" style="font-size: 14px;">TIPO: &nbsp; &nbsp;

                                            <input name="tipo" type="radio" value="cpf">
                                            <label for="tipo">FÍSICA</label>

                                            <input name="tipo" type="radio" value="cnpj" >
                                            <label for="tipo">JURÍDICA</label>

                                        </legend>
                                    </fieldset>
                                    <div class="cliente_cnpj" style="display: none;">
                                        <div class="col-sm-3">
                                            <div class="controls form-group">
                                                <label for="nome" class="control-label">NOME FANTASIA</label>
                                                <input type="text" onkeyup="maiuscula(this)" name="nome" id="nome" class="form-control campos_form" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="cpf_cnpj" class="control-label">CNPJ</label>
                                                <input type="text" name="cnpj" id="cpf_cnpj" maxlength="18" onkeyup="maskCnpj(this)" onclick="maskCnpj(this)" onkeypress="maskCnpj(this)" class="form-control campos_form" data-rule-cpfcnpj="true" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="razao" class="control-label">RAZÃO SOCIAL</label>
                                                <input type="text" onkeyup="maiuscula(this)" name="razao" id="razao" class="form-control campos_form" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cliente_cpf" style="display: none;">
                                        <div class="col-sm-6">
                                            <div class="controls form-group">
                                                <label for="nome" class="control-label">NOME</label>
                                                <input type="text" onkeyup="maiuscula(this)" name="nome" id="nome" class="form-control campos_form" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="cpf_cnpj" class="control-label">CPF</label>
                                                <input type="text" name="cnpj" id="cpf_cnpj" maxlength="18" onkeyup="maskCpf(this)" onclick="maskCpf(this)" onkeypress="maskCpf(this)" class="form-control campos_form" data-rule-cpfcnpj="true" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="razao" class="control-label">RG</label>
                                                <input type="text" maxlength="12" onkeyup="maskRg(this)" onclick="maskRg(this)" onkeypress="maskRg(this)" name="razao" id="razao" class="form-control campos_form" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="geral" style="display: none;">
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
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">BAIRRO</label>
                                            <input type="text" onkeyup="maiuscula(this)" name="bairro" id="bairro" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2" >
                                        <div class="form-group">
                                            <label for="uf" class="control-label">STATUS: </label>
                                            <select class="form-control campos_form" id="" name="status" required="">
                                                <option value="">--</option>
                                                <option value="ATIVO">ATIVO</option>
                                                <!--<option value="INATIVO">INATIVO</option>-->
                                                <option value="PROSPECÇAO">PROSPECÇAO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cliente_cnpj" style="display: none;">
                                        <div class="col-sm-2" >
                                            <div class="form-group">
                                                <label for="uf" class="control-label">(SUB)ESTIPULANTE: </label>
                                                <select class="form-control campos_form" id="estipulante" name="estipulante">
                                                    <option value="NÃO">NÃO</option>
                                                    <option value="SIM">SIM</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" style="display: none;" id="estp_final">
                                        <div class="form-group">
                                            <label for="uf" class="control-label">CLIENTE: </label>
                                            <select class="form-control campos_form" id="" name="id_estipulante">
                                                <option value="">SELECIONE O CLIENTE</option>
<?php foreach ($dados_geral['dados_cliente_cadastrados'] as $value) { ?>
                                                    <option value="<?php echo $value->nome_cliente; ?>"><?php echo $value->nome_cliente; ?></option>
<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea name="obs" onkeyup="maiuscula(this)" id="obs" class="form-control campos_form"></textarea>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR</button>
                        </div>
                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <button data-dismiss="modal" aria-hidden="true" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> CANCELAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
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
<div class="modal fade inserir_contato-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">CADASTRO DE CONTATO</h4>
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
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_contatos_cliente?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <input type="hidden" name="id_clientes" value="<?php echo $dados_geral['dados_cliente']->id_clientes; ?>">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cpf_cnpj" class="control-label">NOME</label>
                                            <input type="text" onkeyup="maiuscula(this)" name="nome" class="form-control campos_form" data-rule-cpfcnpj="true" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">ÁREA</label>
                                            <input type="text" onkeyup="maiuscula(this)" name="area" id="nome" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="razao" class="control-label">CARGO</label>
                                            <input type="text" onkeyup="maiuscula(this)" name="cargo" id="razao" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">DTA. NASC</label>
                                            <div class="input-group">
                                                <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control campos_form" name="dtaNascimento" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">TEL. FIXO</label>
                                            <div class="input-group">
                                                <input type="text" maxlength="13" onkeyup="masktel(this)" onclick="masktel(this)" onkeypress="masktel(this)" class="form-control campos_form" name="telFixo" id="cep" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">TEL. CEL</label>
                                            <div class="input-group">
                                                <input type="text" maxlength="14" onkeyup="maskcel(this)" onclick="maskcel(this)" onkeypress="maskcel(this)" class="form-control campos_form" name="telCelular" id="cep" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cep" class="control-label">E-MAIL</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control campos_form" name="email" id="cep" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row fluid">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea name="obs" onkeyup="maiuscula(this)" id="obs" class="form-control campos_form"></textarea>
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

<!-- MODL Anexo -->
<div class="modal fade anexo-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:560px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>Intranet/uploadArquivos_cliente?url=<?= $url; ?>">
                    <input type="hidden" name="url" value="<?php echo $url; ?>">
                    <input type="hidden" name="id_clientes" value="<?php echo $dados_geral['dados_cliente']->id_clientes; ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Anexar arquivo (s)</h4>
                    </div>

                    <div class="modal-body">

                        <div id="msgUsu2"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id_atend" id="id_atend">
                                <input type="hidden" name="id_beneficiario" id="id_beneficiario">
                                <label for="Paciente">FAZER UPLOAD: </label>
                                <div class="col-md-12 form-group">
                                   <!-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                    <input type="file" name="arquivo[]" multiple="multiple" />-->
                                    <input type="file" name="arquivo" class="form-control" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>DESCRIÇÃO</label>
                                    <input required="" onkeyup="maiuscula(this)" type="text" name="descricao" class="form-control">

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
<!-- modal -->
<!--Função para validar numeros e cpf, telefone-->
<script type="text/javascript">
    $('input[name="tipo"]').change(function () {
        if ($('input[name="tipo"]:checked').val() === "cnpj") {
            $('.cliente_cnpj').show();
            $('.cliente_cpf').hide();
            $('#geral').show();
        } else {
            $('.cliente_cnpj').hide();
            $('.cliente_cpf').show();
            $('#geral').show();
        }
    });
</script>
<!--Função para validar numeros e cpf, telefone-->
<script type="text/javascript">
    //tipo de usuario
    $(document).ready(function () {
        //Chama o evento após selecionar um valor
        $('#estipulante').on('change', function () {
            //Verifica se o valor é igual a 1 e mostra a divCnpj
            if (this.value == 'SIM')
            {
                // $("#usur_escolhido").hide();
                $("#estp_final").show();
            }
            //Se o tempo for mé igual a 2 mostra a divCpf
            else if (this.value == 'NÃO')
            {
                $("#estp_final").hide();
                //$("#usur_escolhido").show();
            }
            //Se não for nem 1 nem 2 esconde as duas
            else {
                // $("#estp_final").show();
                $("#estp_final").hide();
            }
        });
    });
</script>
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
        if (e.length == '')
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
        vCampos(el, /[^0-9\)\(\/]/g);
        var e = $(el).val();
        if (e.length == 5)
            $(el).val(e + '');
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
            $.post(base_url + 'Ajax/getClientes', dados, function (retorna) {
                //mostra dentro da ul os resultados obtidos
                $(".resultado").html(retorna);
                //$('.resultado').removeAttr('disabled');
            });
        } else {
            $(".resultado").html('');
        }
    });
</script>

<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
</div><!--Fim cadastro-->
</div><!-- mainpanel -->
</section>
