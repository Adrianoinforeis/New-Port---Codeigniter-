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
<div id="page-wrapper nao-imprime">

    <div class="container-fluid">
        <div class="span10">
            <div> 
                <!---Body content----------------------------------------------------->
                <div class="container nao-imprime" style="width:98%;height:740px;border:1px solid #D6D6D6; padding:4px;margin-top:4px;margin-bottom:4px;overflow-x:hidden;border-radius:7px; background-color: #FFF;"> 
                    <form method="post" name="" action="<?= base_url() ?>Intranet/filtro_relatorio_outros_atendimentos">
                        <div class="col-md-12" style="margin-bottom: 5%;">
                            <div class="col-md-2">
                                <br />
                                <button data-toggle="modal" data-target=".usuarios-modal-lg" style="height: 60px; width: 90%; " type="button" class="btn btn-success" name=""><i class="fa fa-user" aria-hidden="true"></i> Usuários</button>
                            </div>
                            <div class="col-md-2" style="margin-left: 4%;">
                                <br />
                                <button  data-toggle="modal" data-target=".solicitacoes-modal-lg"  style="height: 60px; width: 90%;" type="button" class="btn btn-success" name=""><i class="fa fa-history" aria-hidden="true"></i> Solicitações</button>
                            </div>
                            <div class="col-md-2" style="margin-left: 4%;">
                                <br />
                                <button data-toggle="modal" data-target=".cliente-modal-lg" style="height: 60px; width: 90%;" type="button" class="btn btn-success" name=""><i class="fa fa-users" aria-hidden="true"></i> Clientes</button>
                            </div>
                            <div class="col-md-2" style="margin-left: 4%;">
                                <br />
                                <button data-toggle="modal" data-target=".categorias-modal-lg" style="height: 60px; width: 90%;" type="button" class="btn btn-success" name=""><i class="fa fa-book" aria-hidden="true"></i> Categorias</button>
                            </div>
                            <div class="col-md-2" style="margin-left: 4%;">
                                <br />
                                <button data-toggle="modal" data-target=".status-modal-lg" style="height: 60px; width: 90%;" type="button" class="btn btn-success" name=""><i class="fa fa-anchor" aria-hidden="true"></i> Status</button>
                            </div>
                        </div>
                    </form>
                     <!--   <fieldset> <legend> <small> </small>  </legend> </fieldset>  --> 
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                    <div class="col-md-12" style="margin-top: 10%">
                        <?php if($dados_geral['dados_analista'] != null){?>
                        <div id="piechart_3d" style="margin-left: 10%;"></div>
                        <?php }?>
                        
                        <?php if($dados_geral['dados_solicitacao'] != null){?>
                        <div id="piechart_3d" style="margin-left: 14%;"></div>
                        <?php }?>
                        
                         <?php if($dados_geral['dados_clientes'] != null){?>
                        <div id="piechart_3d" style="margin-left: 14%;"></div>
                        <?php }?>
                        
                         <?php if($dados_geral['dados_categorias'] != null){?>
                        <div id="piechart_3d" style="margin-left: 14%;"></div>
                        <?php }?>
                        
                         <?php if($dados_geral['dados_status'] != null){?>
                        <div id="piechart_3d" style="margin-left: 14%;"></div>
                        <?php }?>
                    </div>
                </div>
            </div>


