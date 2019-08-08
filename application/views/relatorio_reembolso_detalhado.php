
<div class="contentpanel"><!--Início da classe geral-->
    <!--**********************-->
    <?php
//seta a data para o estado sp
    date_default_timezone_set('America/Sao_Paulo');

//#########################################################################
    ?>


    <div class="collapse navbar-collapse navbar-ex1-collapse">

    </div>
    <!-- /.navbar-collapse -->
</nav>
 <style>
                fieldset.scheduler-border {
                    border: solid 1px #DDD !important;
                    padding: 0 10px 10px 10px;
                    border-bottom: none;
                    margin-top: 4%;
                }

                legend.scheduler-border {
                    width: auto !important;
                    border: none;
                    font-size: 14px;
                }
                 #pisca {
                color: #000;
                transition: color .7s;
                }
                .mostrar {
                color: #f34 !important;
                }
            </style>
<div id="page-wrapper nao-imprime">

    <div class="container-fluid">
        <!--CSS-->    
        <div class="span10">
            <!---Body content----------------------------------------------------->

            <div> 
                <!---Body content----------------------------------------------------->
                <div class="container nao-imprime" style="width:98%;height:1990px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                    <form method="post" name="" action="<?= base_url() ?>Intranet/filtro_relatorio_detalhado">
                        <div class="col-md-12" style="margin-bottom: 5%;">
                            <div class="row">
                                <div class="col-md-4">
                                    <fieldset class="scheduler-border" style="height: 110px;">
                                   <legend class="scheduler-border">Filtrar por beneficiário</legend>
                                   <input name="tipo_ben" type="radio" value="Sim" <?php if($dados_geral['seleciona']['beneficiario'] != null){?> checked=""<?php }?>>
                                    <label for="tipo_ben" style="font-size: 13px;">Específico</label>

                                    <input name="tipo_ben" type="radio" value="Nao" <?php if($dados_geral['seleciona']['beneficiario'] == null){?>checked="" <?php }?>>
                                    <label for="tipo_ben" style="font-size: 13px;">Todos</label>
                                    <input onkeyup="maiuscula(this)" id="especifico" <?php if($dados_geral['seleciona']['beneficiario'] != null){?> value="<?php echo $dados_geral['seleciona']['beneficiario'];?>" <?php }else{?> style="display: none;" <?php }?> type="text" name="beneficiario" class="form-control" placeholder="Nome do beneficiário">
                                </fieldset>
                                </div>
                                
                                 <div class="col-md-4">
                                    <fieldset class="scheduler-border" style="height: 110px;">
                                   <legend class="scheduler-border">Filtrar por cliente</legend>
                                   <input name="tipo_cli" type="radio" value="Sim" <?php if($dados_geral['seleciona']['cliente'] != null){?> checked=""<?php }?>>
                                    <label for="tipo_cli" style="font-size: 13px;">Específico</label>

                                    <input name="tipo_cli" type="radio" value="Nao" <?php if($dados_geral['seleciona']['cliente'] == null){?>checked="" <?php }?>>
                                    <label for="tipo_cli" style="font-size: 13px;">Todos</label>
                                        <input onkeyup="maiuscula(this)" type="text" id="especifico_cliente" <?php if($dados_geral['seleciona']['cliente'] != null){?> value="<?php echo $dados_geral['seleciona']['cliente'];?>" <?php }else{?>  style="display: none; width: 100%;" <?php } ?> name="cliente" class="form-control" placeholder="Nome do cliente">
                                </fieldset>
                                </div>
                                
                                 <div class="col-md-4">
                                 <fieldset class="scheduler-border" style="height: 110px;">
                                     <legend class="scheduler-border">Tipo de atendimento &nbsp;&nbsp;<input type="checkbox" checked="" name="tipoatendimento" value="sim" <?php if($dados_geral['seleciona']['check_tipo_atendimento'] != null){echo 'checked="checked"';}?>></legend>
                                   <select class="form-control" name="tipo_atendimento" style="height: 40px;">
                                    <option value="">TODOS</option>
                                    <option value="Consulta"  <?php echo ($dados_geral['seleciona']['tipo_atendimento'] == 'Consulta' ? 'selected="selected"' : '');?> >CONSULTA</option>
                                    <option value="Exame" <?php echo ($dados_geral['seleciona']['tipo_atendimento'] == 'Exame' ? 'selected="selected"' : '');?>>EXAME</option>
                                    <option value="TERAPIAS" <?php echo ($dados_geral['seleciona']['tipo_atendimento'] == 'TERAPIAS' ? 'selected="selected"' : '');?>>TERAPIAS</option>
                                    <option value="INTERNAÇÃO" <?php echo ($dados_geral['seleciona']['tipo_atendimento'] == 'INTERNAÇÃO' ? 'selected="selected"' : '');?>>INTERNAÇÃO</option>
                                    <option value="OUTROS" <?php echo ($dados_geral['seleciona']['tipo_atendimento'] == 'OUTROS' ? 'selected="selected"' : '');?>>OUTROS</option>
                                    </select>
                                 </fieldset>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                 <fieldset class="scheduler-border" style="height: 110px;">
                                     <legend class="scheduler-border">Status de pagamento&nbsp;&nbsp;<input type="checkbox" checked="" name="statuspagamento" value="sim" <?php if($dados_geral['seleciona']['check_status_pagamento'] != null){echo 'checked="checked"';}?>></legend>
                                   <select class="form-control" name="status_pagamento" style="height: 40px;">
                                    <option value="">TODOS</option>
                                    <option value="ANÁLISE NA OPERADORA" <?php echo ($dados_geral['seleciona']['status_pagamento'] == 'ANÁLISE NA OPERADORA' ? 'selected="selected"' : '');?>>ANÁLISE NA OPERADORA</option>
                                    <option value="PAGO" <?php echo ($dados_geral['seleciona']['status_pagamento'] == 'PAGO' ? 'selected="selected"' : '');?>>PAGO</option>
                                    <option value="NEGADO" <?php echo ($dados_geral['seleciona']['status_pagamento'] == 'NEGADO' ? 'selected="selected"' : '');?>>NEGADO</option>
                                    <option value="PENDÊNCIA" <?php echo ($dados_geral['seleciona']['status_pagamento'] == 'PENDÊNCIA' ? 'selected="selected"' : '');?>>PENDÊNCIA</option>
                                    </select>
                                 </fieldset>
                                 </div>
                                <!--
                                 <div class="col-md-3">
                                 <fieldset class="scheduler-border" style="height: 110px;">
                                   <legend class="scheduler-border">Data do reembolso &nbsp;&nbsp;<input type="checkbox" name="reembolso" value="sim" <?php if($dados_geral['seleciona']['check_dta_reembolso'] != null){echo 'checked="checked"';}?>></legend>
                                   <input type="text"  <?php if($dados_geral['seleciona']['dta_reembolso'] != null){?> value="<?php echo $dados_geral['seleciona']['dta_reembolso'];?>" <?php }?> maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" class="form-control" name="dta_reembolso" style="height: 40px;">
                                 </fieldset>
                                 </div>-->
                                
                               <!-- <div class="col-md-6" style="margin-top: -1%;">
                                 <fieldset class="scheduler-border" style="height: 110px;">
                                   <legend class="scheduler-border">Nome do prestador &nbsp;&nbsp;<input type="checkbox" name="nomeprestador" value="sim" <?php if($dados_geral['seleciona']['check_prestador'] != null){echo 'checked="checked"';}?>></legend>
                                   <input type="text" <?php if($dados_geral['seleciona']['prestador'] != null){?> value="<?php echo $dados_geral['seleciona']['prestador'];?>" <?php }?>  onkeyup="maiuscula(this)" class="form-control" name="prestador" style="height: 40px;">
                                 </fieldset>
                                 </div>-->
                            
                                <div class="col-md-3">
                                   <fieldset class="scheduler-border" style="height: 110px;">
                                   <legend class="scheduler-border">Data inicial</legend>
                                   <input id="dta_inicio" placeholder="xx/xx/xxxx" value="<?php if($dados_geral['seleciona']['inicio'] != null){echo $dados_geral['seleciona']['inicio'];}?>" maxlength="10"  style="height: 40px;" type="text" class="form-control" name="dta_inicio">
                                   </fieldset>
                                </div>
                                <div class="col-md-3">
                                    <fieldset class="scheduler-border" style="height: 110px;">
                                   <legend class="scheduler-border">Data final</legend>
                                   <input id="dta_fim" placeholder="xx/xx/xxxx" value="<?php if($dados_geral['seleciona']['fim'] != null){echo $dados_geral['seleciona']['fim'];}?>" maxlength="10" style="height: 40px;" type="text" class="form-control" name="dta_fim">
                                    </fieldset>
                                </div>
                              
                               <!-- <div class="col-md-3">
                                    <fieldset class="scheduler-border" style="height: 110px;">
                                        <legend class="scheduler-border">Analista &nbsp;&nbsp;<input type="checkbox" name="nomeanalista" value="sim" <?php if($dados_geral['seleciona']['check_nomeanalista'] != null){echo 'checked="checked"';}?>></legend>
                                    <input type="text" onkeyup="maiuscula(this)" <?php if($dados_geral['seleciona']['analista'] != null){?> value="<?php echo $dados_geral['seleciona']['analista'];?>" <?php }?> class="form-control" name="analista" style="height: 40px;">
                                    </fieldset>
                                </div>-->
                                <div class="col-md-3" style="">
                                <fieldset class="scheduler-border" style="height: 110px;">
                                    <legend class="scheduler-border">Filtrar</legend>
                                    <button id="pisca" style="width: 100px; margin-left: 20%;"title="Pesquisar" type="submit" class="btn btn-success" name=""><i class="fa fa-search" aria-hidden="true"></i></button>
                                </fieldset>
                                </div>
                             </div>
                          
                             <script type="text/javascript">
                                $('input[name="tipo_ben"]').change(function () {
                                        if ($('input[name="tipo_ben"]:checked').val() === "Sim") {
                                            $('#especifico').show();
                                            //$('#dependente').hide();
                                            // $('.nao_socio').attr('required', 'required');
                                            //  $('.requer').removeAttr('required', 'required');
                                        } else if ($('input[name="tipo_ben"]:checked').val() === "Nao") {
                                            $('#especifico').hide();
                                            $('#especifico').val("");
                                        }
                                    });
                                    
                                     $('input[name="tipo_cli"]').change(function () {
                                        if ($('input[name="tipo_cli"]:checked').val() === "Sim") {
                                            $('#especifico_cliente').show();
                                            //$('#dependente').hide();
                                            // $('.nao_socio').attr('required', 'required');
                                            //  $('.requer').removeAttr('required', 'required');
                                        } else if ($('input[name="tipo_cli"]:checked').val() === "Nao") {
                                            $('#especifico_cliente').hide();
                                            $('#especifico_cliente').val("");
                                        }
                                    });
                                    
                                    function pisca() {
                                    var $pisca = $('#pisca');
                                    $pisca.addClass('mostrar');
                                    setTimeout(function () {
                                    $pisca.removeClass('mostrar');
                                    }, 850);
                                    }
                                    window.onload = function () {
                                    setInterval(pisca, 1500);
                                    }
                                     function maiuscula(z) {
                                    v = z.value.toUpperCase();
                                    z.value = v;
                                }
                                </script>
                            <br />
                            <div class="row" style="display: none;">
                                <div class="col-md-2">
                                    <label>
                                        <input checked="checked" type="checkbox" name="categoria" value="categoria" <?php if($dados_geral['seleciona']['categoria'] != null){echo 'checked="checked"';}?>>Categoria
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        <input checked="checked" type="checkbox" name="andamento" value="andamento" <?php if($dados_geral['seleciona']['andamento'] != null){echo 'checked="checked"';}?>>Andamento
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        <input checked="checked" type="checkbox" name="status" value="status" <?php if($dados_geral['seleciona']['status'] != null){echo 'checked="checked"';}?>>Status
                                    </label>
                                </div>
                                 <div class="col-md-2">
                                    <label>
                                        <input checked="checked" type="checkbox" name="numero" value="numero" <?php if($dados_geral['seleciona']['numero'] != null){echo 'checked="checked"';}?>>Número
                                    </label>
                                </div>
                            </div>
                       <!-- <div class="col-md-12">
                        <br />
                        <link href="<?= base_url(); ?>assets/css/grade-impressao.css" rel="stylesheet">
                        <?php if ($dados_geral['atendimentos'] != null){?>
                        <a title="Imprimir" href="JavaScript:window.print();"  name="imprimir" style="float: right;" class="btn btn-primary"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
                        <?php }?>
                        </div>-->
                        </div>
                    </form>

                	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


	<!--<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script type="text/javascript" class="init">
