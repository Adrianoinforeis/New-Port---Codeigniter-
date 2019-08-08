<!-- Modal Cadastrar Usuario -->
<div class="modal fade abre-chamado-modal-lg" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog" style="width:760px; margin-top: 10%; margin-left: 20%;">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Novo Atendimento</h4>
                </div>
    <form method="post" action="<?= base_url(); ?>cadastrar/outros_atendimentos" data-toggle="validator" role="form">
                <div class="modal-body">

                    <div id="msgUsu2"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo_categoria">Categoria: </label>
                                <select id="tipo_categoria_10" name="tipo_categoria" required="" class="form-control">
                                    <option value="">--</option>
                                    <option value="REEMBOLSO">REEMBOLSO</option>
                                    <option value="OUTROS ATENDIMENTOS">OUTROS ATENDIMENTOS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipo_categoria">RAMO: </label>
                                <select name="ramo_plano" required="" class="form-control" id="ramo_plano_10">
                                    <option value="">Selecione o Ramo</option> 
                                    <option value="SAÚDE">SAÚDE</option>  
                                    <option value="VIDA">VIDA </option> 
                                    <option value="ODONTO">ODONTO </option> 
                                    <option value="OUTROS">OUTROS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input name="tipo_atend_chamado" type="radio" value="Sim">
                                <label for="tipo" style="font-size: 13px;">BENEFICIÁRIO</label>

                                <input name="tipo_atend_chamado" type="radio" value="Nao" >
                                <label for="tipo" style="font-size: 13px;">DEPENDENTE</label>
                                <input name="tipo" type="radio" value="Outro" id="outros_at" style="display: none;">
                                <label for="tipo" style="font-size: 13px; display: none;" id="outros_at_lab">OUTROS</label>
                                <div class="col-md-12 form-group" style="display: none;" id="beneficiario_10">
                                    <input disabled="" type="text" onkeyup="maiuscula(this)" class="form-control" placeholder="DIGITE O NOME DO BENEFICIÁRIO" id="pesquisa_solicitacao_10">
                                </div>
                                <div class="col-md-12 form-group" style="display: none;" id="dependente_10">
                                    <input disabled="" type="text" onkeyup="maiuscula(this)" class="form-control" placeholder="DIGITE O NOME DO DEPENDENTE" id="pesquisa_dependente_10">
                                </div>  
                                <div class="col-md-12 form-group" style="display: none;" id="outro_10">
                                    <input style="background-color: #ffcc99;" disabled="" type="text" name="nome_solicitante" onkeyup="maiuscula(this)" class="form-control" placeholder="DIGITE O NOME DO SOLICITANTE" id="pesquisa_outro">
                                </div>             
                                <script type="text/javascript">
                                    $('input[name="tipo_atend_chamado"]').change(function () {
                                        if ($('input[name="tipo_atend_chamado"]:checked').val() === "Sim") {
                                            $('#beneficiario_10').show();
                                            $('#dependente_10').hide();
                                            $('#outro_10').hide();
                                            $('#outros').hide();
                                            // $('.nao_socio').attr('required', 'required');
                                            //  $('.requer').removeAttr('required', 'required');
                                        } else if ($('input[name="tipo_atend_chamado"]:checked').val() === "Nao") {
                                            $('#beneficiario_10').hide();
                                            $('#dependente_10').show();
                                            $('#outro_10').hide();
                                            $('#outros').hide();
                                            // $('.resultado').removeAttr('disabled');
                                        } else if ($('input[name="tipo_atend_chamado"]:checked').val() === "Outro") {
                                            $('#beneficiario_10').hide();
                                            $('#dependente_10').hide();
                                            $('#outro_10').show();
                                            $('#outros').show();
                                            var camp2 = getElementById('#pesquisa_outro');
                                            camp2.attr('required', true);
                                            // $('.resultado').removeAttr('disabled');
                                        }
                                    });


                                    $(document).ready(function () {
                                        //Chama o evento após selecionar um valor
                                        $('#tipo_categoria_10').on('change', function () {
                                            //Verifica se o valor é igual a 1 e mostra a divCnpj
                                            if (this.value == 'OUTROS ATENDIMENTOS')
                                            {
                                                $("#outros_at").show();
                                                $("#outros_at_lab").show();
                                            } else
                                            {
                                                $("#outros_at").hide();
                                                $("#outros_at_lab").hide();
                                            }
                                        });
                                    });

                                </script>
                                <script type="text/javascript">
                                    // INICIO FUNÇÃO DE MASCARA MAIUSCULA
                                    function maiuscula(z) {
                                        v = z.value.toUpperCase();
                                        z.value = v;
                                    }
                                    //FIM DA FUNÇÃO MASCARA MAIUSCULA
                                </script>
                                <div class="col-md-12 form-group">
                                    <ul class="list-group resultado_solicitacao" style="list-style-type: none;">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="" id="outros" style="display: none; margin-top: -6%;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="atendimento_tipo">TIPO: </label>
                                        <select style="background-color: #ffcc99;" name="atendimento_tipo" required="" class="form-control">
                                            <option value="">Selecione o Tipo</option> 
                                            <option value="DÚVIDAS">DÚVIDAS</option>  
                                            <option value="OUTROS">OUTROS</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo">TELEFONE: </label>
                                        <input style="background-color: #ffcc99;" name="telefone" class="form-control" maxlength="14" onkeyup="masktel(this)" onclick="masktel(this)" onkeypress="masktel(this)" placeholder="(99) 9999-9999"> 
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="tipo">E-MAIL: </label>
                                        <input style="background-color: #ffcc99;" name="email" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="observacao">OBSERVAÇÃO</label>
                                    <textarea style="background-color: #ffcc99;" class="form-control campos_form" rows="3" minlength="10" cols="1" name="observacao" id="obs" placeholder="Descreva a dúvida ou problema com no mínimo 10 caracteres" required data-error="Por favor, informe a descrição do chamado" onkeyup="mostrarResultado(this.value, 500, 'spcontando');
                                            maiuscula(this);
                                            contarCaracteres(this.value, 500, 'sprestante')"></textarea>
                                    <span id="spcontando" class="badge">Mínimo de 10 caracteres...</span><br />
                                    <span id="sprestante" class="badge"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-md-3">   
                                    <br />
                                    <button title="CRIAR" id="teste" type="submit" class="btn btn-success ">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i> CONTINUAR</button>                     
                                </div>
                           
                        </div>
                    </div>
                </div>
 </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</button>
                  <!--  <button type="submit" class="btn btn-success" id="insCat" name="insCat"><i class="fa fa-check-circle" aria-hidden="true"></i> Continuar</button>-->
                </div>


            </div><!-- modal-content -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!-- modal -->