<!-- Carregar a API do google -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- Preparar a geracao do grafico -->
    <script type="text/javascript">

      // Carregar a API de visualizacao e os pacotes necessarios.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Especificar um callback para ser executado quando a API for carregada.
      google.setOnLoadCallback(desenharGrafico);

      /**
       * Funcao que preenche os dados do grafico
       */
      <?php if($dados_geral['dados_analista'] != null){?>
          
        <?php 
        $fin = 0;
        $aber = 0;
        $atend = 0;
        foreach ($dados_geral['dados_analista'] as $value) {
            $fins = $value->andamento;
           if($fins == 'FINALIZADO'){
               $fin ++;   
          }else  if($fins == 'ABERTO'){
               $aber ++;   
          }else  if($fins == 'EM ATENDIMENTO'){
               $atend ++;   
          }
        }
?>
      function desenharGrafico() {
        // Montar os dados usados pelo grafico
        var dados = new google.visualization.DataTable();
        dados.addColumn('string', 'Gênero');
        dados.addColumn('number', 'Quantidades');
        //dados.addColumn('number', 'Total');
        dados.addRows([
            
          ['FINALIZADOS: <?php echo $fin;?>', <?php echo $fin;?>],
          ['ABERTOS: <?php echo $aber;?>', <?php echo $aber;?>],
          ['EM ATENDIMENTO: <?php echo $atend;?>', <?php echo $atend;?>],
    
        ]);
        // Configuracoes do grafico
        var config = {
            'title': '<?php echo $dados_geral['title'];?>:  <?php if($dados_geral['title'] != 'TODOS'){echo $dados_geral['dados_analista'][0]->nome_analista;}?>',
            'width':800,
            'height':400
        };

        // Instanciar o objeto de geracao de graficos de pizza,
        // informando o elemento HTML onde o grafico sera desenhado.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

        // Desenhar o grafico (usando os dados e as configuracoes criadas)
        chart.draw(dados, config);
      }
      <?php }?>
  
    //############### Solicitações ###################################################>
  <?php if($dados_geral['dados_solicitacao'] != null){?>
          
        <?php 
        $fin = 0;
        $aber = 0;
        $atend = 0;
        foreach ($dados_geral['dados_solicitacao'] as $value) {
            $fins = $value->andamento;
           if($fins == 'FINALIZADO'){
               $fin ++;   
          }else  if($fins == 'ABERTO'){
               $aber ++;   
          }else  if($fins == 'EM ATENDIMENTO'){
               $atend ++;   
          }
        }
?>
      function desenharGrafico() {
        var dados = new google.visualization.DataTable();
        dados.addColumn('string', 'Gênero');
        dados.addColumn('number', 'Quantidades');
        dados.addRows([  
          ['FINALIZADOS: <?php echo $fin;?>', <?php echo $fin;?>],
          ['ABERTOS: <?php echo $aber;?>', <?php echo $aber;?>],
          ['EM ATENDIMENTO: <?php echo $atend;?>', <?php echo $atend;?>],
        ]);
        var config = {
            'title': '<?php echo $dados_geral['title'];?>',
            'width':750,
            'height':400
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(dados, config);
      }
      <?php }?>
  
  
  
  //############### Clientes ###################################################>
  <?php if($dados_geral['dados_clientes'] != null){?>
          
        <?php 
        $fin = 0;
        $aber = 0;
        $atend = 0;
        foreach ($dados_geral['dados_clientes'] as $value) {
            $fins = $value->andamento;
           if($fins == 'FINALIZADO'){
               $fin ++;   
          }else  if($fins == 'ABERTO'){
               $aber ++;   
          }else  if($fins == 'EM ATENDIMENTO'){
               $atend ++;   
          }
        }
?>
      function desenharGrafico() {
        var dados = new google.visualization.DataTable();
        dados.addColumn('string', 'Gênero');
        dados.addColumn('number', 'Quantidades');
        dados.addRows([  
          ['FINALIZADOS: <?php echo $fin;?>', <?php echo $fin;?>],
          ['ABERTOS: <?php echo $aber;?>', <?php echo $aber;?>],
          ['EM ATENDIMENTO: <?php echo $atend;?>', <?php echo $atend;?>],
        ]);
        var config = {
            'title': '<?php echo $dados_geral['title'];?>',
            'width':750,
            'height':400
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(dados, config);
      }
      <?php }?>
  
    //############### Clientes ###################################################>
  <?php if($dados_geral['dados_categorias'] != null){?>
          
        <?php 
        $fin = 0;
        $aber = 0;
        $atend = 0;
        foreach ($dados_geral['dados_categorias'] as $value) {
            $fins = $value->andamento;
           if($fins == 'FINALIZADO'){
               $fin ++;   
          }else  if($fins == 'ABERTO'){
               $aber ++;   
          }else  if($fins == 'EM ATENDIMENTO'){
               $atend ++;   
          }
        }
?>
      function desenharGrafico() {
        var dados = new google.visualization.DataTable();
        dados.addColumn('string', 'Gênero');
        dados.addColumn('number', 'Quantidades');
        dados.addRows([  
          ['FINALIZADOS: <?php echo $fin;?>', <?php echo $fin;?>],
          ['ABERTOS: <?php echo $aber;?>', <?php echo $aber;?>],
          ['EM ATENDIMENTO: <?php echo $atend;?>', <?php echo $atend;?>],
        ]);
        var config = {
            'title': '<?php echo $dados_geral['title'];?>',
            'width':750,
            'height':400
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(dados, config);
      }
      <?php }?>
  
    //############### Status ###################################################>
  <?php if($dados_geral['dados_status'] != null){?>
          
        <?php 
        $fin = 0;
        $aber = 0;
        $atend = 0;
        foreach ($dados_geral['dados_status'] as $value) {
            $fins = $value->andamento;
           if($fins == 'FINALIZADO'){
               $fin ++;   
          }else  if($fins == 'ABERTO'){
               $aber ++;   
          }else  if($fins == 'EM ATENDIMENTO'){
               $atend ++;   
          }
        }
?>
      function desenharGrafico() {
        var dados = new google.visualization.DataTable();
        dados.addColumn('string', 'Gênero');
        dados.addColumn('number', 'Quantidades');
        dados.addRows([  
          ['FINALIZADOS: <?php echo $fin;?>', <?php echo $fin;?>],
          ['ABERTOS: <?php echo $aber;?>', <?php echo $aber;?>],
          ['EM ATENDIMENTO: <?php echo $atend;?>', <?php echo $atend;?>],
        ]);
        var config = {
            'title': '<?php echo $dados_geral['title'];?>',
            'width':750,
            'height':400
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(dados, config);
      }
      <?php }?>
    </script>
                <!-------------------------------------------------------------------->
        </div>
    </div><!--fluid-->
</div><!--container-->

<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>


<!--**********************-->
</div><!-- contentpanel fim geral-->

</div><!-- mainpanel -->
</section>

<!-- Model usuários -->
<div class="modal fade usuarios-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url(); ?>Intranet/relatorio_atendimentos_filtro" method="post" name="_login" id="_login" data-toggle="validator" role="form">
            <div class="modal-content" style="width: 490px; margin-left: 20%; margin-top: 10%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Relatório por usuários do sistema</h4>
                </div>
                <div class="col-md-12 form-group">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Escolha um usuário</label>
                            <select class="form-control" name="usuarios" required="">
                                 <option value="" >--</option>
                                <option value="TODAS" >TODOS</option>
                                <?php foreach ($dados_geral['usuarios'] as $value) {?>
                                <option value="<?php echo $value->id;?>" ><?php echo $value->nome;?></option>     
                                 <?php  }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-globe" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"  style="float: right;"><i class="fa fa-check" aria-hidden="true"></i> Continuar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Fim usuários -->


<!-- Model Solicitações -->
<div class="modal fade solicitacoes-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url(); ?>Intranet/relatorio_atendimentos_filtro" method="post" name="_login" id="_login" data-toggle="validator" role="form">
            <div class="modal-content" style="width: 490px; margin-left: 20%; margin-top: 10%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Relatório por tipo de solicitações</h4>
                </div>
                <div class="col-md-12 form-group">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Escolha uma solicitação</label>
                            <select class="form-control" name="tipo_solicitacao" required="">
                                <option value="" >--</option>
                                <option value="TODAS" >TODAS</option>
                                <option value="ABERTO" >ABERTA</option>
                                 <option value="FINALIZADO" >FINALIZADA</option>
                                 <option value="EM ATENDIMENTO" >EM ATENDIMENTO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-globe" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"  style="float: right;"><i class="fa fa-check" aria-hidden="true"></i> Continuar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Fim Solicitações -->


<!-- Model Clientes -->
<div class="modal fade cliente-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url(); ?>Intranet/relatorio_atendimentos_filtro" method="post" name="_login" id="_login" data-toggle="validator" role="form">
            <div class="modal-content" style="width: 490px; margin-left: 20%; margin-top: 10%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Relatório por clientes</h4>
                </div>
                <div class="col-md-12 form-group">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Escolha um cliente</label>
                            <select class="form-control" name="id_clientes" required="">
                                 <option value="" >--</option>
                                 <?php foreach ($dados_geral['clientes'] as $value) {?>
                                <option value="<?php echo $value->id_clientes;?>" ><?php echo $value->nome_cliente;?></option>     
                                 <?php  }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-globe" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"  style="float: right;"><i class="fa fa-check" aria-hidden="true"></i> Continuar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Fim Clientes -->

<!-- Model categorias -->
<div class="modal fade categorias-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url(); ?>Intranet/relatorio_atendimentos_filtro" method="post" name="_login" id="_login" data-toggle="validator" role="form">
            <div class="modal-content" style="width: 490px; margin-left: 20%; margin-top: 10%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Relatório por categoria</h4>
                </div>
                <div class="col-md-12 form-group">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Escolha um categoria</label>
                            <select class="form-control" name="categorias" required="">
                                 <option value="" >--</option>
                                <option value="TODAS" >TODAS</option>
                                <option value="ALTERAÇÃO" >ALTERAÇÃO</option>
                                <option value="CONSULTA">CONSULTA</option>
                                <option value="DÚVIDAS" >DÚVIDAS</option>
                                <option value="EXCLUSÃO" >EXCLUSÃO</option>
                                <option value="EXTENSÃO">EXTENSÃO</option>
                                <option value="EXAME" >EXAME</option>
                                 <option value="FATURAMENTO" >FATURAMENTO</option>
                                  <option value="INCLUSAO" >INCLUSAO</option>
                                  <option value="OUTROS" >OUTROS</option>
                                <option value="TERAPIAS">TERAPIAS</option>
                                <option value="TERAPIAS">INTERNAÇÃO</option>
                                <option value="2º VIA DA CARTEIRINHA">2º VIA DA CARTEIRINHA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-globe" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"  style="float: right;"><i class="fa fa-check" aria-hidden="true"></i> Continuar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Fim categorias -->


<!-- Model Status -->
<div class="modal fade status-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url(); ?>Intranet/relatorio_atendimentos_filtro" method="post" name="_login" id="_login" data-toggle="validator" role="form">
            <div class="modal-content" style="width: 490px; margin-left: 20%; margin-top: 10%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Relatório por status</h4>
                </div>
                <div class="col-md-12 form-group">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>selecione o status</label>
                            <select class="form-control" name="status" required="">
                                 <option value="" >--</option>
                                <option value="TODAS" >TODOS</option>
                                <option value="ABERTO">ABERTO</option>
                                <option value="FINALIZADO">FINALIZADO</option>
                                <option value="EM ATENDIMENTO">EM ATENDIMENTO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-globe" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"  style="float: right;"><i class="fa fa-check" aria-hidden="true"></i> Continuar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Fim Status -->