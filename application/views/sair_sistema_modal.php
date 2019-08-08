 <!-- MODL EDITAR CADASTRO -->

<div class="modal fade deleteCad-usuario-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url();?>Intranet/logoff" method="post" name="_login" id="_login" data-toggle="validator" role="form">
            <div class="modal-content" style="width: 290px; margin-left: 45%; margin-top: 10%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Realmente deseja sair ?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?php //echo $logado; ?>" id="sai_log" name="sai_log">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-globe" aria-hidden="true"></i> Ficar</button>
                    <button type="submit" class="btn btn-danger" id="enviarsenha"><i class="fa fa-share-square-o" aria-hidden="true"></i> Sair</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- modal -->