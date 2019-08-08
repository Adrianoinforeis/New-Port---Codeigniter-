<div class="contentpanel"><!--Início da classe geral-->
    <!--**********************-->
    <?php
//seta a data para o estado sp
    date_default_timezone_set('America/Sao_Paulo');

//#########################################################################
    ?>
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
       title: 'Relatório de contratos'
  },
  {
      extend: 'csv',
      text: 'Exportar .csv',
      title: 'Relatório de contratos em CSV'
      
   },
    {
      extend: 'excel',
      text: 'Exportar Excel',
      title: 'Relatório de contratos em Excel '
      
   },
   {
      extend: 'pdf',
      text: 'Exportar PDF',
      title: 'Relatório de contratos em PDF',
     //  messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
      
   },
   {
      extend: 'print',
      text: 'Imprimir',
       title: 'Relatório de contratos detalhado',
      
   }
			//'copy', 'csv', 'excel', 'pdf', 'print'
		]
	} ); 

} );



</script>

    <div class="collapse navbar-collapse navbar-ex1-collapse">

    </div>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper nao-imprime">

    <div class="container-fluid">
        <!--CSS-->    




        <div class="span10">
            <!---Body content----------------------------------------------------->

            <div> 
                <!---Body content----------------------------------------------------->
                <div class="container nao-imprime" style="width:98%;height:840px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                    <div class="col-md-12" style="margin-bottom: 5%;">
                        <div class="row">
                            <div class="col-md-5">
                                <form method="post" name="" action="<?= base_url() ?>Intranet/relatorio_contratos">
                                    <input type="hidden" name="tipo" value="inicial">
                                    <div class="col-md-12"><label class="title">Relatório por vigência inicial</label></div>
                                    <div class="col-md-4">
                                        <label>De</label>
                                        <input value="<?php if($dados_geral['dados_pesquisa'] != null && $dados_geral['dados_pesquisa']['tipo'] == 'inicial'){echo $dados_geral['dados_pesquisa']['fim'];}?>" style="height: 30px;" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" class="form-control" name="dta_inicio">
                                    </div>
                                   <div class="col-md-4">
                                        <label>Até</label>
                                        <input value="<?php if($dados_geral['dados_pesquisa'] != null && $dados_geral['dados_pesquisa']['tipo'] == 'inicial'){echo $dados_geral['dados_pesquisa']['fim'];}?>" style="height: 30px;" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" class="form-control" name="dta_fim">
                                    </div>
                                    <div class="col-md-4">
                                        <br />
                                        <button type="submit" class="btn btn-success" name=""><i class="fa fa-check-circle" aria-hidden="true"></i> Pesquisar</button>
                                    </div>
                                </form>
                            </div>
                             <div class="col-md-5">
                                <form method="post" name="" action="<?= base_url() ?>Intranet/relatorio_contratos">
                                    <input type="hidden" name="tipo" value="final">
                                    <div class="col-md-12"><label class="title">Relatório por vigência final</label></div>
                                    <div class="col-md-4">
                                        <label>De</label>
                                        <input value="<?php if($dados_geral['dados_pesquisa'] != null && $dados_geral['dados_pesquisa']['tipo'] == 'final'){echo $dados_geral['dados_pesquisa']['inicio'];}?>" style="height: 30px;" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" class="form-control" name="dta_inicio">
                                    </div>
                                   <div class="col-md-4">
                                        <label>Até</label>
                                        <input value="<?php if($dados_geral['dados_pesquisa'] != null && $dados_geral['dados_pesquisa']['tipo'] == 'final'){echo $dados_geral['dados_pesquisa']['fim'];}?>" style="height: 30px;" maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" type="text" class="form-control" name="dta_fim">
                                    </div>
                                    <div class="col-md-4">
                                        <br />
                                        <button type="submit" class="btn btn-success" name=""><i class="fa fa-check-circle" aria-hidden="true"></i> Pesquisar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2">
                                <form method="post" name="" action="<?= base_url() ?>Intranet/relatorio_contratos_todos">
                                    <div class="col-md-3">
                                        <br />
                                        <br />
                                        <button type="submit" class="btn btn-success" name=""><i class="fa fa-check-circle" aria-hidden="true"></i> Listar Todos</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php  if($dados_geral['contratos'] != null){ ?>
                       <!--   <fieldset> <legend> <small> </small>  </legend> </fieldset>  --> 
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                    <div class="box-body table-responsive">

                        <table id="example" class="table table-bordered table-striped table-hover dataTable no-footer" arial-describedby="tablist_info" role="grid" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row" class="odd">
                                    <th style="font-size: 12px;">Detalhes</th>
                                    <th style="font-size: 12px;">Empresa</th>
                                    <th style="font-size: 12px;">Ramo</th>
                                    <th style="font-size: 12px;">Vigência Inicial</th>
                                    <th style="font-size: 12px;">Vigência Final</th>
                                    <th style="font-size: 12px;">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if($dados_geral['contratos'] != null){
                                foreach ($dados_geral['contratos'] as $result) {
                                    ?>
                                    <tr style="align-content: center;">
                                        <td class="text-center">
                                            <form method="post" action="<?= base_url(); ?>Intranet/edit_contratos" style="margin: 0; padding: 0; border: 0">
                                                <input type="hidden" value="<?php echo $result->cont_id; ?>" name="id_editar">
                                                <input type="hidden" value="<?php echo $result->cont_numero; ?>" name="numero_do_contrato">
                                                <button type="submit" value="" title="Alterar" name="alterar_user" id="alterar_user" class="btn btn-xs btn-success btn-mini" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i></button>
                                            </form>
                                        </td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo limitChars($result->nome_cliente, 2); ?></b></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->cont_ramo; ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo date('d/m/Y', strtotime($result->cont_vige_inic)); ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo date('d/m/Y', strtotime($result->cont_vig_fin)); ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->status; ?></td>
                                    </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                    <div class="col-md-4">
                        <br />
                        <link href="<?= base_url(); ?>assets/css/grade-impressao.css" rel="stylesheet">
                        <a href="JavaScript:window.print();"  name="imprimir" class="btn btn-primary"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
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



<!--
<div class="imprime" style="margin-top: -130%; height : 65px; border-bottom: 1px solid;">
    
</div>-->

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
    <fieldset style="border-bottom: 1px solid"> <legend> DADOS DO CONTRATO: </legend>
    <?php  if($dados_geral['contratos'] != null){
                    foreach ($dados_geral['contratos'] as $result) {
                        ?>
     
        <span><b>CLIENTE: </b> <?php echo $result->nome_cliente; ?></span> 
        <span style="float: right;"><b>RAMO: </b> <?php echo $result->cont_ramo; ?></span><br> 
      
        <span><b>VIGÊNCIA INICIAL: </b> <?php echo date('d/m/Y', strtotime($result->cont_vige_inic)); ?></span>  <span style="float: right;"><b>VIGÊNCIA FINAL: </b> <?php echo date('d/m/Y', strtotime($result->cont_vig_fin)); ?></span><br> 
       
        <span><b>STATUS DO CONTRATO: </b> <?php echo $result->status; ?></span><span style="float: right;"><b> NÚMERO DO CONTRATO: </b> <?php echo $result->cont_numero; ?></span>
        <hr>
    
                    <?php }
    }?>
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
</script> 