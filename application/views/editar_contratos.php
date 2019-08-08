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
                         <!--   <div class="col-md-12 form-group">
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
                <a href="#" title="Inserir" class="btn btn-success" data-toggle="modal" data-target=".inserir_modal-modal-lg"><i class="fa fa-save"></i> INSERIR CONTRATOS</a>
            </div>
            <!--Listando usuários-->
            <div class="col-md-12" style="margin-bottom: 5%;">
                <legend class="legend">EDITAR CONTRATO</legend>
                <?php
                $dominio = $_SERVER['HTTP_HOST'];
                $url = "http://" . $dominio . $_SERVER['REQUEST_URI'].'?id_contrato='.$dados_geral['dados_contrato']->cont_id;
                ?>
                <form action="<?= base_url(); ?>Intranet/filtro_contratos" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                    <input type="hidden" name="url" value="<?php echo $url; ?>">
                    <input type="hidden" name="id_contrato" value="<?php echo $dados_geral['dados_contrato']->cont_id;?>">
                    <div class="tab-content">

                        <!-- Content Nav Tabs 1 -->
                        <div class="active tab-pane" id="aba1">

                            <div class="row fluid">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="descricao" class="control-label">RAMO</label>
                                        <select class="campos_form form-control" id="" name="cont_ramo" disabled="">
                                            <option value="<?php echo $dados_geral['dados_contrato']->cont_ramo;?>"><?php echo $dados_geral['dados_contrato']->cont_ramo;?></option>
                                            <option value="SAÚDE">SAÚDE</option>
                                            <option value="VIDA">VIDA</option>
                                            <option value="ODONTO">DENTAL</option>
                                            <option value="PREVIDÊNCIA">PREVIDÊNCIA</option>
                                            <option value="VIAGEM">VIAGEM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="cpf_cnpj" class="control-label">OPERADORA</label>
                                        <select class="campos_form form-control mb15 cat" id="" name="cont_operadora" disabled="">
                                            <option value="<?php echo $dados_geral['dados_contrato']->nome_op;?>"><?php echo $dados_geral['dados_contrato']->nome_op;?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="empresa" class="control-label">RAZÃO SOCIAL/NOME DO CLIENTE</label>
                                        <select class="form-control campos_form" id="" name="cont_cliente" disabled="">
                                            <option value="<?php echo $dados_geral['dados_contrato']->nome_cliente;?>" ><?php echo $dados_geral['dados_contrato']->nome_cliente;?></option>
                                            <?php foreach ($dados_geral['dados_empresa']as $value) { ?>
                                                <option value="<?php echo $value->id_clientes; ?>" ><?php echo $value->nome_cliente; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="controls form-group">
                                        <label for="nome" class="control-label">*NÚMERO DO CONTRATO</label>
                                        <input type="tel" readonly="" name="cont_numero" id="nome" class="form-control campos_form" required value="<?php echo $dados_geral['dados_contrato']->cont_numero;?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row fluid">
                                <div class="col-sm-2">
                                    <div class="controls form-group">
                                        <label for="nome" class="control-label">DATA DE CORTE</label>
                                        <input type="text" maxlength="10"  name="cont_dta_corte" id="nome" class="form-control campos_form" required value="<?php echo $dados_geral['dados_contrato']->cont_dta_corte;?>">
                                    </div>
                                </div>
                                <?php if ($dados_geral['dados_contrato']->cont_ramo != 'VIDA'){?>
                               <div class="col-sm-2" id="vencimento">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">VENCIMENTO</label>
                                            <input type="text" name="cont_dta_vcto" class="form-control campos_form" value="<?php echo $dados_geral['dados_contrato']->cont_dta_vcto;?>">
                                        </div>
                                    </div>
                                <?php }else if ($dados_geral['dados_contrato']->cont_ramo == 'VIDA') {?>
                                    <div class="col-sm-2" id="vencimento_vida">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">DATA VCTO</label>
                                            <input type="text" maxlength="10"  name="cont_dta_vcto" id="nome" class="form-control campos_form" value="<?php echo $dados_geral['dados_contrato']->cont_dta_vcto;?>">
                                        </div>
                                    </div>
                                <?php }?>
                                <div class="col-sm-3">
                                    <div class="controls form-group">
                                        <label for="nome" class="control-label">*VIGÊNCIA INICIAL</label>
                                        <input type="text" maxlength="10" required="" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" name="cont_vige_inic" id="nome" class="form-control campos_form" value="<?php echo date('d/m/Y', strtotime($dados_geral['dados_contrato']->cont_vige_inic));?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="controls form-group">
                                        <label for="nome" class="control-label">*VIGÊNCIA FINAL</label>
                                        <input type="text" maxlength="10" required="" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" name="cont_vig_fin" id="nome" class="form-control campos_form" value="<?php echo date('d/m/Y', strtotime($dados_geral['dados_contrato']->cont_vig_fin));?>">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="controls form-group">
                                        <label for="nome" class="control-label">COPARTICIPAÇÃO</label>
                                        <input type="text" name="cont_coparti" id="nome" class="form-control campos_form" value="<?php echo $dados_geral['dados_contrato']->cont_coparti;?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="controls form-group">
                                        <label for="nome" class="control-label">CONTRATAÇÃO</label>
                                        <input type="text" name="cont_contratacao" id="nome" class="form-control campos_form" value="<?php echo $dados_geral['dados_contrato']->cont_contratacao;?>">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="obs" class="control-label">CONTRIBUTÁRIO</label>
                                        <input type="text" name="cont_contri" id="nome" class="form-control campos_form" value="<?php echo $dados_geral['dados_contrato']->cont_contri;?>">
                                    </div>
                                </div> 
                                 <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">*STATUS</label>
                                            <select name="status" id="nome" class="form-control campos_form">
                                                <option value="ATIVO" <?php echo $dados_geral['dados_contrato']->status == 'ATIVO' ? 'selected="selected"' : '';?>>ATIVO</option>
                                                <option value="CANCELADO" <?php echo $dados_geral['dados_contrato']->status == 'CANCELADO' ? 'selected="selected"' : '';?>>CANCELADO</option>
                                                 <option value="RENOVADO" <?php echo $dados_geral['dados_contrato']->status == 'RENOVADO' ? 'selected="selected"' : '';?>>RENOVADO</option>
                                            </select>
                                        </div>
                                    </div> 
                                 <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">*DATA DE REAJUSTE</label>
                                            <input value="<?php echo $dados_geral['dados_contrato']->reajuste;?>" type="text" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" name="reajuste" id="" class="form-control campos_form" required>
                                        </div>
                                    </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="obs" class="control-label">OBSERVAÇÃO</label>
                                        <textarea name="cont_obs" id="obs" onkeyup="maiuscula(this)" class="form-control campos_form"><?php echo $dados_geral['dados_contrato']->cont_obs;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="width: 15%;">
                        <br />
                        <input type="hidden" name="cadastrar_user" value="cad" />
                        <button type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> ALTERAR</button>
                    </div>
                    <div class="col-sm-3" style="text-align:right;margin-bottom: 4%;">
                        <br />
                    <a href="#" title="Inserir" class="btn btn-warning" data-toggle="modal" data-target=".anexo-modal-lg"><i class="fa fa-file"></i> ANEXAR ARQUIVO</a>
                    </div>
                </form>
                <div class="col-md-12">
                    <span style="color: #990000;">Histórico do contrato</span><br />
                    <?php  foreach ($dados_geral['dados_renovacao_contrato'] as $value) {?>
                    <span>Vigência Inicial: <?php echo date('d/m/Y', strtotime($value->vig_inicial));?> </span>&nbsp; - &nbsp; <span>Vigência final: <?php echo date('d/m/Y', strtotime($value->vig_final));?> </span>   
                    <hr style="margin: 0;">
                    <?php }?>
                </div>
            </div><!--Listando usuários-->
            
             <?php
                    $dominio = $_SERVER['HTTP_HOST'];
                    $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                    ?>
                    <script type="text/javascript">
                        function deletar(id, arq, id_contrato) {
                            if (confirm("Deseja remover esse anexo?")) {
                                window.location = "<?= base_url(); ?>Deletar/deletar_anexo_contrato?id_contrato=" + id_contrato + "&arq=" + arq + "&acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                            }
                        }
                    </script>
                    <?php if($dados_geral['anexos_contrato'] != null){?>
                <div class="col-md-12" style="margin-bottom: 5%; background-color: #ebebf0;">
               <legend class="legend">ANEXO(S)</legend>
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
                                            foreach ($dados_geral['anexos_contrato'] as $value) {
                                            ?>
                                    <tr>
                                      <!--  -->
                                <form style="border: 0; margin: 0;" method="POST" name="" id="" action="<?= base_url(); ?>Cadastrar/anexos_contrato?url=<?= $url; ?>">    
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><input style="height: 13px;" size="21" type="text" name="descricao_anexo"  onkeyup="maiuscula(this)" class="form-control" value="<?php echo $value->descricao; ?>"></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><?php echo substr($value->nome_arquivo, -4); ?></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;"><?php echo date('d/m/Y H:i:s', strtotime($value->criado_em)); ?></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 1px; font-size: 13px;">
                                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                                        <input type="hidden" value="<?php echo $dados_geral['dados_contrato']->cont_id;?>" name="id_contrato" id="" >
                                        <input type="hidden" value="<?php echo $value->id_anexo; ?>" name="id_anexo" id="" >
                                        <button title="Gravar" type="submit" name="alterar_user" id="alterar_user" class="btn btn-xs btn-mini btn-success" ><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                        <a href='baixar?arquivo=anexos/<?php echo $value->nome_arquivo; ?>&url=<?php echo $url;?>' title="Baixar arquivo"  class="btn btn-xs btn-mini btn-info" ><i class="fa fa-download"></i></a>
                                        <button type="button" name="excluir_reg" id="excluir_reg"
                                        class="btn btn-xs btn-danger btn-mini" value="" onClick="deletar('<?php echo $value->id_anexo;?>','<?php echo $value->nome_arquivo;?>','<?php echo $dados_geral['dados_contrato']->cont_id;?>')"><i class="fa fa-times" aria-hidden="true" title="Excluir"></i></button> 
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
                    <?php }?>
                    
            <?php if($dados_geral['dados_beneficiarios'] != null){?>
             <div class="col-md-12" style="margin-top: 5%;">
                    <legend class="legend">BENEFICIÁRIOS(S) VINCULADOS AO CONTRATO</legend>
                    <div class="table-responsive">
                        <script>
                            $(document).ready(function () {
                                $('[data-toggle="tooltip"]').tooltip();
                            });
                        </script>
                        <table id="example" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>NOME</th>
                                    <th>CPF</th>
                                    <th>E-MAIL</th>
                                    <th>TELEFONE</th>
                                    <th>STATUS</th>
                                </tr>

                            </thead>
                            <tbody> 
                                <?php 
                                foreach ($dados_geral['dados_beneficiarios'] as $dados) {
                                    ?>
                                    <tr> 
                                    <td><a href="filtro_beneficiario?id=<?php echo $dados->id_beneficiario; ?>" title="Editar beneficiário"><?php echo $dados->nome_ben; ?></a></td>
                                    <td><a href="filtro_beneficiario?id=<?php echo $dados->id_beneficiario; ?>" title="Editar beneficiário"><?php echo $dados->cpf; ?></a></td>
                                    <td><a href="filtro_beneficiario?id=<?php echo $dados->id_beneficiario; ?>" title="Editar beneficiário"><?php echo $dados->benef_email; ?></a></td>
                                    <td><a href="filtro_beneficiario?id=<?php echo $dados->id_beneficiario; ?>" title="Editar beneficiário"><?php echo $dados->telefone; ?></a></td>
                                    <td><a href="filtro_beneficiario?id=<?php echo $dados->id_beneficiario; ?>" title="Editar beneficiário"><?php echo $dados->status;  ?></a></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php }?>
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
                        $(document).ready(function () {
                            $("input.dinheiro").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "."});
                        });
                    </script>
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
                                            <label for="empresa" class="control-label">RAZÃO SOCIAL/NOME</label>
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
                                            <input type="number" name="cont_numero" id="num_contrato" class="form-control campos_form" required value="">
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
                                   <!-- <div class="col-sm-2" id="vencimento_vida" style="display: none;">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">DATA VCTO</label>
                                            <input type="text" name="cont_dta_vcto" id="nome" class="form-control campos_form" value="">
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
                                            <input type="text" name="cont_coparti" id="nome" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="controls form-group">
                                            <label for="nome" class="control-label">CONTRATAÇÃO</label>
                                            <input type="text" name="cont_contratacao" id="nome" class="form-control campos_form" required value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="obs" class="control-label">CONTRIBUTÁRIO</label>
                                            <input type="text" name="cont_contri" id="nome" class="form-control campos_form" required value="">
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
                                            <textarea name="cont_obs" id="obs" class="form-control campos_form"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="width: 15%;">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> CADASTRAR</button>
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
<!-- MODL Anexo -->
<div class="modal fade anexo-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:560px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>Intranet/uploadArquivos_contratos?url=<?= $url; ?>">
                    <input type="hidden" name="url" value="<?php echo $url; ?>">
                    <input type="hidden" name="id_contrato" value="<?php echo $dados_geral['dados_contrato']->cont_id;?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Anexar arquivo (s)</h4>
                    </div>

                    <div class="modal-body">

                        <div id="msgUsu2"></div>

                        <div class="row">
                            <div class="col-md-12">
                               <!-- <input type="hidden" name="id_atend" id="id_atend">
                                <input type="hidden" name="id_beneficiario" id="id_beneficiario">-->
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