<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function index(){
        $this->load->view('teste');
    }

    public function enviandoemail() {
        $para = $this->input->post('email');
        $email_opcional = '';
        
        $data = date('d/m/Y');
            $de = 'ti@newportconsultoria.com.br';       //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail Remetente'
            $msg = "Olá ";
            $msg .= "<br />
                Atenciosamente,<br />
                Newport consultoria <br />
                Enviado em : $data<br /><br />";
            
            $this->load->library('email');
            
            $config = Array(        
            'protocol' => 'SMTP',
            'smtp_host' => 'smtp.newportconsultoria.com.br',
            'smtp_port' => 587,
            'smtp_user' => 'ti@newportconsultoria.com.br',
            'smtp_pass' => 'master2018',
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8',
            'wordwrap' => TRUE,
            'newline' => '\r\n',
        );
            $this->email->initialize($config);
            $this->email->from($de, 'NEWPORTCONSULTORIA');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
            $this->email->to($para);                         //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
            if ($email_opcional != null) {
                $this->email->cc($email_opcional);     //copia
            }

          //  $path = 'http://www.newportconsultoria.com.br/newport/anexos/';

            $this->email->subject('Segue em anexo a fatura');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
            //$this->email->attach($path);   //anexo
           // $this->email->attach($path . $dados_atendimento[0]->nome_arquivo);
           // $this->email->attach('http://www.newportconsultoria.com.br/newport/anexos/' . $dados_atendimento[0]->nome_arquivo);
            if($this->email->send()){
               echo '<div class="alert alert-success" id="rem" style="margin-top: 1%; margin-left: 18%;">
                <strong>Informação !</strong> E-mail enviado com sucesso.
                </div>';
            }
            echo $this->email->print_debugger();             //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR

    }
    public function data(){
       $this->load->view('teste');  
    }
}