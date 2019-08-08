$(document).ready(function() {			   
	$('#example').DataTable( {	
		"bDeferRender": true,			
		"sPaginationType": "full_numbers",					
		"oLanguage": {
            "sProcessing":     "Procesando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="20">20</option>'+
		        '<option value="30">30</option>'+
		        '<option value="40">40</option>'+
		        '<option value="50">50</option>'+
		        '<option value="60">60</option>'+
		        '<option value="-1">All</option>'+
		        '</select> registros',    
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
        }
	});
});