$(document).ready(function() {
//    var now = new Date();
//   now.format("dd/MM/yyyy HH:mm:ss");
	$('#example').DataTable( {
            "bDeferRender": true,			
		"sPaginationType": "full_numbers",					
		"oLanguage": {
    
		    "sZeroRecords":    "Não foi encontrado registros",
		    "sEmptyTable":     "Nenhum dado disponível nessa tabela",
		    "sInfo":           "Mostrando (_START_ de _END_), de um total de _TOTAL_, registros",
		    "sInfoEmpty":      "Mostrando 0 de 0 de um total de 0 registros",
		    "sInfoFiltered":   "(filtrado de um total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Filtrar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Por favor espere - carregando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Próximo",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
        },
		dom: 'Bfrtip',
//                "buttons": [
//            {
//                extend: 'collection',
//                text: 'Selecione a forma que deseja exportar as informações',
//		buttons: [
//			'copy', 'csv', 'excel', 'pdf', 'print'
//		]
//            }
//                ]
buttons: [
     { 
      extend: 'copy',
      text: 'Copiar Dados',
       title: 'Relatório de reembolso detalhado'
  },
  {
      extend: 'csv',
      text: 'Exportar .csv',
      title: 'Relatório de reembolso detalhado em CSV'
      
   },
    {
      extend: 'excel',
      text: 'Exportar Excel',
      title: 'Relatório de reembolso detalhado em Excel '
      
   },
   {
      extend: 'pdf',
      text: 'Exportar PDF',
      title: 'Relatório de reembolso detalhado em PDF',
     //  messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
      
   },
   {
      extend: 'print',
      text: 'Imprimir',
       title: 'Relatório de reembolso detalhado',
      
   }
			//'copy', 'csv', 'excel', 'pdf', 'print'
		]
	} ); 

} );



