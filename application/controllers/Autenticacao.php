<script>
    function removeMensagem() {
        setTimeout(function () {
            var msg = document.getElementById("rem_a");
            msg.parentNode.removeChild(msg);
            // window.location = '<?php // echo $local;                                   ?>';
        }, 4000);
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

class Autenticacao extends CI_Controller {

    public function limitChars($text, $limit = 4) {
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
        return implode(" ", $join) . ",";
    }

    public function Dados_de_acesso() {
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->model('Model_autenticacao', 'autenticacao');
        $email = $this->input->post('email');

        $verificacao = $this->autenticacao->EsqueceuSenha($email);

        $base = base_url();
        $data = date('d/m/Y H:i:s');
        $de = 'faleconosco@newportconsultoria.com.br';       //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail Remetente'
        $para = $email;    //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail de Destino'

        if ($verificacao != null) {
            $id = $verificacao[0]->id;
            $vezes = $verificacao[0]->esqueceu_senha;
            $dados['esqueceu_senha'] = ($vezes + 1) .'º';
            if ($vezes == 0) {
                $informo_vex = 'Primeira';
            } else {
                $informo_vex = $verificacao[0]->esqueceu_senha;
            }
            
            $this->autenticacao->atualizavezes($id, $dados); //informa quantas vezes esqueceu a se nha
            $primeiro_nome = $this->limitChars($verificacao[0]->nome, 0);
            $login = $verificacao[0]->login;
            $pass = $verificacao[0]->password;
            $msg = "Olá $primeiro_nome, conforme solicitado segue seus dados de acesso ao sistema!\n
            Essa é a $informo_vex, vez que você esqueceu seus dados de acesso.\n
            Login: $login\n
            Senha: $pass\n\n

            Enviado em : $data\n 
            Atenciosamente,\n
            Newportconsultoria";
            $this->load->library('email');                   //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
            $this->email->from($de, 'NEWPORTCONSULTORIA');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
            $this->email->to($para);
            //       $this->email->cc($copia);   //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
            $this->email->subject('Esqueceu seus dados de acesso ao sistema');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->attach($base . 'assets/images/logo.JPG');   //anexo
            $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
            echo $this->email->print_debugger();              //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR
            // $this->load->view('enviou');
            //fim e-mail
            echo '<div class="alert alert-success" id="rem_a" style="margin-top: 1%; margin-left: 18%;">
                <strong>Informação: </strong> Seus dados foram enviado ao seu e-mail.
                </div>';
            //redirect(base_url());
        } else {
            echo '<div class="alert alert-danger" id="rem_a" style="margin-top: 1%; margin-left: 18%;">
                <strong>Atenção !</strong> Esse e-mail não consta em nossa base de dados.
                </div>';
            // redirect(base_url()); 
        }
        $this->load->view('includes/heade');
        $this->load->view('index');
    }

}
