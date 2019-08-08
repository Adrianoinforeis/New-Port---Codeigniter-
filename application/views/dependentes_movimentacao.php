<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<div class="contentpanel"><!--Início da classe geral-->
    <div id="page-wrapper">

        <div class="container-fluid" style="background-color: #fff; margin-bottom: 10%;">

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
            <div class="col-sm-6">
                <form style="margin-bottom: 5%;" method="post" action="<?= base_url(); ?>Cadastrar/portaria">   
                    <fieldset class="scheduler-border">
                        <div class="mostra">


                             <script type="text/javascript">
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
                        function maiuscula(z) {
                            v = z.value.toUpperCase();
                            z.value = v;
                        }
//FIM DA FUNÇÃO MASCARA MAIUSCULA
                    </script>

                             <!-- <button type="submit" value="" name="" class="btn btn-success" ><i class="fa fa-check-circle" aria-hidden="true"></i> Consultar</button>-->

                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="col-md-12" id="minhaDiv">
             

                <div class="col-md-12" style="margin-bottom: 2%;" >
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
                        //  function deletar(id) {
                        //      if (confirm("Deseja remover esse fornecedor?")) {
                        //          window.location = "<?= base_url(); ?>Deletar/deletar_fornecedor?acao=deletar&id=" + id + "&url=<?php echo $url; ?>";
                        //= "cadastro_usuarios.php?acao=deletar&id=" + id;
                        //     }
                        //  }
                    </script>

                </div>
                <legend class="legend">DEPENDENTE EM MOVIMENTAÇÃO</legend>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <script>
                            $(document).ready(function () {
                                $('[data-toggle="tooltip"]').tooltip();
                            });
                        </script>
                        <table id="example" class="table table-hidaction table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>NOME</th>
                                    <th>CPF</th>
                                    <th>STATUS</th>
                                    <th>ATENDIMENTO</th>
                                     <th>ID</th>
                                </tr>

                            </thead>
                            <tbody> 
                                <?php
                                $dominio = $_SERVER['HTTP_HOST'];
                                $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
                                foreach ($dados_geral['dados_beneficiario'] as $value) {
                                    ?>
                                     <tr>
                                    <td><a href="filtro_beneficiario?id=<?php echo $value->id_beneficiario; ?>" title="Editar beneficiário"><?php echo $value->nome; ?></a></td>
                                    <td><a href="filtro_beneficiario?id=<?php echo $value->id_beneficiario; ?>" title="Editar beneficiário"><?php echo $value->cpf; ?></a></td> 
                                    <td><a href="filtro_beneficiario?id=<?php echo $value->id_beneficiario; ?>" title="Editar beneficiário"><?php echo $value->status;  ?></a></td>
                                    <td><a style="color: #990000;" href="detalhes_do_atendimento?id=<?php echo $value->id_atend; ?>" title="Visualizar Atendimento"><?php if($value->movimentacao == 'ativa'){ echo $value->andamento; }?></a></td>
                                     <td><a style="color: #990000;" href="detalhes_do_atendimento?id=<?php echo $value->id_atend; ?>" title="Visualizar Atendimento"><?php echo $value->id_atend;?></a></td>
                                </tr>
                                </form>
                                <?php
                               }
                            ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
                

                
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
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
        if (e.length == '')
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
<script type="text/javascript">
    //pesquisa socio por nome
    var base_url = "<?php echo base_url(); ?>"
    $("#pesquisa").keyup(function () {
        var pesquisa = $(this).val();

        //verifica se tem algo digitado
        // $('.resultado').attr('disabled', 'disabled');
        if (pesquisa != '') {
            var dados = {
                palavra: pesquisa
            }
            $.post(base_url + 'Ajax/getClientes', dados, function (retorna) {
                //mostra dentro da ul os resultados obtidos
                $(".resultado").html(retorna);
                //$('.resultado').removeAttr('disabled');
            });
        } else {
            $(".resultado").html('');
        }
    });
</script>

<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
</div><!--Fim cadastro-->
</div><!-- mainpanel -->
</section>
