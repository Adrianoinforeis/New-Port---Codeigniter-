<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("a.menutoggle").trigger("click");
    });
</script>
<div class="contentpanel"><!--Início da classe geral-->
    <div id="page-wrapper">

        <div class="container-fluid nao-imprime" style="background-color: #fff; margin-bottom: 10%;">

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
            <?php
            $dominio = $_SERVER['HTTP_HOST'];
            $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
            ?>
            <div class="col-sm-9">
                <form style="margin-bottom: 5%;" method="post" action="<?= base_url(); ?>Cadastrar/filtro_faturamento">  
                    <input type="hidden" name="url" value="<?php echo $url; ?>">
                    <fieldset class="scheduler-border">
                        <div class="col-md-4 form-group">
                            <select class="form-control campos_form" name="mes_filtro" id="mes_filtro">
                                <option value="" selected="">Filtrar o Mês</option>
                                <?php for ($i = 01; $i <= 12; $i++) { ?>
                                    <option value="<?php echo $i; ?>" >
                                    <?php
                                    if($i == 01){echo 'Janeiro';}
                                    if($i == 02){echo 'Fevereiro';}
                                    if($i == 03){echo 'Março';}
                                    if($i == 04){echo 'Abril';}
                                    if($i == 05){echo 'Maio';}
                                    if($i == 06){echo 'Junho';}
                                    if($i == 07){echo 'Julho';}
                                    if($i == 8){echo 'Agosto';}
                                    if($i == 9){echo 'Setembro';}
                                    if($i == 10){echo 'Outubro';}
                                    if($i == 11){echo 'Novembro';}
                                    if($i == 12){echo 'Dezembro';}
                                    ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="col-md-4 form-group">
                            <select class="form-control campos_form" id="ano_filtro" name="ano_filtro" disabled="">
                                <option value="" selected="">FILTRAR ANO</option>
                                <?php for ($i = 2017; $i <= $dados_geral['maior_vencimento']; $i++) { ?>
                                    <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <button type="submit" class="btn btn-info" id="botao_filtro" disabled="" title="Filtrar"><i class="fa fa-filter" aria-hidden="true" title="Filtrar"></i></button>
                        </div>
                       <!--  <div class="col-md-2 form-group">
                             <a href="<?= base_url() ?>Intranet/cadastro_de_faturamento" class="btn btn-warning" id="botao_filtro" title="Voltar"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
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
                    //desabilita o campo para digitar o nome
                    $(function () {
                        $('#mes_filtro').change(function () {
                            $('#ano_filtro').removeAttr('disabled');  
                            //alert(val);
                            
                        });
                        $('#ano_filtro').change(function () {
                            $('#botao_filtro').removeAttr('disabled');
                        });
                    });
                </script>
                </fieldset>
                </form> 
            </div>

            <div class="col-sm-3" style="text-align:right;margin-bottom: 4%;">
                <a href="#" id="ger_fat_btn" onclick="verificaContratos();" title="Gerar Faturamento" class="btn btn-success"><i class="fa fa-save"></i> GERAR FATURAMENTO</a>
            </div>
            <style>
                #faturamento{
                    display: none;
                }
            </style>
            <?php if ($dados_geral['dados_faturamento'] != null) { ?>
                <style>
                    #faturamento{
                        display: block;
                    }
                </style>
                <!--Listando usuários-->
                <div class="col-md-12" id="faturamento">
                    <?php
                    foreach ($dados_geral['dados_faturamento'] as $item) {

                        $mes_atualiza = $item->mes_gerado;
                        $ano_atualiza = $item->ano_gerado;
                        if ($mes_atualiza != null) {
                            $mes = $mes_atualiza;
                            $ano = $ano_atualiza;
                        } else {
                            $mes = $_POST['mes_filtro'];
                            $ano = $_POST['ano_filtro'];
                        }
                    }

                    switch ($mes) {
                        case 1:
                            $valor = 'JANEIRO';
                            break;
                        case 2:
                            $valor = 'FEVEREIRO';
                            break;
                        case 3:
                            $valor = 'MARÇO';
                            break;
                        case 4:
                            $valor = 'ABRIL';
                            break;
                        case 5:
                            $valor = 'MAIO';
                            break;
                        case 6:
                            $valor = 'JUNHO';
                            break;
                        case 7:
                            $valor = 'JULHO';
                            break;
                        case 8:
                            $valor = 'AGOSTO';
                            break;
                        case 9:
                            $valor = 'SETEMBRO';
                            break;
                        case 10:
                            $valor = 'OUTUBRO';
                            break;
                        case 11:
                            $valor = 'NOVEMBRO';
                            break;
                        case 12:
                            $valor = 'DEZEMBRO';
                            break;
                        default:
                            break;
                    }
                    ?>
                    <legend class="legend" style="color: #cc0000;">FATURAMENTO DO MÊS: <?php echo $valor; ?>, ANO: <?php echo $ano; ?></legend>
                    <div class="table-responsive">
                        <script>
                            $(document).ready(function () {
                                $('[data-toggle="tooltip"]').tooltip();
                            });
                        </script>
<form method="post" style="margin: 0; border: 0; padding: 0;" action="<?= base_url() ?>Cadastrar/faturarContratos">
    <input type="hidden" value="" name="filtro_tabela" id="filtro_tabela_1">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr style="font-size: 10px;">
                                     <th>id</th>
                                    <th>CLIENTE</th>
                                    <th>CONTRATO</th>
                                    <th>RAMO</th>
                                    <th>DIA</th>
                                   <!-- <th>VIG.INI</th>
                                    <th>VIG. FIN.</th>-->
                                    
                                    <th>DTA ENVIO</th>
                                    <th>VIDAS</th>
                                    <th>VL. FATURA</th>
                                    <th>VENCIMENTO</th>
                                    <th>AÇAO</th>
                                    <th>ENVIO</th>

                                </tr>

                            </thead>

                            <tbody> 
                                
                                <?php  
                                $i = 0;
                                foreach ($dados_geral['dados_faturamento'] as $item) {
                                    ?>
                                    <tr>
                                         <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><?php echo $item->fat_id;?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><?php echo $item->nome_cliente;?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><?php echo $item->cont_numero; ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><?php echo $item->cont_ramo;?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><?php echo $item->cont_dta_vcto; ?></td>
                                       <!-- <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><?php echo date('d/m/Y', strtotime($item->cont_vige_inic)); ?></td>
                                        <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><?php echo date('d/m/Y', strtotime($item->cont_vig_fin)); ?></td>-->
                         
                                    <input type="hidden" name="url" value="<?php echo $url; ?>">
                                <?php //for($i =  0;  $i < $dados_geral['dados_faturamento'][0]->fat_id; $i++){?>
                                 
                                <?php //}?>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;"><?php if ($item->dta_envio == null) {
                                echo 'Não enviada';
                            } else {
                                echo $item->dta_envio;
                            } ?></td>
                                    <td><input ng-model="numero.valor" onblur="alteraqtdvidas(<?php echo  $item->fat_id;?>)" onkeyup="somenteNumeros(this);" style="font-size: 10px; width: 40px;" type="text" id="qtdvidas_<?php echo  $item->fat_id;?>"  <?php if ($item->vidas != null) { ?> value="<?php echo $item->vidas; ?>" <?php } else { ?> value="" <?php } ?> ></td>
                                    
                                    <td><input style="font-size: 10px; width: 70px;" type="text" id="dinheiro_<?php echo  $item->fat_id;?>"  class="dinheiro" onKeyUp="maskIt(this,event,'###.###.###,##',true)" name="vlfatura" <?php if ($item->vl_fatura != null) { ?> value="<?php echo number_format($item->vl_fatura, 2, ',', '.'); ?>" <?php } else { ?> value="" <?php } ?> ></td>
                                    <td><input style="font-size: 10px; height: 20px;" type="text" placeholder="xx/xx/xxxx" maxlength="10" <?php if ($item->vencimento == null || $item->vencimento == ''){}else if($item->vencimento != '' && $item->vencimento != null){ ?> value="<?php echo $item->vencimento; ?>" <?php } else { ?> value="" <?php } ?> id="vencimento_<?php echo  $item->fat_id;?>" onkeyup="maskNascimento(this)" onclick="maskNascimento(this)" onkeypress="maskNascimento(this)" name="vencimento" size="8"></td>
                                    <td class="text-center">
                                        <input type="hidden" id="mes_regenerado" value="<?php echo $item->mes_gerado; ?>" name="mes_regenerado">
                                        <input type="hidden" id="ano_regenerado" value="<?php echo $item->ano_gerado; ?>" name="ano_regenerado">
                                        <input type="hidden" id="id_da_fatura" value="<?php echo $item->fat_id; ?>" name="id_faturamento">
                                        <button title="ANEXAR FATURA" id="id_fat_anexo_<?php echo $item->fat_id; ?>" onclick="pegaanexo(<?php echo $item->fat_id; ?>);" type="button" class="btn btn-default btn btn-xs btn-minit" data-toggle="modal" data-target="#modal_anexos" 
                                                data-whatever_id_fatura="<?php echo $item->fat_id; ?>"
                                                data-whatever_mes="<?php echo $item->mes_gerado; ?>"
                                                data-whatever_ano="<?php echo $item->ano_gerado; ?>"
                                                data-whatever_do_cliente="<?php echo $item->id_clientes; ?>"
                                                class="btn btn-xs btn-success btn-mini"><i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                        </button>
                                        <button style="float: left;" title="ENVIAR E-MAILS" id="teste" type="button" class="btn btn-xs btn-info btn-mini" data-toggle="modal" data-target="#modal_emails" 
                                                data-whatever_id_fatura="<?php echo $item->fat_id; ?>"
                                                data-whatever_do_cliente="<?php echo $item->id_clientes; ?>"
                                                data-whatever_mes="<?php echo $item->mes_gerado; ?>"
                                                data-whatever_ano="<?php echo $item->ano_gerado; ?>"
                                                data-whatever_vencimento="<?php echo $item->vencimento; ?>"
                                                class="btn btn-xs btn-success btn-mini"><i class="fa fa-envelope" aria-hidden="true"></i> 
                                        </button>
                                        <button style="float: left;" type="button" value="" title="Gravar" name="" onclick="adiciona_dados(<?php echo $item->fat_id; ?>);" id="" class="btn btn-xs btn-success btn-mini"><i class="fa fa-check-circle" aria-hidden="true" title="GRAVAR"></i></button> 
                                    </td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 10px;">
                                        <?php if ($item->email_enviado == 1) { ?>
                                        <a href="" data-toggle="modal" onclick="faturasEmailsEnviados(<?php echo $item->fat_id; ?>);" data-target=".emailsenviadosfat-lg">   <img style="margin-top: -2%;" src="<?= base_url(); ?>assets\images\check.png" height="20" width="" class="img" title="ABRIR RELAÇÃO DE ENVIO DE E-MAIL">
                                        </a>
                                <?php } else { ?> 
                                        <select name="" id="checkfatura_<?php echo $item->fat_id; ?>" onchange="alteraenvioedata(<?php echo $item->fat_id; ?>);" class="" style="height: 25px;">
                                            <option value="">--</option>
                                            <option value="1">Sim</option>
                                        </select>
                                            <!--<img style="margin-top: -2%;" src="<?= base_url(); ?>assets\images\check.png" height="20" width="" class="img" title="FATURA JÁ ENVIADA">-->
                                <?php } ?>
                                    </td>
                               
                                </tr>
                            <?php
                            }
                            ?>
                                
                            </tbody>
                        </table>
                     </form>
                    </div> 
                     <div class="col-md-4">
                        <br />
                        <link href="<?= base_url(); ?>assets/css/grade-impressao.css" rel="stylesheet">
                        <a href="JavaScript:window.print();"  name="imprimir" class="btn btn-primary"> <i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
                    </div>
                </div><!--faturamento-->
                 <script>
    function somenteNumeros(num) {
        var er = /[^0-9]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
          campo.value = "";
        }
        
    }
 </script>
