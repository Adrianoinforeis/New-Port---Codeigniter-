jQuery(function($) {
			
	
	var members = [{ id: "00000000001", de:null, pontose:"   75.460",pontosd:"    3.480",img:"vazio",boneco:"5", usuario: "modelo", lado:"Esquerdo",pessoais:"      615"},{ id: "06253967827", de:"00000000001", pontose:"   56.050",pontosd:"   18.850",img:"vazio",boneco:"5", usuario: "tony", lado:"Esquerdo",pessoais:"      560"},{ id: "40311827837", de:"00000000001", pontose:"      480",pontosd:"      880",img:"vazio",boneco:"5", usuario: "marceloti", lado:"Direito",pessoais:"    2.120"},{ id: "36136063484", de:"40311827837", pontose:"        0",pontosd:"        0",img:"vazio",boneco:"6", usuario: "ppp", lado:"Esquerdo",pessoais:"      480"},{ id: "15958986899", de:"06253967827", pontose:"   51.310",pontosd:"    2.800",img:"vazio",boneco:"5", usuario: "braz", lado:"Esquerdo",pessoais:"    1.940"},{ id: "39983389690", de:"40311827837", pontose:"        0",pontosd:"      560",img:"vazio",boneco:"6", usuario: "titi", lado:"Direito",pessoais:"      320"},{ id: "24710916870", de:"06253967827", pontose:"    9.300",pontosd:"    9.230",img:"vazio",boneco:"4", usuario: "doubleex02", lado:"Direito",pessoais:"      320"},{ id: "25573005863", de:"15958986899", pontose:"   23.160",pontosd:"   27.830",img:"vazio",boneco:"4", usuario: "tonibrasil", lado:"Esquerdo",pessoais:"      320"},{ id: "26261619859", de:"24710916870", pontose:"    8.795",pontosd:"      425",img:"vazio",boneco:"2", usuario: "doubleex2", lado:"Esquerdo",pessoais:"       80"},{ id: "28971583878", de:"24710916870", pontose:"      480",pontosd:"    7.830",img:"vazio",boneco:"5", usuario: "doubleex03", lado:"Direito",pessoais:"      920"},{ id: "47015830140", de:"39983389690", pontose:"        0",pontosd:"      320",img:"vazio",boneco:"6", usuario: "pppp", lado:"Direito",pessoais:"      240"},{ id: "20188106855", de:"15958986899", pontose:"      160",pontosd:"    2.400",img:"vazio",boneco:"3", usuario: "henrique", lado:"Direito",pessoais:"      240"},];
	           
	           (function heya( de ){
	               for(var i = 0; i < members.length; i++){
	                   var member = members[i];
	                   if(member.de === de){
	                	   var foto = member.img;
	                       var parent = de ? $("#containerFor" + de) : $("#mainContainer"),
	                           id = member.id,
	                               metaInfo = "<img height=50 src=../../module/modelo/View/img/"+foto+".png ><br>Usuário: " + member.usuario + "<br>Lado: " + member.lado + "<br>Pontos E: " + member.pontose + "<br>Pontos D: " + member.pontosd + "<br>Pessoais: " + member.pessoais + "";
	                       parent.append("<div class='container' id='containerFor" + id + "'><div class='member' ><img class='rede' nome="+id+" src=../../module/modelo/View/img/"+member.boneco+".png alt=Consultor class=img-rounded><br>" + member.usuario + "<div class='metaInfo'>" + metaInfo + "</div></div></div>");
	                       heya(id);
	                   } 
	               }
	            }( null ));

	           var pretty = function(){
	               var self = $(this),
	                   children = self.children(".container"),

	                   width = (100/children.length) - 2;
	               children
	                   .css("width", width + "%")
	                   .each(pretty);
	               
	           };
	           $("#mainContainer").each(pretty);
	
	
	
$(".rede").livequery('click', function(e) {
		
		$.ajax({
			   type: "POST",
			   url: 'binario_ajax',
			   dataType: "html",
			   success: function(res){
	
				   		$('#mainContainer').html('');
						$('#mainContainer').append(res);
						
						
					}
		});
		
		return false;
		
	});
	
		

});