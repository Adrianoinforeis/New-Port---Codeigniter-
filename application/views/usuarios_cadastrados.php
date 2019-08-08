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
                <legend class="legend">Usuários cadastrados</legend>
                <div class="table-responsive">
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                    <table id="example" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Empresa</th>
                                <th>Tipo</th>
                                <th>Nível</th>
                                <th>Ação</th>

                            </tr>

                        </thead>
                        <tbody> 
                            <?php
                            foreach ($dados_geral['dados_usuario'] as $item) {
                                ?>
                                <tr>

                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->nome; ?></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->login; ?></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->empresa; ?></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->tipo_acesso; ?></td>
                                    <td style="height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;"><?php echo $item->permissao; ?></td>
                                    <td class="text-center">
                                        <form  style="border: 0; margin: 0; padding: 0;" method="post" name="" id="" action="<?= base_url(); ?>Intranet/editar_usuario">   
                                            <input type="hidden" value="<?php echo $item->id; ?>" name="id_editar">
                                            <?php if($item->login == 'admin'){?>
                                            <button type="submit" disabled="" value="" name="alterar_user" id="alterar_user" class="btn btn-xs btn-success btn-mini" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i></button>
                                            <?php }else{?>
                                            <button type="submit" value="" name="alterar_user" id="alterar_user" class="btn btn-xs btn-success btn-mini" ><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar"></i></button>
                                            <?php }?>
                                            <input type="hidden"  name="del_user" id="del_user" value="<?php echo $item->id; ?>" >
                                            <?php if($item->login == 'admin'){?>
                                            <button disabled="" type="button" class="btn btn-xs btn-danger btn-mini" onClick="deletar_usuario(<?php echo $item->id; ?>)"  titlee="EXCLUIR"><i class="fa fa-remove" aria-hidden="true" title="EXCLUIR"></i></button>
                                            <?php }else{?>
                                            <button type="button" class="btn btn-xs btn-danger btn-mini" onClick="deletar_usuario(<?php echo $item->id; ?>)"  titlee="EXCLUIR"><i class="fa fa-remove" aria-hidden="true" title="EXCLUIR"></i></button>
                                            <?php }?>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div> 
                <?php
                $dominio = $_SERVER['HTTP_HOST'];
                $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                ?>
                <script type="text/javascript">
                    function deletar_usuario(id) {
                        if (confirm("Deseja remover esse usuário?")) {
                            window.location = "<?= base_url(); ?>Deletar/deletar_usuario?acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                            //= "cadastro_usuarios.php?acao=deletar&id=" + id;
                        }
                    }
                </script>
            </div><!--Listando usuários-->
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
</div><!--Fim cadastro-->
</div><!-- mainpanel -->



</section>