<script type="text/javascript">
    function alteraqtdvidas(id){
        var qtd = $('#qtdvidas_'+ id).val();
        var base_url = '<?php echo base_url()?>';
     $.post(base_url + 'Ajax/AlteraqtdPessoas', {
            qtd: qtd,  id_da_fatura: id
        }, function (data) {}); 
        
        alert('Quantidade de vidas alterada com sucesso !');
    }
    function alteraenvioedata(id){
     var base_url = '<?php echo base_url()?>';
     $.post(base_url + 'Ajax/AlterafaturasEmailsEnviados', {
            id_da_fatura: id
        }, function (data) {}); 
     alert('Data de envio e check adicionado com sucesso !');   
    }
function maskIt(w,e,m,r,a){
// Cancela se o evento for Backspace
if (!e) var e = window.event
if (e.keyCode) code = e.keyCode;
else if (e.which) code = e.which;
// Variáveis da função
var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
var mask = (!r) ? m : m.reverse();
var pre  = (a ) ? a.pre : "";
var pos  = (a ) ? a.pos : "";
var ret  = "";
if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
// Loop na máscara para aplicar os caracteres
for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
if(mask.charAt(x)!='#'){
ret += mask.charAt(x); x++; } 
else {
ret += txt.charAt(y); y++; x++; } }
// Retorno da função
ret = (!r) ? ret : ret.reverse()	
w.value = pre+ret+pos; }
// Novo método para o objeto 'String'
String.prototype.reverse = function(){
return this.split('').reverse().join(''); };
</script>
<script type="text/javascript">
    $(document).ready(function () {
     var recebevalor = '<?php echo  $dados_geral['filtro_tabela'];?>';
     var table = $('#example').DataTable();
     $("#input_filtro_fat").blur(function () {
      table.search( this.value ).draw();
      var valor_input = $(this).val();
       $("#filtro_tabela").val(valor_input);
        $("#filtro_tabela_2").val(valor_input);
        $("#filtro_tabela_1").val(valor_input);
//        var maximo = '<?php //echo $dados_geral['dados_faturamento'][0]->fat_id;?>';
//         
//        var i;
//        for (i = 0; i < maximo.length; i++) { 
//        $("#filtro_tabela_1"+i).val(valor_input);
//        }
        
        
        
    });
    
    $("#input_filtro_fat").val(recebevalor);
    document.getElementById('input_filtro_fat').focus();
    $("#input_filtro_fat").val(recebevalor + ' ');
    $("#input_filtro_fat").keyup(function () {
        document.getElementById('input_filtro_fat').focus();
       // $("#input_filtro_fat").val(recebevalor);
         //document.getElementById('mes_filtro').focus();
    });
    
    if(recebevalor != '' || recebevalor != null){
//var table = $('#example').DataTable();
//$('#input_filtro_fat').blur(function () {
   // table.search( this.value ).draw();
   document.getElementById('mes_filtro').focus();
//});
    }
    
    
    


    
    
   // $("#input_filtro_fat").val(recebevalor);
   
   
//var atualizaDiv = setInterval(function(){
//var recebevalor = '<?php echo  $dados_geral['filtro_tabela'];?>';
//document.getElementById('input_filtro_fat').focus();
//$("#input_filtro_fat").val(recebevalor + ' ');
//$('#input_filtro_fat').fadeOut("slow").load('#');
////location.reload()
//      }, 3000
//  );


//});

//$(document).ready(function(){

//}); 
    });
    </script>
 <script type="text/javascript">
