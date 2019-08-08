<script>
    function removeMensagem() {
        setTimeout(function () {
            var msg = document.getElementById("rem");
            msg.parentNode.removeChild(msg);
            // window.location = '<?php // echo $local;                                   ?>';
        }, 2000);
    }
    document.onreadystatechange = () => {
        if (document.readyState === 'complete') {
            // toda vez que a página carregar, vai limpar a mensagem (se houver) após 5 segundos
            removeMensagem();
        }
    };
</script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnviaEmail extends CI_Controller {

    public function enviandoemail() {
        $this->load->model('Model_atendimento', 'atendimento');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $id_chamado = $this->input->post('id_atend');
        $dados_atendimento = $this->atendimento->detalhesAtendimento($id_chamado);
        $dados_interacao = $this->atendimento->detalhesInteracao($id_chamado);
        $enviarbeneficiario = $this->input->post('enviarbeneficiario');
        $enviarparacliente = $this->input->post('enviarparacliente');
        $email_beneficiario = $this->input->post('emailbeneficiario');
        $email_cliente = $this->input->post('emailCliente');
        $email_opcional = $this->input->post('email_opcional');
        $para = $this->input->post('emailbeneficiario');    //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail de Destino'
        $data = date('d/m/Y H:i:s');
        //  $imagem = "<img src='http://www.newportconsultoria.com.br/newport/assets/images/logo.JPG'";
        // $dta_solicitacao = date('d/m/Y', strtotime($dados_atendimento->data_inicio));
        if ($para != null) {
            if (($enviarbeneficiario == 'sim') || ($enviarparacliente == 'sim')) {
                $de = 'contato@newportconsultoria.com.br';       //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail Remetente'
                $msg = "Olá $dados_atendimento->nome_atendimento,\n\n segue a descrição do seu atendimento\n\n
                $dados_atendimento->obs\n";
                if ($dados_interacao != null) {
                    foreach ($dados_interacao as $value) {
                        $msg .= "Interações:\n
                Criada em: " . date('d/m/Y', strtotime($value->data_add)) . "\n
                Descrição: " . $value->observacao . "\n
                Previsão de Retorno: " . $value->prev_retorno . "\n\n";
                    }
                } else {
                    $msg .= "Não possui interações";
                }
                $msg .= "\n\nAtenciosamente,\n
                Newportconsultoria
                Enviado em : $data\n\n\n\n";
                //  echo $imagem;

                $this->load->library('email');                   //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
                $this->email->from($de, 'Newport Consultoria');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
                $this->email->to($para);                         //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
                $this->email->bcc('fabio@newportconsultoria.com.br','edlaine@newportconsultoria.com.br');
                if ($enviarparacliente == 'sim') {
                    $this->email->cc('adrianoinforeis@gmail.com');     //copia
                }
                if ($email_opcional != null) {
                    $this->email->cc($email_opcional);
                }
                $this->email->subject('O seu atendimento foi criado com sucesso');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
                $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
                // $this->email->attach($base . 'assets/images/logo.JPG');   //anexo
                $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
                echo $this->email->print_debugger();             //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR
                // $this->load->view('enviou');
                $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
                $chamados = $this->atendimento->getAtendimentos();
                $dados['dados_geral'] = array(
                    // 'emails_beneficiario' => $emails_beneficiario,
                    'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);

                $this->load->view('includes/heade_adm');
                $this->load->view('includes/menu');
                $this->load->view('home', $dados);
                echo '<div class="alert alert-success" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Informação !</strong> E-mail enviado com sucesso.
                </div>';
                $this->load->view('abre_chamado_modal', $dados);
                $this->load->view('sair_sistema_modal');
            }
        } else {  //não envia o e-mail pois o associado não tem email
            $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
            $chamados = $this->atendimento->getAtendimentos();
            $dados['dados_geral'] = array(
                // 'emails_beneficiario' => $emails_beneficiario,
                'atendimentos' => $chamados,
                'abre_solicitacao' => $abre_solicitacao);

            $this->load->view('includes/heade_adm');
            $this->load->view('includes/menu');
            $this->load->view('home', $dados);
            echo '<div class="alert alert-danger" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Atenção !</strong> Beneficiádo não possui e-mail cadastrado.
                </div>';


            $this->load->view('abre_chamado_modal', $dados);
            $this->load->view('sair_sistema_modal');
        }
    }
        public function enviandoemailClienteRelatorio() {
        $this->load->model('Model_faturamento', 'faturamento');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $id_fatura = $this->input->post('id_fatura');
        $id_cliente = $this->input->post('id_cliente');
        $mes = $this->input->post('mes');
        $ano = $this->input->post('ano');
        $filtro_tabela = $this->input->post('filtro_tabela');
        $dados_atendimento = $this->faturamento->detalhesDasFaturasEnviarEmail($id_cliente, $mes, $ano);
        
        if ($this->input->post('detalhes') != null) {
            $detalhes = 'Maiores informações: ' . $this->input->post('detalhes');
        } else {
            $detalhes = null;
        }
        $totalEmails = $this->input->post('totalPlanos');
        if($totalEmails == '1'){
        $email_cliente = $this->input->post('emailCliente0');
        $email_cliente2 = null;
         $email_cliente3 = null;
         $email_cliente4 = null;
         $email_cliente5 = null;
        }elseif($totalEmails == '2'){
        $email_cliente = $this->input->post('emailCliente1');
        $email_cliente2 = $this->input->post('emailCliente21');
          $email_cliente1 = null;
          $email_cliente4 = null;
          $email_cliente5 = null;
        // $email_cliente2 = null;
         $email_cliente3 = null;  
        }elseif($totalEmails == '3'){
        $email_cliente = $this->input->post('emailCliente1');
        $email_cliente2 = $this->input->post('emailCliente21');
        $email_cliente3 = $this->input->post('emailCliente2221');
           $email_cliente1 = null;  
           $email_cliente4 = null;
           $email_cliente5 = null;
        }elseif($totalEmails == '4'){
        $email_cliente = $this->input->post('emailCliente1');
        $email_cliente2 = $this->input->post('emailCliente21');
        $email_cliente3 = $this->input->post('emailCliente2221');
        $email_cliente4 = $this->input->post('emailCliente2321');
        $email_cliente1 = null; 
        $email_cliente5 = null;
        }elseif($totalEmails == '5'){
        $email_cliente = $this->input->post('emailCliente1');
        $email_cliente2 = $this->input->post('emailCliente21');
        $email_cliente3 = $this->input->post('emailCliente2221');
        $email_cliente4 = $this->input->post('emailCliente2421');
        $email_cliente1 = null; 
        $email_cliente5 = null;
        }else{
         $email_cliente1 = null;
         $email_cliente2 = null;
         $email_cliente3 = null;
         $email_cliente4 = null;
         $email_cliente5 = null;
        }
        
        $email_opcional = $this->input->post('email_opcional');
        $para = $email_cliente;
        $data = date('d/m/Y H:i:s');
        $fat_vcto = $this->input->post('fat_vencimento');
        if (($para != null) && ($dados_atendimento != null)) {
        $d['id_cliente'] = $id_cliente;
        $d['id_fatura'] = $id_fatura;
        if($email_cliente2 != null){
        $d['email'] = $email_cliente.','.$email_opcional.','.$email_cliente2;    
        }else if($email_cliente3 != null){
        $d['email'] = $email_cliente.','.$email_opcional.','.$email_cliente2.','.$email_cliente3;
        }else if($email_cliente4 != null){
        $d['email'] = $email_cliente.','.$email_opcional.','.$email_cliente2.','.$email_cliente3.','.$email_cliente4;
        }
        else{
         $d['email'] = $email_cliente.','.$email_opcional;   
        }
        $this->faturamento->addEmailsFaturamento($d);
            //vai atualizar a tabela faturamento
            $dados['email_enviado'] = 1;
            $dados['dta_envio'] = date('d/m/Y');
            $update = $this->faturamento->envio_da_fatura($dados, $id_fatura);
            $de = 'faturamento@newportconsultoria.com.br';       //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail Remetente'
            $msg = "Olá " . $dados_atendimento[0]->nome_cliente . ", <br /> Sua fatura está disponível.<br />";
            $msg .= "Link(s) do(s) anexo(s)  <br />";
            $msg .= "$detalhes<br />";
            foreach ($dados_atendimento as $value) {
                $aenviar = $this->input->post($value->id_anexo);  //recebe o check 
                if ($aenviar == $value->id_anexo) {
                    $msg .= "<a href='http://sistemacloud.web7635.kinghost.net/newport/Intranet/baixar?arquivo=anexos/$value->nome_arquivo' title='Fatura Newport' class='btn btn-info'>Baixar anexo</a><br/>";
                }
            }
            $msg .= "<br />
                Atenciosamente,<br />
                Newport consultoria <br />
                Enviado em : $data<br /><br />";
            //  echo $imagem;

            $this->load->library('email');
           $config['mailtype'] = 'html'; //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
            $this->email->initialize($config);
            $this->email->from($de, 'Newport Consultoria');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
            $this->email->to($para);                         //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
            //$this->email->bcc('fabio@newportconsultoria.com.br','edlaine@newportconsultoria.com.br');
            if ($email_opcional != null) {
                $this->email->cc($email_opcional);     //copia
            }
            
            if ($email_cliente2 != null) {
                $this->email->cc($email_cliente2);     //copia
            }
             if ($email_cliente3 != null) {
                $this->email->cc($email_cliente3);     //copia
            }
            
            $path = 'http://sistemacloud.web7635.kinghost.net/newport/';

            $this->email->subject('Segue em anexo a fatura');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
            //$this->email->attach($path);   //anexo
            $this->email->attach($path . $dados_atendimento[0]->nome_arquivo);
            $this->email->attach('http://sistemacloud.web7635.kinghost.net/newport/anexos/' . $dados_atendimento[0]->nome_arquivo);
            $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
            echo $this->email->print_debugger();             //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR
            // $this->load->view('enviou');


            $filtro = $this->faturamento->filtroPorData($mes, $ano);
            if ($filtro != '') {
                $dados_faturamento = $filtro; //cliente
            } else {
                $dados_faturamento = $filtro;  //$this->faturamento->getFaturamento(); //cliente  
            }
            $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
            $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
            $maior_ano_contrato = $this->faturamento->getMaiorDataContrato(); //contratos
            $ano_bd = $maior_ano_contrato[0]->cont_vig_fin; //recebe o maior ano do contrato
            $maior_vencimento = substr($ano_bd, 0, 4);
            $retorno = null;
            $dados['dados_geral'] = array(
                'maior_vencimento' => $maior_vencimento,
                'dados_faturamento' => $dados_faturamento,
                'abre_solicitacao' => $abre_solicitacao,
                'retorno' => $retorno,
                'filtro_tabela' => $filtro_tabela,
                'dados_empresa' => $dados_empresa);
            $this->load->view('includes/heade_adm');
            if ($dados_faturamento != null) {
                
            } else {
                $url = '#';
                $msg = 'Não possui fatura na data informada';
                $dadosmsg['info'] = array(
                    'url' => $url,
                    'msg' => $msg);
                $this->load->view('includes/msg_error', $dadosmsg);
            }

            // $this->load->view('includes/heade_adm');
            $this->load->view('includes/menu');
            $this->load->view('cadastro_de_faturamento_relatorio', $dados);
            echo '<div class="alert alert-success" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Informação !</strong> E-mail enviado com sucesso.
                </div>';
            $this->load->view('abre_chamado_modal');
            $this->load->view('sair_sistema_modal');
        } else {  //não envia o e-mail pois o associado não tem email
            $filtro = $this->faturamento->filtroPorData($mes, $ano);
            if ($filtro != '') {
                $dados_faturamento = $filtro; //cliente
            } else {
                $dados_faturamento = $filtro;  //$this->faturamento->getFaturamento(); //cliente  
            }


            $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
            $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
            $maior_ano_contrato = $this->faturamento->getMaiorDataContrato(); //contratos
            $ano_bd = $maior_ano_contrato[0]->cont_vig_fin; //recebe o maior ano do contrato
            $maior_vencimento = substr($ano_bd, 0, 4);
            $retorno = null;
            $dados['dados_geral'] = array(
                'maior_vencimento' => $maior_vencimento,
                'dados_faturamento' => $dados_faturamento,
                'abre_solicitacao' => $abre_solicitacao,
                'retorno' => $retorno,
                'filtro_tabela' => $filtro_tabela,
                'dados_empresa' => $dados_empresa);
            $this->load->view('includes/heade_adm');
            if ($dados_faturamento != null) {
                
            } else {
                $url = '#';
                $msg = 'Não possui fatura na data informada ou e-mail do cliente incorreto';
                $dadosmsg['info'] = array(
                    'url' => $url,
                    'msg' => $msg);
                $this->load->view('includes/msg_error', $dadosmsg);
            }

            // $this->load->view('includes/heade_adm');
            $this->load->view('includes/menu');
            $this->load->view('cadastro_de_faturamento_relatorio', $dados);
            echo '<div class="alert alert-danger" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Atenção !</strong> Cliente não possui Fatura ou e-mail cadastrado.
                </div>';
            $this->load->view('abre_chamado_modal');
            $this->load->view('sair_sistema_modal');
        }
    }

    public function enviandoemailCliente() {
        $this->load->model('Model_faturamento', 'faturamento');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $id_fatura = $this->input->post('id_fatura');
        $id_cliente = $this->input->post('id_cliente');
        $mes = $this->input->post('mes');
        $ano = $this->input->post('ano');
        $filtro_tabela = $this->input->post('filtro_tabela');
        $dados_atendimento = $this->faturamento->detalhesDasFaturasEnviarEmail($id_cliente, $mes, $ano);
        
        if ($this->input->post('detalhes') != null) {
            $detalhes = 'Maiores informações: ' . $this->input->post('detalhes');
        } else {
            $detalhes = null;
        }
        $totalEmails = $this->input->post('totalPlanos');
        if($totalEmails == '1'){
        $email_cliente = $this->input->post('emailCliente0');
        $email_cliente2 = null;
         $email_cliente3 = null;
         $email_cliente4 = null;
         $email_cliente5 = null;
        }elseif($totalEmails == '2'){
        $email_cliente = $this->input->post('emailCliente1');
        $email_cliente2 = $this->input->post('emailCliente21');
          $email_cliente1 = null;
          $email_cliente4 = null;
          $email_cliente5 = null;
        // $email_cliente2 = null;
         $email_cliente3 = null;  
        }elseif($totalEmails == '3'){
        $email_cliente = $this->input->post('emailCliente1');
        $email_cliente2 = $this->input->post('emailCliente21');
        $email_cliente3 = $this->input->post('emailCliente2221');
           $email_cliente1 = null;  
           $email_cliente4 = null;
           $email_cliente5 = null;
        }elseif($totalEmails == '4'){
        $email_cliente = $this->input->post('emailCliente1');
        $email_cliente2 = $this->input->post('emailCliente21');
        $email_cliente3 = $this->input->post('emailCliente2221');
        $email_cliente4 = $this->input->post('emailCliente2321');
        $email_cliente1 = null; 
        $email_cliente5 = null;
        }elseif($totalEmails == '5'){
        $email_cliente = $this->input->post('emailCliente1');
        $email_cliente2 = $this->input->post('emailCliente21');
        $email_cliente3 = $this->input->post('emailCliente2221');
        $email_cliente4 = $this->input->post('emailCliente2421');
        $email_cliente1 = null; 
        $email_cliente5 = null;
        }else{
         $email_cliente1 = null;
         $email_cliente2 = null;
         $email_cliente3 = null;
         $email_cliente4 = null;
         $email_cliente5 = null;
        }
        
        $email_opcional = $this->input->post('email_opcional');
        $para = $email_cliente;
        $data = date('d/m/Y H:i:s');
        $fat_vcto = $this->input->post('fat_vencimento');
        if (($para != null) && ($dados_atendimento != null)) {
        $d['id_cliente'] = $id_cliente;
        $d['id_fatura'] = $id_fatura;
        if($email_cliente2 != null){
        $d['email'] = $email_cliente.','.$email_opcional.','.$email_cliente2;    
        }else if($email_cliente3 != null){
        $d['email'] = $email_cliente.','.$email_opcional.','.$email_cliente2.','.$email_cliente3;
        }else if($email_cliente4 != null){
        $d['email'] = $email_cliente.','.$email_opcional.','.$email_cliente2.','.$email_cliente3.','.$email_cliente4;
        }
        else{
         $d['email'] = $email_cliente.','.$email_opcional;   
        }
        $this->faturamento->addEmailsFaturamento($d);
            //vai atualizar a tabela faturamento
            $dados['email_enviado'] = 1;
            $dados['dta_envio'] = date('d/m/Y');
            $update = $this->faturamento->envio_da_fatura($dados, $id_fatura);
            $de = 'faturamento@newportconsultoria.com.br';       //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail Remetente'
            $msg = "Olá " . $dados_atendimento[0]->nome_cliente . ", <br /> Sua fatura está disponível.<br />";
            $msg .= "Link(s) do(s) anexo(s)  <br />";
            $msg .= "$detalhes<br />";
            
            foreach ($dados_atendimento as $value) {
                $aenviar = $this->input->post($value->id_anexo);  //recebe o check 
                $ex = substr($value->nome_arquivo, -4);
                $desc = $value->descricao;
                if ($aenviar == $value->id_anexo) {
                    $msg .= "<a href='http://sistemacloud.web7635.kinghost.net/newport/Intranet/baixar?arquivo=anexos/$value->nome_arquivo&desc=$desc&ex=$ex' title='Fatura Newport' class='btn btn-info'>Baixar anexo - $desc </a><br/>";
                }
            }
            $msg .= "<br />
                Atenciosamente,<br />
                Newport consultoria <br />
                Enviado em : $data<br /><br />";
            //  echo $imagem;

            $this->load->library('email');
            $config['mailtype'] = 'html'; //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
            $this->email->initialize($config);
            $this->email->from($de, 'Newport Consultoria');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
            $this->email->to($para);                         //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
            $this->email->bcc('fabio@newportconsultoria.com.br','edlaine@newportconsultoria.com.br');
            if ($email_opcional != null) {
                $this->email->cc($email_opcional);     //copia
            }
            
            if ($email_cliente2 != null) {
                $this->email->cc($email_cliente2);     //copia
            }
             if ($email_cliente3 != null) {
                $this->email->cc($email_cliente3);     //copia
            }
            
            $path = 'http://sistemacloud.web7635.kinghost.net/newport/anexos/';

            $this->email->subject('Segue em anexo a fatura');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
            //$this->email->attach($path);   //anexo
            foreach ($dados_atendimento as $value) {
            $aenviar = $this->input->post($value->id_anexo);  //recebe o check 
              if ($aenviar == $value->id_anexo) {
                $this->email->attach($path . $value->nome_arquivo);
              }
            //$this->email->attach('http://sistemacloud.web7635.kinghost.net/newport/anexos/' . $value->nome_arquivo);
            }
            $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
            echo $this->email->print_debugger();             //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR
            // $this->load->view('enviou');


            $filtro = $this->faturamento->filtroPorData($mes, $ano);
            if ($filtro != '') {
                $dados_faturamento = $filtro; //cliente
            } else {
                $dados_faturamento = $filtro;  //$this->faturamento->getFaturamento(); //cliente  
            }
            $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
            $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
            $maior_ano_contrato = $this->faturamento->getMaiorDataContrato(); //contratos
            $ano_bd = $maior_ano_contrato[0]->cont_vig_fin; //recebe o maior ano do contrato
            $maior_vencimento = substr($ano_bd, 0, 4);
            $retorno = null;
            $dados['dados_geral'] = array(
                'maior_vencimento' => $maior_vencimento,
                'dados_faturamento' => $dados_faturamento,
                'abre_solicitacao' => $abre_solicitacao,
                'retorno' => $retorno,
                'filtro_tabela' => $filtro_tabela,
                'dados_empresa' => $dados_empresa);
            $this->load->view('includes/heade_adm');
            if ($dados_faturamento != null) {
                
            } else {
                $url = '#';
                $msg = 'Não possui fatura na data informada';
                $dadosmsg['info'] = array(
                    'url' => $url,
                    'msg' => $msg);
                $this->load->view('includes/msg_error', $dadosmsg);
            }

            // $this->load->view('includes/heade_adm');
            $this->load->view('includes/menu');
            $this->load->view('cadastro_de_faturamento', $dados);
            echo '<div class="alert alert-success" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Informação !</strong> E-mail enviado com sucesso.
                </div>';
            $this->load->view('abre_chamado_modal');
            $this->load->view('sair_sistema_modal');
        } else {  //não envia o e-mail pois o associado não tem email
            $filtro = $this->faturamento->filtroPorData($mes, $ano);
            if ($filtro != '') {
                $dados_faturamento = $filtro; //cliente
            } else {
                $dados_faturamento = $filtro;  //$this->faturamento->getFaturamento(); //cliente  
            }


            $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
            $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
            $maior_ano_contrato = $this->faturamento->getMaiorDataContrato(); //contratos
            $ano_bd = $maior_ano_contrato[0]->cont_vig_fin; //recebe o maior ano do contrato
            $maior_vencimento = substr($ano_bd, 0, 4);
            $retorno = null;
            $dados['dados_geral'] = array(
                'maior_vencimento' => $maior_vencimento,
                'dados_faturamento' => $dados_faturamento,
                'abre_solicitacao' => $abre_solicitacao,
                'retorno' => $retorno,
                'filtro_tabela' => $filtro_tabela,
                'dados_empresa' => $dados_empresa);
            $this->load->view('includes/heade_adm');
            if ($dados_faturamento != null) {
                
            } else {
                $url = '#';
                $msg = 'Não possui fatura na data informada ou e-mail do cliente incorreto';
                $dadosmsg['info'] = array(
                    'url' => $url,
                    'msg' => $msg);
                $this->load->view('includes/msg_error', $dadosmsg);
            }

            // $this->load->view('includes/heade_adm');
            $this->load->view('includes/menu');
            $this->load->view('cadastro_de_faturamento', $dados);
            echo '<div class="alert alert-danger" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Atenção !</strong> Cliente não possui Fatura ou e-mail cadastrado.
                </div>';
            $this->load->view('abre_chamado_modal');
            $this->load->view('sair_sistema_modal');
        }
    }

    public function aniversariantes() {
        $this->load->model('Model_beneficiario', 'beneficiario');
         $esse_dia = date('d');
        $parabenizado = null;
        $tem_aniversariantes = $this->beneficiario->tem_aniversariantes($esse_dia, $parabenizado);
        
        if ($tem_aniversariantes != null && $tem_aniversariantes[0]->benef_email != '' || $tem_aniversariantes[0]->benef_email != null){
            foreach ($tem_aniversariantes as $value) {
                $id_beneficiario = $value->id_beneficiario;
                $nome = $value->nome_ben;
                $email = $value->benef_email;
                $idade = $value->idade;


                $base = base_url();
                $data = date('d/m/Y H:i:s');
                $de = 'contato@newportconsultoria.com.br';
                $para = $email;    //celio@newportconsultoria.com.br
                $msg = "<!doctype html>
                <html>
                 <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                <meta name='viewport' content='width=device-width'>
                 </head>
                <body style='width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: #FFFFFF'>

                    <div class='col-md-12'>
                 <h4>Curta seu dia em grande estilo.
                </h4>
                </div>
                <br />
                <br />
                <br />
                <div class='col-md-12'>
                <div class='table-responsive'>
                <h7>
                Parabéns pelo seu aniversário $nome! 
                Esperamos que este dia seja radiante de alegria, e aproveitado com as melhores companhias. 
                Mas uma pessoa tão especial como você é merece que todos os dias sejam igualmente especiais, únicos e inesquecíveis, não apenas o dia do aniversário. 
                E é isso mesmo que toda a equipe da Newport deseja a você, que toda sua vida seja maravilhosa e infinitamente feliz. 
                Curta seu dia em grande estilo!
                </h7>
             </div> 
         </div>
        <div class='col-md-12'>
            <footer>
                <div class='container'>
                    <div class='row'>
                        <div class='col-lg-12 text-center'>
                            <p>Atenciosamente,</p>
                            <p>© 2018 Newport Consultoria</p>
                            <p>(11) 4810-2041</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </body>
</html>
 ";
                $this->load->library('email');
                $config['mailtype'] = 'html'; //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
                $this->email->initialize($config);
                $this->email->from($de, 'Newport Consultoria');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
                $this->email->to($para);
                // $this->email->cc($copia);   //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
                $this->email->subject('FELIZ ANIVERSÁRIO !!!');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
                $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
                $this->email->attach($base . "assets/images/logo.JPG");   //anexo
                $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
                echo $this->email->print_debugger();
                
                
                
                //atualiza envio de e-mail
                $upd['parabenizado'] = 'SIM';
                $atualizaIdade = $this->beneficiario->updateBeneficiario($upd, $id_beneficiario);
            }
        }
   $this->load->view('includes/heade_adm');   
   $base = base_url();
   $url = $base.'Intranet/home';
    $msg = 'O e-mail de parabéns foi disparado com sucesso';
   $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);      
   $this->load->view('includes/msg_success', $dados);   
   $this->load->view('includes/menu');
    }
    
    public function finalizandoatendimento() {
         
        $this->load->model('Model_atendimento', 'atendimento');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $id_chamado = $this->input->post('id_chamado');
        $dados_atendimento = $this->atendimento->detalhesAtendimento($id_chamado);
        $dados_interacao = $this->atendimento->detalhesInteracao($id_chamado);
        
      //  $email1 = $this->input->post('enviarbeneficiario');
      //  $email2 = $this->input->post('enviarparacliente');
      //  $email3 = $this->input->post('emailbeneficiario');
      //  $email4 = $this->input->post('emailCliente');

        $email1 = $this->input->post('email3');
        $email2 = $this->input->post('email7');
        $email3 = $this->input->post('email11');
        $email4 = $this->input->post('email15');

        
        $data = date('d/m/Y H:i:s');
        //  $imagem = "<img src='http://www.newportconsultoria.com.br/newport/assets/images/logo.JPG'";
        // $dta_solicitacao = date('d/m/Y', strtotime($dados_atendimento->data_inicio));
        if ($email1 != null || $email2 != null || $email3 != null || $email4 != null) {
        $rdados['status'] = 'FINALIZADO';
        $rdados['andamento'] = 'FINALIZADO';
        $rdados['finalizado'] = date('Y/m/d H:i:s');
        $rdados['email_finalizacao'] = $email1.' '.$email2.' '.$email3.' '.$email4;

        $this->atendimento->updateAtendimento($rdados, $id_chamado);
        $dados_atendimento = $this->atendimento->GetAtendimentosInteracao($id_chamado);
        $de = 'contato@newportconsultoria.com.br';       //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail Remetente'
        if($dados_atendimento[0]->categoria == 'REEMBOLSO'){
                  
        $msg = "<!doctype html>
        <html>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                <meta name='viewport' content='width=device-width'>
                <link href='//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' rel='stylesheet'>
                <meta charset='utf-8'>
                <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
                <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            </head>
                <body style='width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: #FFFFFF'>

        <div class='col-md-12'>
        <h2>Prezado beneficiário,</h2>
            <h4>O reembolso solicitado foi confirmado pela sua operadora de saúde. Verifique em sua conta bancária o crédito realizado.
            </h4>
        </div>
        <div class='col-md-12'>
            <div class='table-responsive'>
                 <table id='example' class='sortable table table-bordered table-hover table-striped table table-bordered table-hover table-striped' cellspacing='0' width='100%'>
                    <thead>
                        <tr role='row' class='odd'>
                             <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i><b> Beneficiário: </b>".$dados_atendimento[0]->nome_atendimento."</td>
                        </tr>
                        <tr role='row' class='odd'>
                             <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i> <b>Data do recibo: </b>".$dados_atendimento[0]->dta_recibo."</td>
                        </tr>
                        <tr role='row' class='odd'>
                            <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i><b> Valor: R$ </b>".$dados_atendimento[0]->valor_recibo."</td>
                        </tr>
                        <tr role='row' class='odd'>
                            <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i><b> Prestador: </b>".$dados_atendimento[0]->nome_prestador."</td>
                        </tr>
                        <tr role='row' class='odd'>
                             <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i> <b>Tipo de reembolso: </b>".$dados_atendimento[0]->tipo."</td>
                        </tr>
                        <tr role='row' class='odd'>
                             <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i> <b>Data do pagamento: </b>".$dados_atendimento[0]->dta_reembolso."</td>
                        </tr>
                        <tr role='row' class='odd'>
                            <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i> <b>Valor pago: R$ </b>".$dados_atendimento[0]->valor_reembolso."</td>
                        </tr>
                    </thead>
                    <tbody> 
                    ";
        }else{
           $msg = "<!doctype html>
        <html>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                <meta name='viewport' content='width=device-width'>
            </head>
                <body style='width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: #FFFFFF'>

        <div class='col-md-12'>
            <h4>Prezado beneficiário o seu atendimento foi encerrado com sucesso.
            </h4>
        </div>
        <br />
        <br />
        <br />
        <div class='col-md-12'>
            <div class='table-responsive'>
                <table id='example' class='sortable table table-bordered table-hover table-striped table table-bordered table-hover table-striped' cellspacing='0' width='100%'>
                    <thead>
                        <tr role='row' class='odd'>
                            <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i><b> Beneficiário:</b> ".$dados_atendimento[0]->nome_atendimento."</td>
                        </tr>
                        <tr role='row' class='odd'>
                             <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i><b> Tipo de reembolso:</b> ".$dados_atendimento[0]->tipo."</td>
                        </tr>
                        <tr role='row' class='odd'>
                             <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i><b> Valor pago: R$ </b>".$dados_atendimento[0]->obs."</td>
                        </tr>
                    </thead>
                    <tbody> 
                    ";
         
        }
//        $msg .= "<tr style='align-content: center;'>
//                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><b>$result->nome_cliente</b></td>
//                                    <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>$result->cont_numero</td>
//                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>$result->cont_ramo</td>
//                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>" . date('d/m/Y', strtotime($result->cont_vige_inic)) . "</td>
//                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>" . date('d/m/Y', strtotime($result->cont_vig_fin)) . "</td>
//                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>$result->status</td>
//                            </tr>";
//                $msg = "Olá ".$dados_atendimento[0]->nome_atendimento.",\n\n O seu atendimento foi finalizado.\n\n";
//                $msg .= $dados_atendimento[0]->obs."\n";
//                if ($dados_interacao != null) {
//                    foreach ($dados_interacao as $value) {
//                        $msg .= "Interações:\n
//                Criada em: " . date('d/m/Y', strtotime($value->data_add)) . "\n
//                Descrição: " . $value->observacao . "\n";
//               // Previsão de Retorno: " . $value->prev_retorno . "\n\n";
//                }
//                } else {
//                    $msg .= "Não possui interações";
//                }
                
                
                 $msg .= "</tbody>
                </table>
            </div> 
        </div>
        <div class='col-md-12'>
            <footer>
                <div class='container'>
                    <div class='row'>
                        <div class='col-lg-12 text-center'>
                            <p>Atenciosamente,</p>
                            <p>©Newport Consultoria</p>
                            <p>(11) 4810-2041</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </body>
</html>
 ";

                $this->load->library('email');                   //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
                $config['mailtype'] = 'html'; //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
                $this->email->initialize($config);
                $this->email->from($de, 'Newport Consultoria');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
                $this->email->to($de);                         //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
                //$this->email->bcc('fabio@newportconsultoria.com.br','edlaine@newportconsultoria.com.br');
                if ($email1 != null) {
                    $this->email->cc($email1);     //copia
                }
                if ($email2 != null) {
                    $this->email->cc($email2);     //copia
                }
                if ($email3 != null) {
                    $this->email->cc($email3);     //copia
                }
                if ($email4 != null) {
                    $this->email->cc($email4);     //copia
                }
                $this->email->subject('O seu atendimento foi finalizado com sucesso');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
                $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
                // $this->email->attach($base . 'assets/images/logo.JPG');   //anexo
                $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
                echo $this->email->print_debugger();             //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR
                // $this->load->view('enviou');
                $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
                $chamados = $this->atendimento->getAtendimentos();
                $dados['dados_geral'] = array(
                    // 'emails_beneficiario' => $emails_beneficiario,
                    'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);

                $this->load->view('includes/heade_adm');
                $this->load->view('includes/menu');
                $this->load->view('home', $dados);
                echo '<div class="alert alert-success" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Informação !</strong> E-mail enviado com sucesso.
                </div>';
                $this->load->view('abre_chamado_modal', $dados);
                $this->load->view('sair_sistema_modal');
        } else {  //não envia o e-mail pois o associado não tem email
        $rdados['status'] = 'FINALIZADO';
        $rdados['andamento'] = 'FINALIZADO';
        $rdados['finalizado'] = date('Y/m/d H:i:s');

        $dados_atendimento = $this->atendimento->updateAtendimento($rdados, $id_chamado);
            $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
            $chamados = $this->atendimento->getAtendimentos();
            $dados['dados_geral'] = array(
                // 'emails_beneficiario' => $emails_beneficiario,
                'atendimentos' => $chamados,
                'abre_solicitacao' => $abre_solicitacao);

            $this->load->view('includes/heade_adm');
            $this->load->view('includes/menu');
            $this->load->view('home', $dados);
            echo '<div class="alert alert-success" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Informação !</strong> O atendimento foi encerrado com sucesso.
                </div>';


            $this->load->view('abre_chamado_modal', $dados);
            $this->load->view('sair_sistema_modal');
            
        }
    }
}
