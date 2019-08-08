<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<div class="contentpanel"><!--Início da classe geral-->
    <div id="page-wrapper">

        <div class="container-fluid" style="background-color: #fff;">

                    <form action="" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
            <div class="col-md-12">
                <div class="panel panel-info">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nome">Nome da cacategoria: </label>
                                    <input type="text" id="cat" class="form-control" name="cat" value="" placeholder="Informe a categoria" data-error="Por favor, informe a categoria." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br />
                                <input type="hidden" name="cadastrar_cat" value="cad" />
                                <button type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-success btn-block"><i class="fa fa-check-circle" aria-hidden="true"></i> Incluir Nova Categoria</button>
                            </div>
                            <div class="col-md-3">
                                <label for="nome">Cacategorias já cadastradas: </label>
                                <div id="scroll_cat">
                                    <div class="table-responsive">
                                        <a href="#" class="form-control"> Reembolso<?php // echo $Categoria_nome_; ?></a>
                                        <?php /*
                                        //Selecionar categoria  
                                        include_once '../conexao/conexao.php';
                                        $subCat_select = consulta_dados("SELECT * FROM sps_categoria ORDER BY cat");
                                        if (mysqli_num_rows($subCat_select) > 0) {
                                            while ($dados_sub = mysqli_fetch_array($subCat_select)) {
                                                $Categoria_id_ = $dados_sub[0];
                                                $Categoria_nome_ = $dados_sub[1];
                                                ?>
                                                <a href="alteracategoria.php?id=<?php echo $Categoria_id_; ?>" class="form-control"><?php echo $Categoria_nome_; ?></a>

                                                <?php
                                            }
                                        } */
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <!--Fim select sub cat.-->
        </div>
    </div>

<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
</div><!--Fim cadastro-->
</div><!-- mainpanel -->



</section>