//$(document).ready(function () {
//var recebevalor = $('#input_filtro_fat').val(); 
//var recebevalor2 = '<?php echo  $dados_geral['filtro_tabela'];?>';
//if(recebevalor != '' || recebevalor != null || recebevalor2 != '' || recebevalor2 != null){
//var table = $('#example').DataTable();
//$('#input_filtro_fat').blur(function () {
//    table.search( this.value ).draw();
//});
//}
//    });
</script>
<?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
//$(document).ready(function() {
//    // Setup - add a text input to each footer cell
//    $('#example tfoot th').each( function () {
//        var title = $(this).text();
//        $(this).html( '<input size="5" type="text" class="form-control" placeholder="Search '+title+'" />' );
//    } );
// 
//    // DataTable
//    var table = $('#example').DataTable();
// 
//    // Apply the search
//    table.columns().every( function () {
//        var that = this;
// 
//        $( 'input', this.footer() ).on( 'keyup change', function () {
//            if ( that.search() !== this.value ) {
//                that
//                    .search( this.value )
//                    .draw();
//            }
//        } );
//    } );
//} );
</script>

<?php if ($dados_geral['dados_faturamento'] != null) { ?>

<div class="imprime" style="margin-top: -1%; height : 65px; border-bottom: 1px solid;">
    <div class="conteudo" style="margin-top: -10%; height : 65px; border-bottom: 1px solid" >
        <br>
        <div style="position: relative ; top: 6px;"><img style="float : left; width: 20%;" width="10px;" src="<?= base_url(); ?>assets/images/logo.JPG" /></div>
        <br>
        <!--span style="font-size:20px;">GPA Web 1.0</span-->
        <span style="font-size:13px; margin-left:20px;">Rua Apeninos, 485 – Paraíso – São Paulo – SP - Telefone: (11) 4810 2041</span>

    </div>
    <br>
    <br>
    <fieldset style="border-bottom: 1px solid"> <legend> DADOS DO FATURAMENTO: </legend>
    <?php foreach ($dados_geral['dados_faturamento'] as $result) {
                        ?>
     
        <span><b>CLIENTE: </b> <?php echo $result->nome_cliente; ?></span> <br />
        <span><b>CONTRATO: </b> <?php echo $result->cont_numero; ?></span>
        <span style="margin-left: 10%;"><b>DATA DE CORTE: </b> <?php echo $result->cont_dta_vcto; ?></span> 
        <span style="float: right"><b>ANEXOU FATURA: </b>
        <?php if ($item->dta_envio == null) {
                                echo 'Não';
                            } else {
                                echo $item->dta_envio;
                                } ?>
        </span><br />
        <span style="">VALOR: $<b><?php echo $item->vl_fatura; ?></b></span>
        <span style="float: right;"><b>FOI ENVIADO E-MAIL</b> <?php if ($item->email_enviado == 1) { ?>
        <img style="margin-top: -2%;" src="<?= base_url(); ?>assets\images\check.png" height="20" width="" class="img" title="FATURA JÁ ENVIADA">
        <?php } else {     echo 'Não enviado';} ?>
        </span>
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
<?php }?>


 <div class="modal fade emailsenviadosfat-lg" id="modal_veremailslist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document" style="margin-left: 35%;  margin-top: 10%; width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel"><marquee>Relação de e-mails enviados!</marquee></h4>
                                                </div>
                                                <div class="panel-body panel-body-nopadding">
                                                    <div class="col-md-12" style="margin-bottom: 5%;" >
                                                        <div class="table-responsive">
                                                        <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>EMAIL</th>
                                                                </tr>

                                                            </thead>
                                                            <tbody id="emails_fatura_enviados"> 
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<script type="text/javascript">
    function faturasEmailsEnviados(id){
     var base_url = "<?php echo base_url(); ?>"
//    $(document).ready(function(){
//      $('#modal_anexos').modal('show');  
//    });
    $.post(base_url + 'Ajax/faturasEmailsEnviados', {
            id_da_fatura: id
        }, function (data) {
            // console.log(data); 
            $('#emails_fatura_enviados').html(data);
        });
        }
    </script>
<!-- Modal anexos-->
<div class="modal fade" id="modal_anexos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>Intranet/uploadArquivosFaturamento">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Anexar arquivo (s)</h4>
                    </div>

                    <div class="modal-body">

                        <div id="msgUsu2"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="filtro_tabela" id="filtro_tabela_2">
                                <?php //if($dados_geral['retorno'] == null){?>
                                <input type="hidden" name="id_do_cliente" id="id_do_cliente">
                                <input type="hidden" name="id_atend" id="id_atend">
                                <input type="hidden" name="id_fatura" id="id_fatura">
                                <input type="hidden" name="mes" id="mes">
                                <input type="hidden" name="ano" id="ano">
                                <?php //}else{?>
                               <!-- <input type="hidden" value="<?php echo $dados_geral['retorno']['id_do_cliente'];?>" name="id_do_cliente" id="">
                                <input type="text" value="<?php echo $dados_geral['retorno']['id_faturamento'];?>" name="id_fatura" id="">
                                <input type="hidden" value="<?php echo $dados_geral['retorno']['mes'];?>" name="mes" id="">
                                <input type="hidden" value="<?php echo $dados_geral['retorno']['ano'];?>" name="ano" id="">-->
                                <?php //}?>
                                <label for="Paciente">FAZER UPLOAD: </label>
                                <div class="col-md-12 form-group">
                                    <input type="file" name="arquivo" class="form-control" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" maxlength="20" name="descricao" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ANEXOS(S)</th>
                                            </tr>

                                        </thead>
                                         <?php //if($dados_geral['retorno'] == null){?>
                                        <tbody id="anexo_resultado"> 
                                        </tbody>

                                    </table>
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
<!-- anexos fim -->

<!-- Modal anexos-->
<div class="modal fade" id="modal_anexos_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="<?= base_url(); ?>Intranet/uploadArquivosFaturamento">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Anexar arquivo (s)</h4>
                    </div>

                    <div class="modal-body">

                        <div id="msgUsu2"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php if($dados_geral['retorno'] == null){?>
                              <!--  <input type="hidden" name="id_do_cliente" id="id_do_cliente">
                                <input type="hidden" name="id_atend" id="id_atend">
                                <input type="hidden" name="id_fatura" id="id_fatura">
                                <input type="hidden" name="mes" id="mes">
                                <input type="hidden" name="ano" id="ano">-->
                                <?php }else{?>
                                 <input type="hidden" name="filtro_tabela" id="filtro_tabela_9" value="<?php echo $_GET['filtro_tabela'];?>">
                                <input type="hidden" value="<?php echo $dados_geral['retorno']['id_do_cliente'];?>" name="id_do_cliente" id="">
                                <input type="hidden" value="<?php echo $dados_geral['retorno']['id_faturamento'];?>" name="id_fatura" id="">
                                <input type="hidden" value="<?php echo $dados_geral['retorno']['mes'];?>" name="mes" id="">
                                <input type="hidden" value="<?php echo $dados_geral['retorno']['ano'];?>" name="ano" id="">
                                <?php }?>
                                <label for="Paciente">FAZER UPLOAD: </label>
                                <div class="col-md-12 form-group">
                                    <input type="file" name="arquivo" class="form-control" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" maxlength="20" name="descricao" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table id="" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ANEXOS(S)</th>
                                            </tr>

                                        </thead>
                                         <tbody id="anexo_resultado_show"> 
                                        </tbody>
                                    </table>
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
<?php if($dados_geral['retorno'] != null){?>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>"
    $(document).ready(function(){
    $.post(base_url + 'Ajax/getAnexosFaturamento', {
            id_da_fatura: '<?php echo $dados_geral['retorno']['id_faturamento'];?>',  
            url: '<?php echo $url;?>'
        }, function (data) {
            // console.log(data); 
            $('#anexo_resultado_show').html(data);
        });
        $('#modal_anexos_show').modal('show'); 
         });
    
    </script>
<?php }?>
 <script type="text/javascript">
//    function pegaanexo(id){
//    var base_url = "<?php echo base_url(); ?>"
//    $(document).ready(function(){
//      $('#modal_anexos').modal('show');  
//    });
//    $.post(base_url + 'Ajax/getAnexosFaturamento', {
//            id_da_fatura: id,  
//            url: '<?php echo $url;?>'
//        }, function (data) {
//            // console.log(data); 
//            $('#anexo_resultado_show').html(data);
//        });
//        }
    </script>
    
    
<!-- Modal envia e-mails -->
<div class="modal fade" id="modal_emails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">

                <form method="post" action="<?= base_url(); ?>EnviaEmail/enviandoemailCliente">
                    <div class="col-md-7">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title" id="myModalLabel">Envio de e-mails</h4>
                        </div>

                        <div class="modal-body">

                            <div id="msgUsu2"></div>

                            <div class="row">
                                <input type="hidden" name="filtro_tabela" id="filtro_tabela">
                                <input type="hidden" name="mes" id="mes">
                                <input type="hidden" name="ano" id="ano">
                                <input type="hidden" name="id_cliente" id="id_cliente">
                                <input type="hidden" name="id_fatura" id="id_fatura">
                                <input type="hidden" name="fat_vencimento" id="fat_vencimento"

                                       <div class="table-responsive">
                                    <table id="exemple" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>EMAIL DO CLIENTE</th>
                                                <th></th>
                                            </tr>

                                        </thead>
                                        <tbody id="mail_resultado"> 

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <td>
                                <div class="col-md-12 form-group" style="margin-left: 3%;">
                                    <input type="text" name="email_opcional" class="form-control" placeholder="UM OUTRO E-MAIL" id="">

                                </div>
                            </td>
                            <div class="col-md-12 form-group" style="margin-bottom: 3%; margin-left: 3%;" >
                                <label>Detalhes das faturas (Opcional)</label>
                                <textarea class="form-control" name="detalhes" rows="2" cols="12"></textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Anexos do cliente</h4>
                            </div>
                            <div class="table-responsive">
                                <table id="exemple" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Check</th>
                                            <th>Anexo</th>
                                        </tr>

                                    </thead>
                                    <tbody id="anexos_resultado"> 

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-10">
                                    <button style="float: right;" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</button>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" onclick="disparaEmail();" class="btn btn-success"><i class="fa fa-envelope" aria-hidden="true"></i> ENVIAR</button>
                                </div>
                            </div>
                        </div>

                </form>
            </div>
        </div><!-- modal-content -->
    </div>
</div>
</div><!-- modal-dialog -->
<!-- MODL Anexo -->
<!--<div class="modal fade visualizar-modal-lg" id="modal_anexo_img" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:800px; margin-top: 5%; margin-left: 5%;">
            <div class="modal-content">
            <img id="img_associado" style="width: 800px; margin-left: 0; border: 0;" src="" class="img img">
            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>-->
<!-- modal -->
<!-- modal -->
<script type="text/javascript">
    function ver_arquivo(id_img){
//        var base_url = "<?php echo base_url(); ?>"
//        var dados = {
//         id_img: id_img
//       }
//        $.post(base_url + 'Ajax/getAnexoAssociado', dados, function(retorno) {
//        var res = $.parseJSON(retorno)
//        var arquivo = res[0].arquivo;  
//        var base = '<?php echo base_url();?>';
//        var dir = 'anexos/';
//        $('#img_associado').attr('src',base+dir+arquivo);
//        $('#modal_anexo_img').modal('show');  
//        });
//    }
</script>  
<script type="text/javascript">

    var base_url = "<?php echo base_url(); ?>"
    ///alteração de planos
    $('#modal_emails').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var whatever_do_cliente = button.data('whatever_do_cliente') // Extract info from data-* attributes
        var whatever_mes = button.data('whatever_mes')
        var whatever_ano = button.data('whatever_ano')
        var whatever_id_fatura = button.data('whatever_id_fatura')
        var whatever_vencimento = button.data('whatever_vencimento')
        var modal = $(this)
        //  modal.find('.modal-title').text('ID do Dependente: ' + whatever_id)

        modal.find('#id_cliente').val(whatever_do_cliente)
        modal.find('#mes').val(whatever_mes)
        modal.find('#ano').val(whatever_ano)
        modal.find('#id_fatura').val(whatever_id_fatura)
        modal.find('#fat_vencimento').val(whatever_vencimento)
        // alert(whatever_id_beneficiario);
        $.post(base_url + 'Ajax/getEmailsClientes', {
            id_cliente: whatever_do_cliente
        }, function (data) {
            // console.log(data); 
            $('#mail_resultado').html(data);
        });
//pega anexos do cliente
        $.post(base_url + 'Ajax/getAnexosCliente', {
            id_fatura: whatever_id_fatura,
            mes: whatever_mes,
            ano: whatever_ano
        }, function (data) {
            // console.log(data); 
            $('#anexos_resultado').html(data);
        });


    })



    $('#modal_anexos').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var whatever_id_fatura = button.data('whatever_id_fatura') // Extract info from data-* attributes
        var whatever_id_atend = button.data('whatever_id_atend_file')
        var whatever_mes = button.data('whatever_mes')
        var whatever_ano = button.data('whatever_ano')
        var whatever_do_cliente = button.data('whatever_do_cliente');
        var modal = $(this)
        //  modal.find('.modal-title').text('ID do Dependente: ' + whatever_id)
        modal.find('#id_do_cliente').val(whatever_do_cliente)
        modal.find('#id_fatura').val(whatever_id_fatura)
        modal.find('#mes').val(whatever_mes)
        modal.find('#ano').val(whatever_ano)
        modal.find('#id_atend').val(whatever_id_atend)
        // alert(whatever_id_beneficiario);
        $.post(base_url + 'Ajax/getAnexosFaturamento', {
            id_da_fatura: whatever_id_fatura,
            url: '<?php echo $url;?>'
        }, function (data) {
            // console.log(data); 
            $('#anexo_resultado').html(data);
        });

    })

