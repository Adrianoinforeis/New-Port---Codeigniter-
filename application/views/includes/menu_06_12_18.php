<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<?php

function limitChars($text, $limit = 4) {
    $join = array();
    $ArrayString = explode(" ", $text);

    if ($limit > count($ArrayString)) {
        $limit = count($ArrayString) / 2;
    }

    foreach ($ArrayString as $key => $word) {
        $join[] = $word;
        if ($key == $limit) {
            break;
        }
    }
    //print_r($join);
    return implode(" ", $join) . "...";
}
$session = $this->session->userdata('logado');
if ($session == NULL){
    redirect(base_url().'Intranet/logoff');
}
?>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="leftpanel nao-imprime">



        <div class="leftpanelinner" style="margin-top: 10%;">



            <h5 class="sidebartitle nao-imprime" style="background-color: #FFF; height: 45px; margin-top: -12%; width: 100%;">
                <img src="<?= base_url(); ?>assets/images/logo.JPG" height="40" width="204" style="margin: 3px;">
            </h5>
            <ul class="nav nav-pills nav-stacked nav-bracket nao-imprime">
                <?php
                $session_logado = $this->session->userdata('logado');
                $user_logado = $session_logado[0]->tipo_acesso;
                if ($user_logado == 'Colaborador') {
                    ?>
                    <li><a href="<?= base_url(); ?>Intranet/home"><i class="fa fa-home"></i> <span>HOME</span></a></li>
                    <li class="nav-parent"><a href=""><i class="fa fa-bars" aria-hidden="true"></i> <span>ATENDIMENTO</span><i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="children">

                            <li><a href="#" data-toggle="modal" data-target=".abre-chamado-modal-lg">
                                    <i class="fa fa-caret-right"></i>CRIAR SOLICITAÇÃO</a>
                            </li> 
                             
                            <li><a href="<?= base_url()?>Intranet/atendimentos_finalizados">
                                    <i class="fa fa-caret-right"></i>ATENDIMENTOS FINALIZADOS</a>
                            </li> 
                             <li><a href="<?= base_url()?>Intranet/gerar_protocolos">
                                    <i class="fa fa-caret-right"></i>GERAR PROTOCOLOS</a>
                            </li> 
                            <!--
                            <li><a href="#">
                                    <i class="fa fa-caret-right"></i>LISTAR OUTROS</a>
                            </li> 
                            -->
                           <!-- <li><a href="<?= base_url(); ?>Intranet/cadastro_de_usuarios">
                                    <i class="fa fa-caret-right"></i>Listar Funcionários</a>
                            </li> -->    
                        </ul>
                    </li>
    <?php //if($_SESSION['adm']['fk_tipo_usu'] == 3){   ?>
                    <li class="nav-parent"><a href=""><i class="fa fa-users" aria-hidden="true"></i> <span>CLIENTES</span><i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="children">

                            <li><a href="<?= base_url() ?>Intranet/cadastro_de_clientes">
                                    <i class="fa fa-caret-right"></i>PESQUISAR-INCLUIR</a>
                            </li> 
                            <li><a href="#" data-toggle="modal" class="delusu" data-target=".cliente-anexo-modal-lg">
                                    <i class="fa fa-folder-open fa-5x" ></i> ANEXO</a>
                            </li> 
                            <!--
                            <li><a href="<?= base_url() ?>Intranet/clientes_cadastrados">
                                    <i class="fa fa-caret-right"></i>Listar Clientes</a>
                            </li>     -->
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-book" aria-hidden="true"></i> <span>CONTRATOS</span><i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="children">

                            <li><a href="<?= base_url() ?>Intranet/cadastro_de_contratos">
                                    <i class="fa fa-caret-right"></i>PESQUISAR-INCLUIR</a>
                            </li> 
                            <!--
                            <li><a href="<?= base_url() ?>Intranet/operadoras_cadastradas">
                                    <i class="fa fa-caret-right"></i>Listar Operadoras</a>
                            </li>   -->  
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-male" aria-hidden="true"></i> <span>BENEFICIÁRIOS</span><i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="children">

                            <li><a href="<?= base_url() ?>Intranet/cadastro_de_funcionarios">
                                    <i class="fa fa-caret-right"></i>PESQUISAR-INCLUIR</a>
                            </li> 
                             <li><a href="<?= base_url() ?>Intranet/beneficiarios_inativos">
                                    <i class="fa fa-caret-right"></i>INATIVOS</a>
                            </li> 
                            <li><a href="<?= base_url() ?>Intranet/beneficiarios_movimentacao">
                                    <i class="fa fa-caret-right"></i>MOVIMENTAÇÃO-BENEFICIÁRIO</a>
                            </li>
                            <li><a href="<?= base_url() ?>Intranet/dependente_movimentacao">
                                    <i class="fa fa-caret-right"></i>MOVIMENTAÇÃO-DEPENDENTE</a>
                            </li>
                            <li><a href="<?= base_url() ?>Intranet/upload_de_beneficiarios">
                                    <i class="fa fa-caret-right"></i>UPLOAD DO EXCEL</a>
                            </li> 
                    </li>     
                </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-barcode" aria-hidden="true"></i> <span>FATURAMENTO</span><i class="fa fa-fw fa-caret-down"></i></a>
                    <ul class="children">

                        <li><a href="<?= base_url() ?>Intranet/cadastro_de_faturamento">
                                <i class="fa fa-caret-right"></i>CONTRATOS->PESQUISAR-INCLUIR</a>
                        </li> 
                         <li><a href="#">
                                <i class="fa fa-caret-right"></i>BENEFICIÁRIOS->PESQUISAR-INCLUIR</a>
                        </li> 
                        <!--
                        <li><a href="<?= base_url() ?>Intranet/operadoras_cadastradas">
                                <i class="fa fa-caret-right"></i>Listar Operadoras</a>
                        </li>   -->  
                    </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-ambulance" aria-hidden="true"></i> <span>OPERADORAS</span><i class="fa fa-fw fa-caret-down"></i></a>
                    <ul class="children">

                        <li><a href="<?= base_url() ?>Intranet/cadastro_de_operadoras">
                                <i class="fa fa-caret-right"></i>PESQUISAR-INCLUIR</a>
                        </li> 
                        <!--
                        <li><a href="<?= base_url() ?>Intranet/operadoras_cadastradas">
                                <i class="fa fa-caret-right"></i>Listar Operadoras</a>
                        </li>   -->  
                    </ul>
                </li>
                <!--<li class="nav-parent"><a href=""><i class="fa fa-medkit" aria-hidden="true"></i> <span>PLANOS</span><i class="fa fa-fw fa-caret-down"></i></a>
                    <ul class="children">

                        <li><a href="<?= base_url() ?>Intranet/cadastro_de_planos">
                                <i class="fa fa-caret-right"></i>INCLUIR PLANOS</a>
                        </li> 
                <!--
                <li><a href="<?= base_url() ?>Intranet/operadoras_cadastradas">
                        <i class="fa fa-caret-right"></i>Listar Operadoras</a>
                </li>   
            </ul>
        </li>-->
     <!--   <li class="nav-parent"><a href=""><i class="fa fa-fw fa-table"></i> <span>CATEGORIAS</span><i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="children">

                <li><a href="<?= base_url() ?>Intranet/cadastro_de_categorias">
                        <i class="fa fa-caret-right"></i>INCLUIR CATEGORIAS</a>
                </li> 
               <!-- <li><a href="<?= base_url(); ?>Intranet/cadastro_de_usuarios">
                        <i class="fa fa-caret-right"></i>Listar Funcionários</a>
                </li>   
            </ul>
        </li>-->
                <li class="nav-parent"><a href="#"><i class="fa fa-area-chart" aria-hidden="true"></i> <span>RELATÓRIOS</span><i class="fa fa-fw fa-caret-down"></i></a>
               <ul class="children">
                   <li><a href="<?= base_url()?>Intranet/relatorio_atendimentos">
                        <i class="fa fa-caret-right"></i>DASHBOARD</a>
                 </li> 
                 <li><a href="<?= base_url()?>Intranet/relatorio_contratos">
                        <i class="fa fa-caret-right"></i>CONTRATOS</a>
                 </li>
                   <li><a href="<?= base_url()?>Intranet/relatorio_reembolso">
                        <i class="fa fa-caret-right"></i>REEMBOLSO GERAIS</a>
                 </li> 
                  <li><a href="<?= base_url()?>Intranet/relatorio_reembolso_detalhado">
                        <i class="fa fa-caret-right"></i>REEMBOLSO DETALHADO</a>
                 </li> 
                 <li><a href="<?= base_url()?>Intranet/relatorio_outros_atendimentos">
                        <i class="fa fa-caret-right"></i>ATENDIMENTOS</a>
                 </li> 
                 <li><a href="<?= base_url()?>Intranet/relatorio_faturamentos">
                        <i class="fa fa-caret-right"></i>FATURAMENTO</a>
                 </li> 
               </ul>
                </li> 
                <?php 
                $user_permissao = $session_logado[0]->permissao;
                if ($user_permissao == 'Administrador') {
                    ?>
                <li class="nav-parent"><a href=""><i class="fa fa-user" aria-hidden="true"></i> <span>USUÁRIOS</span><i class="fa fa-fw fa-caret-down"></i></a>
                    <ul class="children">

                        <li><a href="<?= base_url(); ?>Intranet/cadastro_de_usuarios">
                                <i class="fa fa-caret-right"></i>Incluir Usuários</a>
                        </li> 
                        <li><a href="<?= base_url(); ?>Intranet/usuarios_cadastrados">
                                <i class="fa fa-caret-right"></i>Listar Usuários</a>
                        </li>     
                    </ul>
                </li>
                <?php } ?>
            <?php } ?>
            <li class="nav-parent"><a href=""><i class="fa fa-dashcube" aria-hidden="true"></i> <span>MEUS DADOS</span><i class="fa fa-fw fa-caret-down"></i></a>
                <ul class="children">
                    <?php $id = $session_logado[0]->id;?>
                    <li><a href="<?= base_url();?>Intranet/editar_perfil?id=<?php echo $id;?>">
                            <i class="fa fa-caret-right"></i>EDITAR PERFIL</a>
                    </li> 
                   <!-- <li><a href="<?= base_url(); ?>Intranet/usuarios_cadastrados">
                            <i class="fa fa-caret-right"></i>Listar Usuários</a>
                    </li>   -->  
                </ul>
            </li>
            <?php
            $session_logado = $this->session->userdata('logado');
            $tipo_usuario = $session_logado[0]->tipo_acesso;
            if ($tipo_usuario == 'Cliente') {
                ?>
                <li><a href="<?= base_url(); ?>Intranet/home_newport"><i class="fa fa-home"></i> <span>INÍCIO</span></a></li>
                <li><a href="<?= base_url(); ?>Cliente/historico"><i class="fa fa-history" aria-hidden="true"></i> <span>HISTÓRICO</span></a></li>
<?php } ?>
            <li><a href="#" data-toggle="modal" class="delusu" data-target=".deleteCad-usuario-modal-lg">
                    <i class="glyphicon glyphicon-log-out"></i> <span>SAIR</span></a>
            </li>
            </li> 
            </ul>



        </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->
    <style>
        .photo_menu:hover,
        .photo_menu:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <div class="mainpanel">

        <div class="headerbar nao-imprime">
            <a class="menutoggle"><i class="fa fa-bars"></i></a>
            <div class="header-right">
                <ul class="headermenu">
                    <li>
                        <div class="btn-group">
                            <label><i class="fa fa-user" aria-hidden="true"></i> Usuário Logado: <?php echo limitChars($session_logado[0]->nome, 3);?></label>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="#" data-toggle="modal" class="delusu" data-target="#Modal_imagem"><i class="fa fa-picture-o" aria-hidden="true"></i> Alterar foto</a></li>
                               <!-- <li><a href="#"><i class="fa fa-certificate"></i><span>Alterar senha</span></a></li>-->
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- header-right -->

        </div><!-- headerbar -->


<!--Postar imagens-->
<div class="modal fade" id="Modal_imagem_verificar_depois" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 210px; height: 180px;">
        <form action="" method="post" name="" id="" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Foto</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="btn btn-default btn-file">
                                Procurar arquivo <input  type="file" id="thumb" name="thumb">
                            </span>
                        </div>
                        <div class="col-md-12">
                            <div id="divcheck">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
                    <button type="submit" class="btn btn-primary" name="postar_imagem"><i class="fa fa-check-circle" aria-hidden="true"></i> Postar</button>
                </div>
            </div>
        </form>
    </div>
</div>
