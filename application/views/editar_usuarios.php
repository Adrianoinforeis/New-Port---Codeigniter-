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
            <style>
                .campos_form{
                    padding: 5px;  
                }
            </style>
            <div class="col-md-12" style="margin-bottom: 10%;">
                <?php
                           // foreach($usuario as $item){ 
                              //  print_r($usuario);
                            //}
                            ?>
                <form action="<?= base_url();?>Cadastrar/cadastro_de_usuarios" method="post" enctype="multipart/form-data" id="caduser" name="caduser" data-toggle="validator" role="form">
                    <input type="hidden" class="form-control campos_form" name="id_usuario" value="<?php echo $usuario->id;?>">
                    <input type="hidden" class="form-control campos_form" name="nome" value="<?php echo $usuario->id_beneficiario;?>">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nome">Nome *: </label>
                                 <?php 
                                $session_logado = $this->session->userdata('logado');
                                $user_permissao = $session_logado[0]->permissao;
                                if ($user_permissao == 'Administrador') {
                                ?>
                                <input disabled="" type="text" id="nome" class="form-control campos_form" name="nome_user" value="<?php echo $usuario->nome;?>" placeholder="Informe o nome" data-error="Por favor, informe o nome do usuário." required>
                                <?php }else{?>
                                <input disabled="" type="text" id="nome" class="form-control campos_form" name="nome_user" value="<?php echo $usuario->nome;?>" placeholder="Informe o nome" data-error="Por favor, informe o nome do usuário.">
                                 <?php }?>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="login">Login *: </label>
                                 <?php 
                                $session_logado = $this->session->userdata('logado');
                                $user_permissao = $session_logado[0]->permissao;
                                if ($user_permissao == 'Administrador') {
                                ?>
                                <input type="text" id="login" class="form-control campos_form" name="login" value="<?php echo $usuario->login;?>" required placeholder="Login, no mínimo 4 caracteres " data-error="Por favor, informe o login, no mínimo 4 caracteres" minlength="4">
                               <?php }else{?>
                                <input type="hidden" id="login" class="form-control campos_form" name="login" value="<?php echo $usuario->login;?>">
                                <input disabled="" type="text" id="login_mostra" class="form-control campos_form" name="login_mostra" value="<?php echo $usuario->login;?>" placeholder="Login, no mínimo 4 caracteres " data-error="Por favor, informe o login, no mínimo 4 caracteres" minlength="4">
                               <?php }?>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pass">Password *: </label>
                                <input type="password" id="pass" class="form-control campos_form" name="pass" value="<?php echo $usuario->password;?>" required placeholder="Senha, no mínimo 4 caracteres" data-error="Por favor, informe a senha, no mímino 4 caracteres" minlength="4">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="conf_pass">Confirmar Password *: </label>
                                <input type="password" id="conf_pass" class="form-control campos_form" name="conf_pass" value="<?php echo $usuario->password;?>" placeholder="Confirmar senha "  data-match="#pass" data-match-error="As senhas não são iguais" minlength="4">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">E-mail *: </label>
                                <input type="email" id="email" class="form-control campos_form" name="email" value="<?php echo $usuario->email;?>" placeholder="Informe um e-mail válido" data-error="Por favor, informe um e-mail válido">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="ativo">Ativo *: </label>
                                 <?php 
                                $session_logado = $this->session->userdata('logado');
                                $user_permissao = $session_logado[0]->permissao;
                                if ($user_permissao == 'Administrador') {
                                ?>
                                <select class="form-control campos_form" id="ativo" name="ativo" required="true">
                                   <?php }else{?>
                                     <select disabled class="form-control campos_form" id="ativo" name="ativo">
                                   <?php }?>
                                    <option id="nao" value="Não" <?php echo ($usuario->ativo == 'Não' ? 'selected="selected"' : '')?>>Não</option> 
                                    <option id="sim" value="Sim" <?php echo ($usuario->ativo == 'Sim' ? 'selected="selected"' : '')?>>Sim</option> 
                                    <div class="help-block with-errors"></div>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="dpto">Departamento: </label>
                              <?php 
                                $session_logado = $this->session->userdata('logado');
                                $user_permissao = $session_logado[0]->permissao;
                                if ($user_permissao == 'Administrador') {
                                ?>
                            <input type="text" id="dpto" class="form-control campos_form" name="dpto" value="<?php echo $usuario->dpto;?>" placeholder="cargo">
                            <?php }else{?>
                            <input disabled="" type="text" id="dpto" class="form-control campos_form" name="dpto" value="<?php echo $usuario->dpto;?>" placeholder="cargo">
                            <?php }?>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="perm_adm">Permissões*: </label>
                                <?php 
                                $session_logado = $this->session->userdata('logado');
                                $user_permissao = $session_logado[0]->permissao;
                                if ($user_permissao == 'Administrador') {
                                ?>
                                <select class="form-control campos_form" id="perm_adm" name="perm_adm" required="">
                                <?php }else{?>
                                    <select disabled class="form-control campos_form" id="perm_adm" name="perm_adm">
                                <?php }?>
                                    <option id="sim" value="Administrador" <?php echo ($usuario->permissao == 'Administrador' ? 'selected="selected"' : '')?>>Administrador</option>
                                    <option id="nao" value="Comum" <?php echo ($usuario->permissao == 'Comum' ? 'selected="selected"' : '')?>>Comum</option> 
                                    <option id="sim" value="Gestor" <?php echo ($usuario->permissao == 'Gestor' ? 'selected="selected"' : '')?>>Gestor</option> 
                                    <div class="help-block with-errors"></div>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tipo_acesso">Tipo de acesso *: </label>
                                <input type="text" class="form-control campos_form" value="<?php echo $usuario->tipo_acesso;?>" disabled="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="empresa">Empresa *: </label>
                                <input type="text" class="form-control campos_form" value="<?php echo $usuario->empresa;?>" disabled="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="rec_mail">Recebe e-mail *: </label>
                                <select class="form-control campos_form" name="rec_mail" id="rec_mail" required="">
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
                      <!--  <div class="col-md-2">
                            <br />
                            <a href="<?= base_url();?>Intranet/home" class="btn btn-warning btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> RETORNAR</a>
                        </div>-->
                    </div>
                </form>
                  <?php //} ?>
            </div>
        </div>
    </div>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

</div><!--Fim cadastro-->
</div><!-- mainpanel -->



</section> 