</script>
<script type="text/javascript">
    function adiciona_dados(id) {
       var base_url = "<?php echo base_url(); ?>";
            var ano_regenerado = $('#ano_regenerado').val();
            var mes_regenerado = $('#mes_regenerado').val();
            var valor = $('#dinheiro_'+id).val();
            var vencimento = $('#vencimento_'+id).val();
            var filtro_tabela = $('#filtro_tabela_1').val();
            
            $.post(base_url + 'Cadastrar/faturarContratos', {
                id_faturamento: id,
                filtro_tabela: filtro_tabela,
                vencimento: vencimento,
                vlfatura: valor,
                ano_regenerado: ano_regenerado,
                mes_regenerado: mes_regenerado
            }, function (data) {
                alert("Dados alterado com sucesso!")
                //console.log(data); //imprime com f12
                // $('#operadoras').html(data);
                // $('#operadoras').removeAttr('disabled');
            });
    }
    
    

    function funcao()
    {
        alert("Dados alterado com sucesso");
    }
 function download_baixar(id){
 var id_arquivo = id;
 var base_url = "<?php echo base_url(); ?>";
 var arquivo = $('#download_anexo_'+id_arquivo).val();
 var des = $('#desc_'+id_arquivo).val();
 var deslimp = des.split('_');

 
 $.post(base_url + 'Ajax/baixar_fat', {
                arquivo: arquivo,
        }, function (data) {
            if(data == 'tem'){
            location.href = base_url + 'Cadastrar/baixar?arquivo='+ arquivo +'&des='+ deslimp[0];
            }else{
             alert('Arquivo não localizado !')   
            }
    });
}
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("input.dinheiro").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "."});
    });
