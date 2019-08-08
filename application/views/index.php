<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/login.css">
<script type="text/javascript" src="<?= base_url(); ?>assets/js/login.js"></script>
 <!--  <link href="<?= base_url(); ?>/assets/css/gold.css" rel="stylesheet">-->
<script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/validar_campos/validator.min.js"></script> 
<script src="<?= base_url(); ?>assets/js/validar_campos/validator.js"></script>




     
    <!-- Modal envia e-mails -->
    <div class="modal fade" id="modal_emails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="background-color: #000;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-dialog" style="width:370px; margin-top: 10%; margin-left: 30%;">
                <div class="modal-content">
                    <form method="post" action="<?= base_url(); ?>Autenticacao/Dados_de_acesso" data-toggle="validator" role="form">
                        <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Esqueceu seus dados de acesso!</h4>
                        </div>
 
                        <div class="modal-body">

                            <div id="msgUsu2"></div>

                            <div class="row">
                                    <div class="col-md-12 form-group"> 
                                        <input type="email" name="email" class="form-control" required="" placeholder="INFORME SEU E-MAIL"  data-error="Por favor, informe seu e-mail cadastrado no sistema">
                                        <div class="help-block with-errors"></div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                 <div class="col-md-4">
                                    <button type="button" style="float: left;" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> CANCELAR</button>
                                </div>
                                <div class="col-md-2" style="float: right; margin-right: 6%;">
                                    <button type="submit" onclick="disparaEmail();" class="btn btn-info"><i class="fa fa-envelope" aria-hidden="true"></i> ENVIAR</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- modal-content -->
            </div>
        </div><!-- modal-dialog -->
    </div>
    <!-- modal -->

<a href="http://www.newportconsultoria.com.br/" id="findpass" title="Visite nosso site">
 <img src="<?= base_url(); ?>assets/images/logo.JPG" id="findpass" >   
 </a>
<form name="login" method="post" action="<?= base_url();?>Intranet/autentica" data-toggle="validator" role="form">
<div class="form">
  <div class="forceColor"></div>
  <div class="topbar">
      <div class="spanColor"></div>
      <input type="text" class="input" name="usuario" id="password" placeholder="Login, mínimo 4 caracteres" required="" data-minlength="4" data-error="Por favor, informe o login, no mímino 4 caracteres."/>
    <div class="spanColor"></div>
    <input type="password" class="input" name="password" id="password" placeholder="Senha, mínimo 4 caracteres" required data-minlength="4" data-error="Por favor, informe a senha, no mímino 4 caracteres" required=""/>
  </div>
  <button type="submit" class="submit" id="submit" >Logar-se</button>
  <button style="font-size: 12px;  margin-top: 5%; width: 100%; height: 30px;" type="button" class="submit" data-toggle="modal" data-target="#modal_emails"  >Esqueceu a senha!</button>
</div>
</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="<?= base_url(); ?>assets/js/login.js"></script>
    

</body>
</html>
