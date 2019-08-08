<!-- MODL EDITAR CADASTRO -->
<div class="modal fade cliente-anexo-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url(); ?>Intranet/#" method="post" name="_login" id="_login" data-toggle="validator" role="form">
            <div class="modal-content" style="width: 490px; margin-left: 20%; margin-top: 10%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Digite o nome do Cliente</h4>
                </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                                <input type="text" class="form-control" onkeyup="maiuscula(this)" placeholder="DIGITE O NOME DO CLIENTE" id="pesquisa_anexo">

                            </div>

                            <div class="col-md-12 form-group">
                                <ul class="list-group resultado_anexo" style="list-style-type: none;" onclick="Mudarestado('minhaDiv')">
                                </ul>
                            </div>
                            <script type="text/javascript">
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
                                function maiuscula(z) {
                                    v = z.value.toUpperCase();
                                    z.value = v;
                                }
//FIM DA FUNÇÃO MASCARA MAIUSCULA
                            </script>

                    </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?php //echo $logado;  ?>" id="sai_log" name="sai_log">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;"><i class="fa fa-globe" aria-hidden="true"></i> Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- modal -->
<script type="text/javascript">
    //pesquisa socio por nome
    var base_url = "<?php echo base_url(); ?>"
    $("#pesquisa_anexo").keyup(function () {
        var pesquisa = $(this).val();

        //verifica se tem algo digitado
        // $('.resultado').attr('disabled', 'disabled');
        if (pesquisa != '') {
            var dados = {
                palavra: pesquisa
            }
            $.post(base_url + 'Ajax/getClientes', dados, function (retorna) {
                //mostra dentro da ul os resultados obtidos
                $(".resultado_anexo").html(retorna);
                //$('.resultado').removeAttr('disabled');
            });
        } else {
            $(".resultado_anexo").html('');
        }
    });
</script>