</script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $("input.dinheiro").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "."});
                        });
                    </script>
                    <?php if ($dados_geral['atendimentos'] != null){?>
                    <div class="box-body table-responsive">

                        <table id="example"  class="table table-hover table-dark display" role="grid" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row" class="odd">
                                  <!--  <th style="font-size: 12px;">Visualizar</th>-->
                                    <th class="table-active"style="font-size: 12px;">Beneficiário</th>
                                    <th style="font-size: 12px;">Cliente</th>
                                    <th style="font-size: 12px;">Recibo</th>
                                    <th style="font-size: 12px;">Operadora</th>
                                    <th style="font-size: 12px;">Valor</th>
                                    <th style="font-size: 12px;">Prestador</th>
                                    <th style="font-size: 12px;">Status</th>
                                     <?php if($dados_geral['seleciona']['numero'] != null){?>
                                     <?php }?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dados_geral['atendimentos'] as $result) {
                                    ?>
                                    <tr style="align-content: center;">
                                        <td style="font-family: arial ; align-content: center; size: 5px; font-size: 12px;"><a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>">
                                         <?php echo $result->nome_atendimento; ?> &nbsp;
                                                        <?php //echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?>

                                            </a>
                                        </td>
                                        <td style="font-family: arial ; align-content: center; size: 5px; font-size: 12px;"><a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>">
                                        <?php echo limitChars($result->nome_cliente, 4); ?>
                                            </a>
                                        </td>
                                          <td style="font-family: arial ; align-content: center; size: 5px; font-size: 12px;"><a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>">
                                         <?php echo date('d/m/Y', strtotime($result->dta_recibo)); ?>
                                            </a>
                                        </td>
                                         <td style="font-family: arial ; align-content: center; size: 5px; font-size: 12px;"><a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>">
                                         <?php echo date('d/m/Y', strtotime($result->ini_pro_operadora)); ?>
                                            </a>
                                        </td>
                                         <td style="font-family: arial ; align-content: center; size: 5px; font-size: 12px;"><a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>">
                                         <?php echo number_format($result->valor_recibo, 2, ',', '.'); ?>
                                            </a>
                                        </td>

        <!-- <td class="dinheiro" style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->valor_recibo; ?></td>-->

                                        <td style="font-family: arial; align-content: center; size: 5px; font-size: 12px; font-size: 11px;"><a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>">
                                        <?php echo $result->nome_prestador; ?>
                                            </a>
                                        </td>
                                        <td style="font-family: arial; align-content: center; size: 5px; font-size: 12px;"><a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>">
                                            <?php echo $result->status; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                    <?php }?>
                </div>
            </div>
            <!-------------------------------------------------------------------->
        </div>
    </div><!--fluid-->