<script type="text/javascript">
    //pesquisa socio por nome
    var base_url = "<?php echo base_url(); ?>"
    $("#pesquisa_solicitacao_10").keyup(function () {
        var pesquisa = $(this).val();
        var categoria = $('#tipo_categoria_10').val();
        var ramo = $('#ramo_plano_10').val();
        //verifica se tem algo digitado
        // $('.resultado').attr('disabled', 'disabled');
        if (pesquisa != '' && categoria != '') {
            var dados = {
                palavra: pesquisa, //nome a pesquisar
                categoria: categoria, //categoria escolhida 
                ramo: ramo //categoria escolhida
            }
            $.post(base_url + 'Ajax/getBeneficiariosAbreSolicitacao', dados, function (retorna) {
                //mostra dentro da ul os resultados obtidos
                $(".resultado_solicitacao").html(retorna);
                //$('.resultado').removeAttr('disabled');
            });
        } else {
            $(".resultado_solicitacao").html('');
        }
    });


//pesquisa dependente
    $("#pesquisa_dependente_10").keyup(function () {
        var pesquisa = $(this).val();
        var categoria = $('#tipo_categoria_10').val();
        var ramo = $('#ramo_plano_10').val();
        //verifica se tem algo digitado
        // $('.resultado').attr('disabled', 'disabled');
        if (pesquisa != '' && categoria != '') {
            var dados = {
                palavra: pesquisa, //nome a pesquisar
                categoria: categoria, //categoria escolhida
                ramo: ramo //categoria escolhida
            }
            $.post(base_url + 'Ajax/getBeneficiariosAbreSolicitacaoDependente', dados, function (retorna) {
                //mostra dentro da ul os resultados obtidos
                $(".resultado_solicitacao").html(retorna);
                //$('.resultado').removeAttr('disabled');
            });
        } else {
            $(".resultado_solicitacao").html('');
        }
    });


    //desabilita o campo para digitar o nome
    $(function () {
        $('#tipo_categoria_10').change(function () {
            $('#pesquisa_solicitacao_10').removeAttr('disabled');
            $('#pesquisa_dependente_10').removeAttr('disabled');
            $('#pesquisa_outro').removeAttr('disabled');
            $('#pesquisa_outro').Attr('required');
            //var camp2 = getElementById('#pesquisa_outro');
           // camp2.attr('', true);
        });
    });
</script>
<script type="text/javascript" language="javascript">
    function mostrarResultado(box, num_max, campospan) {
        var contagem_carac = box.length;
        if (contagem_carac != 0) {
            document.getElementById(campospan).innerHTML = contagem_carac + " Caracteres digitados";
            if (contagem_carac == 1) {
                document.getElementById(campospan).innerHTML = contagem_carac + " Caracter digitado";
            }
            if (contagem_carac >= num_max) {
                document.getElementById(campospan).innerHTML = "Desculpe mas, foi atingido a limite máximo de caracteres!";
            }
        } else {
            document.getElementById(campospan).innerHTML = "Ainda não temos nada digitado..";
        }
    }

    function contarCaracteres(box, valor, campospan) {
        var conta = valor - box.length;
        document.getElementById(campospan).innerHTML = "Você ainda pode digitar " + conta + ", caracteres";
        if (box.length >= valor) {
            document.getElementById(campospan).innerHTML = "Você já digitou 500 caracteres.";
            document.getElementById("desc").value = document.getElementById("desc").value.substr(0, valor);
        }
    }

</script>
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
        if (e.length == 3)
            $(el).val(e + ')');
        if (e.length == 8)
            $(el).val(e + '-');
    }
</script>