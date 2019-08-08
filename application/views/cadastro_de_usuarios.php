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
                            Campos com  * são obrigatórios
                        </h5>
                    </div>
                </div>
            </div>
            <style>
                .campos_form{
                    padding: 5px;  
                }
            </style>
            <div class="col-md-12" style="margin-bottom: 10%;">
                <form action="<?= base_url(); ?>Cadastrar/cadastro_de_usuarios" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tipo_acesso">Tipo de acesso *: </label>
                                <select class="form-control campos_form" name="tipo_acesso" id="tipo_acesso" required="" data-error="Por favor, selecione o tipo de acesso">
                                    <option id="0" value="" selected="">--</option> 
                                    <option value="Cliente">Cliente</option> 
                                    <option value="Colaborador">Colaborador</option> 
                                    <div class="help-block with-errors"></div>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="empresa">Empresa *: </label>
                                <select disabled="" class="form-control campos_form" name="empresa" id="empresa" required="" data-error="Por favor, selecione  a empresa">
                                    <option id="0" value="" selected="">--</option>
                                    <?php
                                    foreach ($dados_geral['dados_cliente'] as $value) {
                                        ?>
                                        <option value="<?php echo $value->id_clientes; ?>"><?php echo $value->nome_cliente; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nome">Nome *: </label>
                                <select disabled="" id="nome" class="form-control campos_form" name="nome" placeholder="Informe o nome" data-error="Por favor, informe o nome do usuário." required>
                                    <option id="" value="" selected="">--</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(function () {
                                $('#tipo_acesso').change(function () {
                                    $('#empresa').removeAttr('disabled');
                                });
                                 $('#nome').change(function () {
                                    $('#login').removeAttr('disabled');
                                });
                            });
                            //Função que tras e envia categoria e produto
                            var base_url = "<?php echo base_url(); ?>"
                            $(function () {
                                $('#empresa').change(function () {

                                    $('#nome').attr('disabled', 'disabled');
                                    $('#nome').html("<option>Carregando...</option>");
                                    var id_clientes = $('#empresa').val();

                                    $.post(base_url + 'Ajax/getUsuariosBeneficiarios', {
                                        id_clientes: id_clientes
                                    }, function (data) {
                                        //console.log(data); //imprime com f12
                                        $('#nome').html(data);
                                        $('#nome').removeAttr('disabled');
                                    });
                                });
                            });
                        </script>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="login">Login *: </label>
                                <input disabled="" type="text" id="login" class="form-control campos_form" name="login" value="" required placeholder="Login, no mínimo 4 caracteres " data-error="Por favor, informe o login, no mínimo 4 caracteres" minlength="4">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="pass">Password *: </label>
                                <input type="password" id="pass" class="form-control campos_form" name="pass" value="" required placeholder="Senha, no mínimo 4 caracteres" data-error="Por favor, informe a senha, no mímino 4 caracteres" minlength="4">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="conf_pass">Confirmar Password *: </label>
                                <input type="password" id="conf_pass" class="form-control campos_form" name="conf_pass" value="" placeholder="Confirmar senha "  data-match="#pass" data-match-error="As senhas não são iguais" minlength="4">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">E-mail *: </label>
                                <input type="email" id="email" class="form-control campos_form" name="email" value="" placeholder="Informe um e-mail válido" data-error="Por favor, informe um e-mail válido">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="ativo">Ativo *: </label>
                                <select class="form-control campos_form" id="ativo" name="ativo" required="">
                                    <option id="0" value="" selected="">--</option> 
                                    <option id="nao" value="Não">Não</option> 
                                    <option id="sim" value="Sim">Sim</option> 
                                    <div class="help-block with-errors"></div>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="dpto">Departamento: </label>
                            <input type="text" id="dpto" class="form-control campos_form" name="dpto" value="" placeholder="cargo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="perm_adm">Permissões*: </label>
                                <select class="form-control campos_form" id="perm_adm" name="perm_adm" required="">
                                    <option id="0" value="" selected="">--</option>
                                    <option id="sim" value="Administrador">Administrador</option>
                                    <option id="nao" value="Comum">Comum</option> 
                                    <option id="sim" value="Gestor">Gestor</option> 
                                    <div class="help-block with-errors"></div>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="rec_mail">Recebe e-mail *: </label>
                                <select class="form-control campos_form" name="rec_mail" id="rec_mail">
                                    <option value="Não" selected="">Não</option>
                                    <option value="Sim">Sim</option>
                                    <div class="help-block with-errors"></div>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <br />
                            <input type="hidden" name="cadastrar_user" value="cad" />
                            <button type="submit" id="btn_abcham" name="btn_abcham" class="btn btn-success btn-block"><i class="fa fa-check-circle" aria-hidden="true"></i>  GRAVAR</button>
                        </div>
                        <div class="col-md-2">
                            <br />
                            <a href="<?= base_url(); ?>Intranet/home" class="btn btn-warning btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> RETORNAR</a>
                        </div>
                        <div class="col-md-2">
                            <br />
                            <button type="reset" id="btn_abrirchamado" name="btn_abrirchamado" class="btn btn-default btn-block"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> LIMPAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

</div><!--Fim cadastro-->
</div><!-- mainpanel -->



</section> 