</div><!--container-->

<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>


<!--**********************-->
</div><!-- contentpanel fim geral-->

</div><!-- mainpanel -->
<div class="imprime" style="margin-top: -140%; height : 65px; border-bottom: 1px solid;">
    <div class="conteudo" style="margin-top: -10%; height : 65px; border-bottom: 1px solid" >
        <br>
        <div style="position: relative ; top: 6px;"><img style="float : left; width: 20%;" width="10px;" src="<?= base_url(); ?>assets/images/logo.JPG" /></div>
        <br>
        <!--span style="font-size:20px;">GPA Web 1.0</span-->
        <span style="font-size:13px; margin-left:20px;">Rua Apeninos, 485 – 4º andar – Paraíso – São Paulo – SP - Telefone: (11) 4810 2041</span>

    </div>
    <br>
    <br>
    <fieldset style="border-bottom: 1px solid"> <legend> REEMBOLSO DETALHADO</legend>
    <?php foreach ($dados_geral['atendimentos'] as $result) {
                        ?>
        <span><b>SOLICITANTE: </b> <?php echo $result->nome_atendimento; ?></span> 
        <?php if($dados_geral['seleciona']['check_tipo_atendimento'] != null){?><span style="float: right;"><b>TIPO: </b> <?php echo $result->tipo; ?></span><?php }?><br> 
       
        <span><b>DATA DA SOLICITAÇÃO: </b> <?php echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?></span> <?php if($dados_geral['seleciona']['check_status_pagamento'] != null){?> <span style="float: right;"><b>STATUS: </b> <?php echo $result->status; ?></span><?php }?><br> 
       
        <span><b>CLIENTE: </b> <?php echo $result->nome_cliente; ?></span><span style="float: right;"><b> ANDAMENTO: </b> <?php echo $result->andamento; ?></span>
        
        <span><b>DATA DO RECIBO: </b> <?php echo date('d/m/Y', strtotime($result->dta_recibo)); ?></span><?php if($dados_geral['seleciona']['check_dta_reembolso'] != null){?><span style="margin-left: 1%;"><b> DATA REEMBOLSO: </b> <?php echo $result->dta_reembolso; ?></span><?php }?><span style="float: right;"><b> INÍCIO NA OPERADORA: </b><?php echo date('d/m/Y', strtotime($result->ini_pro_operadora)); ?></span>
        
        <?php if($dados_geral['seleciona']['check_prestador'] != null){?><span><b>PRESTADOR: </b> <?php echo $result->nome_prestador; ?></span><?php }?><span style="float: right;"><b> VALOR: </b> R$ <?php echo $result->valor_reembolso; ?></span>
        
    <?php if($result->criada_por != null){?><span><b>ATENDIMENTO CRIADO POR: </b> <?php echo limitChars(strtoupper($result->criada_por), 0); ?></span><?php } if($result->nome_analista != null){?><span style="float: right;"><b> FINALIZADO POR: </b> <?php echo limitChars($result->nome_analista, 0); ?></span><?php }?>
     <br>
    <hr>
     <?php }
    ?>
    <br />
</fieldset> 

    <br />
    <br />
    <br />
    <br />
    <br />
    <span style="margin-left: 25%;"><b> _____________________________________</b></span><br />
    <span style="margin-left: 40%;"><b>Assinatura</b></span>

</div>
</section>
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
    
    
    
      $(document).ready(function () {
        $("#dta_inicio").mask("99/99/9999");
        $("#dta_inicio").datepicker({
            closeText: 'Fechar',
            prevText: '&#x3c;Anterior',
            nextText: 'Pr&oacute;ximo&#x3e;',
            currentText: 'Hoje',
            monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
        });
        
        
         $("#dta_fim").mask("99/99/9999");
        $("#dta_fim").datepicker({
            closeText: 'Fechar',
            prevText: '&#x3c;Anterior',
            nextText: 'Pr&oacute;ximo&#x3e;',
            currentText: 'Hoje',
            monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
        });
        });
</script>

