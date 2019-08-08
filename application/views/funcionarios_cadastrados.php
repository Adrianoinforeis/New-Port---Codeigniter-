<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<div class="contentpanel"><!--Início da classe geral-->
    <div id="page-wrapper">

        <div class="container-fluid" style="background-color: #fff;">

            <!-- Page Heading -->
            <div class="row">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="page-header">

                        </h5>
                    </div>
                </div>
            </div>
            <!--Listando usuários-->
            <div class="col-md-12">
                <legend class="legend">Funcionários cadastrados</legend>
                <div class="table-responsive">
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ativo</th>
                                <th>Empresa</th>
                                <th>Telefone</th>
                                <th>Administrador</th>
                                <th>Ação</th>

                            </tr>

                        </thead>
                        <tbody> 
                            <?php /*
                              $status_em_atendimento = 'Em atendimento';
                              $pag = "$_GET[pag]";
                              if ($pag >= '1') {
                              $pag = $pag;
                              } else {
                              $pag = '1';
                              }
                              $maximo = '10'; //RESULTADOS POR PÁGINA
                              $inicio = ($pag * $maximo) - $maximo;
                              //Inicio do código php select
                              include_once '../conexao/conexao.php';
                              $cons_chamados_atend = consulta_dados("SELECT * FROM sps_users
                              ORDER BY nome ASC
                              LIMIT $inicio, $maximo
                              ");
                              // or die(mysqli_error());
                              if (@mysqli_num_rows($cons_chamados_atend) <= 0) {
                              // echo 'Erro ao selecionar o banco';
                              } else {
                              while ($pesquisa = mysqli_fetch_array($cons_chamados_atend)) {
                              $id_user = $pesquisa['id'];
                              $no_user = $pesquisa[1];
                              $login_user = $pesquisa[3];
                              $ativo_empresa = $pesquisa[9];
                              $tipo_user = $pesquisa[8];
                              $adm_sistem = $pesquisa[6];
                             */ ?>
                            <tr>

                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $no_user;    ?>Pedro</td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $login_user;    ?>Sim</td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $ativo_empresa;    ?>XPTO</td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $tipo_user;    ?>(11) 1111-1111</td>
                                <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php //echo $adm_sistem;    ?>Sim</td>
                                <td class="text-center">
                                    <form method="post" name="" id="" action="<?= base_url();?>Intranet/editar_usuario">   
                                        <input type="hidden" value="<?php //echo $item->id;?>" name="id_editar">
                                        <button type="submit" value="" name="alterar_user" id="alterar_user" class="btn btn-xs btn-success btn-mini" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i></button>
                                        <input type="hidden"  name="del_user" id="del_user" value="<?php //echo $item->id;?>" >
                                        <button type="button" name="excluir_reg" id="excluir_reg"
                                                class="btn btn-xs btn-danger btn-mini" value="" onClick="deletar(<?php //echo $item->id;?>)"><i class="fa fa-times" aria-hidden="true" title="Excluir"></i></button> 
                                    </form>
                                </td>
                            </tr>
                            <?php
                            //  }
                            // }
                            ?>
                        </tbody>
                    </table>
                    <div class="paginator">
                        <?php /*
                          //USE A MESMA SQL QUE QUE USOU PARA RECUPERAR OS RESULTADOS
                          //SE TIVER A PROPRIEDADE WHERE USE A MESMA TAMBÉM
                          include_once '../conexao/conexao.php';
                          $sql_res = consulta_dados("SELECT * FROM sps_users");
                          if (@mysqli_num_rows($sql_res) <= 0) {
                          // echo 'Não possui chamado aberto';
                          $aviso = "<div class=\"alert alert-success\">
                          <strong>Informação :</strong> Não possui chamados em atendimento!
                          </div>";
                          echo $aviso;
                          } else {
                          //echo $sql_res;
                          $total = mysqli_num_rows($sql_res);
                          //or die(mysql_error());

                          $paginas = ceil($total / $maximo);
                          $links = '5'; //QUANTIDADE DE LINKS NO PAGINATOR

                          echo "<a href=\"cadUsuarios.php?pag=1\">Primeira Página</a>&nbsp;&nbsp;&nbsp;";

                          for ($i = $pag - $links; $i <= $pag - 1; $i++) {
                          if ($i <= 0) {

                          } else {
                          echo"<a href=\"cadUsuarios.php?pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
                          }
                          }echo "$pag &nbsp;&nbsp;&nbsp;";

                          for ($i = $pag + 1; $i <= $pag + $links; $i++) {
                          if ($i > $paginas) {

                          } else {
                          echo "<a href=\"cadUsuarios.php?pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
                          }
                          }
                          echo "<a href=\"cadUsuarios.php?pag=$paginas\">Última página</a>&nbsp;&nbsp;&nbsp;";
                          } */
                        ?>
                    </div>
                </div> 

            </div><!--Listando usuários-->
        </div>
    </div>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
</div><!--Fim cadastro-->
</div><!-- mainpanel -->



</section>