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
                <form style="margin-bottom: 5%;" method="post" action="">   
                    <fieldset class="scheduler-border">
                        <div class="mostra">
                           <!-- <div class="col-md-12 form-group">
                                <input type="text" onkeyup="maiuscula(this)" class="form-control" placeholder="DIGITE O NÚMERO DO CONTRATO" id="pesquisa_numero">

                            </div>-->
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
                                <ul class="list-group resultado_numero" style="list-style-type: none;" onclick="Mudarestado('minhaDiv')">
                                </ul>
                            </div>

                             <!-- <button type="submit" value="" name="" class="btn btn-success" ><i class="fa fa-check-circle" aria-hidden="true"></i> Consultar</button>-->

                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-6" style="text-align:right;margin-bottom: 4%;">
                <a href="#" title="Inserir Contratos" class="btn btn-success" data-toggle="modal" data-target=".inserir_modal-modal-lg"><i class="fa fa-save"></i> INSERIR CONTRATOS</a>
            </div>
             <!--Listando usuários-->
            <div class="col-md-12">
                <legend class="legend">CONTRATOS</legend>
                <div class="table-responsive">
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>NÚMERO</th>
                                <th>OPERADORA</th>
                                <th>CLIENTE</th>
                                <th>DTA CORTE</th>
                                <th>DTA VCTO</th>
                                <th>AÇÃO</th>

                            </tr>

                        </thead>
                        <tbody> 
                          <?php
                            foreach($dados_geral['dados_contrato'] as $item){ 
                            ?>
                            <tr>

                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->cont_numero;?></td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->nome_op;?></td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->nome_cliente;?></td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->cont_dta_corte;?></td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->cont_dta_vcto;?></td>
                                <td class="text-center">
                                    <form method="post" action="<?= base_url();?>Intranet/edit_contratos" style="margin: 0; padding: 0; border: 0">
                                        <input type="hidden" value="<?php echo $item->cont_id;?>" name="id_editar">
                                        <input type="hidden" value="<?php echo $item->cont_numero;?>" name="numero_do_contrato">
                                        <button type="submit" value="" title="Alterar" name="alterar_user" id="alterar_user" class="btn btn-xs btn-success btn-mini" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i></button>
                                        <!--<button type="button" name="excluir_reg" id="excluir_reg"
                                                class="btn btn-xs btn-danger btn-mini" value="" onClick="deletar(<?php //echo $item->id;?>)" title="Excluir"><i class="fa fa-times" aria-hidden="true" title="Excluir"></i></button> -->
                                    </form>
                                </td>
                            </tr>
                            <?php
                              }
                            ?>
                        </tbody>
                    </table>
                </div> 

            </div><!--Listando usuários-->
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
                <h4 class="modal-title" id="myModalLabel">CADASTRO DE CONTRATOS</h4>
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
                                        if (confirm("Deseja remover esse Contrato?")) {
                                            window.location = "<?= base_url(); ?>Deletar/deletar_fornecedor?acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                                            //= "cadastro_usuarios.php?acao=deletar&id=" + id;
                                        }
                                    }
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $("input.dinheiro").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "."});
                        });
                    </script>
                    <?php
                    $dominio = $_SERVER['HTTP_HOST'];
                    $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                    ?>
                    <form action="<?= base_url(); ?>cadastrar/cadastro_de_contratos?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <div class="tab-content">

                            <!-- Content Nav Tabs 1 -->
                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="descricao" class="control-label">RAMO</label>
                                            <select class="campos_form form-control" id="ramo" name="cont_ramo">
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
                                            <label for="cpf_cnpj" class="control-label">OPERADORA</label>
                                            <select class="campos_form form-control mb15 cat" id="operadoras" name="cont_operadora" disabled="">
                                                <option value="">SELECIONE O RAMO</option>
                                            </select>
                                        </div>
                                    </div>
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="empresa" class="control-label">RAZÃO SOCIAL/NOME DO CLIENTE</label>
                                            <select class="form-control campos_form" id="id_empresa" name="cont_cliente" disabled="">
                                                <option value="" >SELECIONE A OPERADORA</option>
                                                <?php foreach ($dados_geral['dados_empresa']as $value) { ?>
                                                    <option value="<?php echo $value->id_clientes; ?>" ><?php echo $value->nome_cliente; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">NÚMERO DO CONTRATO</label>
                                            <input type="text" maxlength="20" onkeyup="maskNumero()(this)" onclick="maskNumero(this)" onkeypress="maskNumero(this)" name="cont_numero" id="num_contrato" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row fluid">
                                    <div class="col-sm-2">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">DATA DE CORTE</label>
                                            <input type="text" name="cont_dta_corte" id="nome" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2" id="vencimento">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">VENCIMENTO</label>
                                            <input type="text" name="cont_dta_vcto" id="nome" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-sm-2" id="vencimento_vida" style="display: none;">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">DATA VCTO</label>
                                            <input type="text" maxlength="10" name="cont_dta_vcto" id="nome" class="form-control campos_form" value="">
                                        </div>
                                    </div>-->
                                
                                    <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">VIGÊNCIA INICIAL</label>
                                            <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" name="cont_vige_inic" id="nome" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">VIGÊNCIA FINAL</label>
                                            <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" name="cont_vig_fin" id="nome" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">COPARTICIPAÇÃO</label>
                                            <input type="text" name="cont_coparti" id="nome" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">CONTRATAÇÃO</label>
                                            <input type="text" name="cont_contratacao" id="nome" class="form-control campos_form" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">CONTRIBUTÁRIO</label>
                                            <input type="text" name="cont_contri" id="nome" class="form-control campos_form" value="">
                                        </div>
                                    </div> 
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">STATUS</label>
                                            <select name="status" id="nome" class="form-control campos_form">
                                                <option value="ATIVO">ATIVO</option>
                                                <option value="CANCELADO">CANCELADO</option>
                                                 <option value="RENOVADO">RENOVADO</option>
                                            </select>
                                        </div>
                                    </div> 
                                     <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">DATA DE REAJUSTE</label>
                                            <input type="text" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" name="reajuste" id="nome" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                            <textarea name="cont_obs" id="obs" onkeyup="maiuscula(this)"  class="form-control campos_form"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button type="submit" id="btn_abcham" title="Gravar" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GRAVAR</button>
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
        vCampos(el, /[^0-9\)\(\/]/g);
        var e = $(el).val();
        if (e.length == 10)
            $(el).val(e + '');
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
//$(document).ready(function(){
//    //mostra o campo data
//    $('#ramo').on('change', function() {
//        //Verifica se o valor é igual a 1 e mostra a divCnpj
//      if ( this.value == 'VIDA')
//      {
//            $("#vencimento").hide();
//        $("#vencimento_vida").show();
//      }
//        //Se não for nem 1 nem 2 esconde as duas
//        else{
//             $("#vencimento").show();
//             $("#vencimento_vida").hide();
//        }
//    });
//});
     //desabilita o campo para digitar o nome
    $(function () {
        $('#operadoras').change(function () {
            $('#id_empresa').removeAttr('disabled');
        });
    });
    //Função que tras e envia categoria e produto
    var base_url = "<?php echo base_url(); ?>"
    $(function () {
        $('#ramo').change(function () {
            $('#operadoras').attr('disabled', 'disabled');
            $('#operadoras').html("<option>Carregando...</option>");
            var ramo_operadora = $('#ramo').val();
            $.post(base_url + 'Ajax/getOperadorasRamo_contrato', {
                ramo_da_operadora: ramo_operadora
            }, function (data) {
                //console.log(data); //imprime com f12
                $('#operadoras').html(data);
                $('#operadoras').removeAttr('disabled');
            });
        });
    });

    //select planos
    $(function () {
        $('#operadoras').change(function () {
            $('#planos').attr('disabled', 'disabled');
            $('#planos').html("<option>Carregando...</option>");
            var id_operadora = $('#operadoras').val();
            $.post(base_url + 'Ajax/getOperadorasPlanos', {
                id_operadora: id_operadora
            }, function (data) {
                //console.log(data); //imprime com f12
                $('#planos').html(data);
                $('#planos').removeAttr('disabled');
            });
        });
    });
     
    
    $("#num_contrato").blur(function () {
    var base_url = "<?php echo base_url(); ?>";
    var num_contrato = $(this).val();
    var dados = {
    num_contrato: num_contrato 
    }
   $.post(base_url + 'Ajax/GetContratosPorNumero', dados, function (retorna) {
   if(retorna == '"sim"'){
    alert('Contrato '+ num_contrato +', já cadastrado !');
    $("#num_contrato").val(""); 
    $("#num_contrato").focus(); 
     return false;
   }
   });
   });
</script>