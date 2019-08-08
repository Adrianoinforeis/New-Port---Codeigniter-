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
       title: 'Relatório de reembolso gerais'
  },
  {
      extend: 'csv',
      text: 'Exportar .csv',
      title: 'Relatório de reembolso gerais em CSV'
      
   },
    {
      extend: 'excel',
      text: 'Exportar Excel',
      title: 'Relatório de reembolso gerais em Excel '
      
   },
   {
      extend: 'pdf',
      text: 'Exportar PDF',
      title: 'Relatório de reembolso gerais em PDF',
     //  messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
      
   },
   {
      extend: 'print',
      text: 'Imprimir',
       title: 'Relatório de reembolso gerais',
      
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
                <div class="container nao-imprime" style="width:98%;height:740px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                    <form method="post" name="" action="<?= base_url() ?>Intranet/filtro_relatorio">
                        <div class="col-md-12" style="margin-bottom: 5%;">
                            <div class="col-md-3">
                                <label>Início</label>
                                <input maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  style="height: 30px;" type="text" class="form-control" name="dta_inicio">
                            </div>
                            <div class="col-md-3">
                                <label>Fim</label>
                                <input maxlength="10" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)"  style="height: 30px;" type="text" class="form-control" name="dta_fim">
                            </div>
                            <div class="col-md-3">
                                <br />
                                <button type="submit" class="btn btn-success" name=""><i class="fa fa-check-circle" aria-hidden="true"></i> Pesquisar</button>
                            </div>
                        </div>
                    </form>
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
                                    <th style="font-size: 12px;">Visualizar</th>
                                    <th style="font-size: 12px;">Solicitante</th>
                                    <th style="font-size: 12px;">Cliente</th>
                                    <th style="font-size: 12px;">Data</th>
                                    <th style="font-size: 12px;">Andamento</th>
                                    <th style="font-size: 12px;">Status</th>
                                    <th style="font-size: 12px;">Categoria</th>
                                    <th style="font-size: 12px;">Tipo</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dados_geral['atendimentos'] as $result) {
                                    ?>
                                    <tr style="align-content: center;">
                                        <td class="text-center">
                                            <a style="float: left;" title="VISUALIZAR REQUISIÇÃO" class="btn btn-success btn-xs btn-mini" href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><b><?php echo limitChars($result->nome_atendimento, 2); ?></b></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo limitChars($result->nome_cliente, 1); ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo date('d/m/Y', strtotime($result->data_inicio)); ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->andamento; ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->status; ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->categoria; ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $result->tipo; ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                    <div class="col-md-4">
                        <br />
                        <link href="<?= base_url(); ?>assets/css/grade-impressao.css" rel="stylesheet">
                        <a href="JavaScript:window.print();"  name="imprimir" class="btn btn-primary"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
                    </div>
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
    <fieldset style="border-bottom: 1px solid"> <legend> DADOS DO REEMBOLSO </legend> 
    <?php foreach ($dados_geral['atendimentos'] as $result) {
                        ?>
        <span><b>SOLICITANTE: </b> <?php echo $result->nome_atendimento; ?></span> 
        <span style="float: right;"><b>TIPO: </b> <?php echo $result->tipo; ?></span><br> 

        <span><b>DATA DA SOLICITAÇÃO: </b> <?php echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?></span>  <span style="float: right;"><b>STATUS: </b> <?php echo $result->status; ?></span><br> 
      
        <span><b>CLIENTE: </b> <?php echo $result->nome_cliente; ?></span><span style="float: right;"><b> ANDAMENTO: </b> <?php echo $result->andamento; ?></span>
      
        <span><b>PRESTADOR: </b> <?php echo $result->nome_prestador; ?></span><span style="float: right;"><b> VALOR: </b> R$ <?php echo $result->valor_reembolso; ?></span>
      
    <?php if($result->criada_por != null){?><span><b>ATENDIMENTO CRIADO POR: </b> <?php echo limitChars($result->criada_por, 0); ?></span><?php } if($result->nome_analista != null){?><span style="float: right;"><b> FINALIZADO POR: </b> <?php echo limitChars($result->nome_analista, 0); ?></span><?php }?>
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
</script>