</script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
</div><!--Fim cadastro-->
</div><!-- mainpanel -->
</section>

<!-- Modal -->
<div class="modal fade inserir_modal-modal-lg" id="gerFat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 40%; margin-top: 10%;">
        <div class="modal-content" style="width: 300px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">FATURAMENTO</h4>
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
                    function deletar(id, mes, ano, idfatura, idcliente) {
                        if (confirm("Deseja remover esse anexo?")) {
                            var filtro_tabela = $("#input_filtro_fat").val();
                            window.location = "<?= base_url(); ?>Deletar/faturamento?acao=deletar&id=" + id + "&mes=" + mes + "&ano=" + ano + "&idfatura=" + idfatura + "&idcliente=" + idcliente + "&filtro_tabela="+ filtro_tabela +"&url=<?php echo $url; ?>";
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
                    <form action="<?= base_url(); ?>cadastrar/cadastrar_faturamento?url=<?= $url; ?>" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                        <input type="hidden" name="url" value="<?php echo $url; ?>">
                        <div class="tab-content">


                            <div class="active tab-pane" id="aba1">

                                <div class="row fluid">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="empresa" class="control-label">MÊS</label>
                                            <select class="form-control campos_form" id="mes" name="mes">
                                                <option value="" >SELECIONE O MÊS</option>
                                                    <?php for ($i = 01; $i <= 12; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="empresa" class="control-label">ANO</label>
                                            <select class="form-control campos_form" id="ano" name="ano">
                                                <option value="" >SELECIONE O ANO</option>
<?php for ($i = 2017; $i <= $dados_geral['maior_vencimento']; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>                               

                            </div>
                        </div> 
                        <div class="col-md-6">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button type="submit"  title="Gerar" id="pes_ass" name="btn_abcham" class="btn btn-xs btn-mini btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> GERAR</button>
                        </div>
                        <div class="col-md-6">
                            <br />
                            <button title="Cancelar" data-dismiss="modal" aria-hidden="true" class="btn btn-xs btn-mini btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> CANCELAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade pes-modal-lg" id="modal_pesquisando" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: 35%;  margin-top: 10%; width: 450px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel"><marquee>Processando, por favor aguarde..</marquee></h4>
            </div>
            <div class="panel-body panel-body-nopadding">
                <div class="col-md-12" style="margin-bottom: 5%;" >
                    <img style="width: 30%; margin-left: 30%;" width="10px;" src="<?= base_url(); ?>assets/images/loading2.gif" />
                </div>
            </div>
        </div>
    </div>
</div>
<!--fim pesquisando-->




<!--Função para validar numeros e cpf, telefone-->
<script type="text/javascript">
    $(document).ready(function () {
     $("#pes_ass").click(function () {
       $('#gerFat').modal('hide');
       $(document).ready(function(){
        $('#modal_pesquisando').modal('show');  
        });  
      if(!$(this).disabled){
      var oldText = $(this).html();
      $(this).disabled = true;
      
       setTimeout(function () {
        $(this).disabled = false;
        $(this).html(oldText);
        }.bind(this), 40000);
       }
    });
    });
   function verificaContratos(){
    var base_url = "<?php echo base_url(); ?>";
    $.post(base_url + 'Ajax/getContratosNovos', {
        }, function (data) {
            if(data == 'ok'){
            $('#gerFat').modal('show');
            }else{
            $('#ger_fat_btn').html("<i class='fa fa-times' aria-hidden='true'></i> NÃO POSSUI NOVOS CONTRATOS");  
            setTimeout(function(){    
                    $('#ger_fat_btn').html("<i class='fa fa-save'></i> GERAR FATURAMENTO");                   
                    obtemQuartos();
                }, 900);
            }
    });
    // $('#cadastrar').modal('hide');
//        $(document).ready(function(){
//        $('#gerFat').modal('show');
//    });
   } 
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

<script type="text/javascript">
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
            $.post(base_url + 'Ajax/getOperadorasRamo', {
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
</script>