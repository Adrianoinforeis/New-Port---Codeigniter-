<?php date_default_timezone_set('America/Sao_Paulo'); ?>

<div class="contentpanel"><!--Início da classe geral-->
    <div id="page-wrapper">
        <!-- /.row -->
        <div class="col-md-12"  style="background-color: #fff; margin-bottom: 20%; border-top: 10%;">
            <legend class="legend">Minhas solicitações</legend>
            <div class="table-responsive">
                 <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Analista</th>
                            <th>Solicitante</th>
                            <th>Data de abertura</th>
                            <th>Status</th>
                            <th>Detalhes</th>
                            <th>Ação</th>

                        </tr>

                    </thead>
                    <tbody> 
                        <?php
                        foreach ($dados_geral['atendimentos'] as $result) {
                        ?>
                        <tr>
                            <td><?php echo $result->id_atend;?></td>
                            <td><?php echo $result->analista;?></td>
                            <td><?php echo $result->nome_atendimento;?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($result->data_inicio)); ?></td>
                            <td><?php echo $result->status;?></td>
                            <td><?php echo $result->obs;?></td>
                            <td><a href="<?= base_url(); ?>Intranet/detalhes_do_atendimento?id=<?php echo $result->id_atend; ?>" class="btn btn-success btn-xs btn-mini" title="Visualizar"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                        </tr>
                                <?php }?>
                    </tbody>
                </table>
            </div> 

        </div>
    </div>
</div>       
<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>


<!--**********************-->
</div><!-- contentpanel fim geral-->

</div><!-- mainpanel -->



</section>


