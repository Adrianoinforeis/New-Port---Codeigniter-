<script>
    function removeMensagem() {
        setTimeout(function () {
            var msg = document.getElementById("rem");
            msg.parentNode.removeChild(msg);
            // window.location = '<?php // echo $local;                              ?>';
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
date_default_timezone_set('America/Sao_Paulo');
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastrar extends CI_Controller {

    public function cadastro_de_usuarios() {
        $this->load->model('Model_usuario', 'usuario');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_clientes', 'clientes');
        $id_usuario = $this->input->post('id_usuario');
        //$dados['nome'] = $this->input->post('nome');
        $dados['login'] = $this->input->post('login');
        $dados['password'] = $this->input->post('pass');
        $dados['email'] = $this->input->post('email');
        $dados['ativo'] = $this->input->post('ativo');
        $dados['permissao'] = $this->input->post('perm_adm');
        $dados['dpto'] = $this->input->post('dpto');
        $id_beneficiario = $this->input->post('nome');
        $dados_beneficiario = $this->usuario->dados_beneficiario($id_beneficiario);
        $dados['nome'] = $dados_beneficiario[0]->nome_ben;
        $dados['id_beneficiario'] = $dados_beneficiario[0]->id_beneficiario;
        $dados['aceita_email'] = $this->input->post('rec_mail');
        $login = $this->input->post('login');
        $Dados_do_login = $this->usuario->listUsersLogin($login);

        if ($id_usuario != null) {
            if ($Dados_do_login != null && $Dados_do_login[0]->id == $id_usuario) {
                $this->usuario->UpdateUsers($id_usuario, $dados);
                echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                <strong>Informaçao !</strong> alteração realizado com sucesso.
                </div>';
            } else {
                echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                <strong>Atenção !</strong> esse login já possui cadastro .
                </div>';
            }
        } else {
            if ($Dados_do_login == null) {
                $empresa = $this->input->post('empresa');
                $dados_cliente = $this->usuario->dados_cliente($empresa);
                $dados['empresa'] = $dados_cliente[0]->nome_cliente;
                $dados['tipo_acesso'] = $this->input->post('tipo_acesso');
                $this->usuario->addUsers($dados);
                echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                <strong>Informaçao !</strong> cadastro realizado com sucesso.
                </div>';
            } else {
                echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                <strong>Atenção !</strong> esse login já possui cadastro.
                </div>';
            }
        }

        $this->load->model('Model_usuario', 'usuario'); //faz a leitura da model
        $query = $this->usuario->listUsers($id_usuario); //atribui o model e function
        $dados['usuario'] = $query; //dados da consulta na array $dados

        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_cliente = $this->clientes->getclienteParausuariosSistema();
        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao,
            'dados_cliente' => $dados_cliente);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_usuarios', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
    }

    public function cadastro_de_operadoras() {
        $this->load->model('Model_operadoras', 'operadoras');
        $this->load->model('Model_contato', 'contatos');

        $dados['cnpj'] = $this->input->post('cnpj');
        $dados['nome_op'] = $this->input->post('nome');
        $dados['razao'] = ($this->input->post('razao'));
        $dados['cep'] = $this->input->post('cep');
        $dados['cidade'] = $this->input->post('cidade');
        $dados['uf'] = $this->input->post('uf');
        $dados['endereco'] = $this->input->post('endereco');
        $dados['numero'] = $this->input->post('numero');
        $dados['bairro'] = $this->input->post('bairro');
        
        $dados['cep2'] = $this->input->post('cep2');
        $dados['cidade2'] = $this->input->post('cidade2');
        $dados['uf2'] = $this->input->post('uf2');
        $dados['endereco2'] = $this->input->post('endereco2');
        $dados['numero2'] = $this->input->post('numero2');
        $dados['bairro2'] = $this->input->post('bairro2');
        
        $dados['cep3'] = $this->input->post('cep3');
        $dados['cidade3'] = $this->input->post('cidade3');
        $dados['uf3'] = $this->input->post('uf2');
        $dados['endereco3'] = $this->input->post('endereco3');
        $dados['numero3'] = $this->input->post('numero3');
        $dados['bairro3'] = $this->input->post('bairro3');
        
        $dados['obs'] = $this->input->post('obs');
        $dados['ramo'] = $this->input->post('ramo');
        $dados['ramo_1'] = $this->input->post('ramo_1');
        $dados['ramo_2'] = $this->input->post('ramo_2');
        $dados['ramo_3'] = $this->input->post('ramo_3');
        $id_operadora = $this->input->post('id_operadoras');
        if ($id_operadora != '') {
            $this->operadoras->updateOperadoras($dados, $id_operadora); //adicionando dados
        } else {
            $this->operadoras->addOperadoras($dados); //adicionando dados   
        }
        $this->load->view('includes/heade_adm');

        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);


        $dados_contato = $this->contatos->getContatos($id_operadora);
        $dados_operadora = $this->operadoras->getOperadora($id_operadora);
        $dados['dados_geral'] = array(
            'dados_operadora' => $dados_operadora,
            'dados_contato' => $dados_contato);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        //$this->load->view('editar_operadora', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function cadastro_de_contatos() {
        $this->load->model('Model_operadoras', 'operadoras');
        $this->load->model('Model_contato', 'contatos');
        if ($this->input->post('id_clientes') == '') {
            $id_operadora = $this->input->post('id_operadora'); //recebe id da view
            $info_contato['id_operadora'] = $this->input->post('id_operadora');
        } else {
            $id_operadora = $this->input->post('id_clientes');
            $info_contato['id_cliente'] = $this->input->post('id_clientes');
        }
        $dados_contato = $this->contatos->getContatos($id_operadora);
        $dados_operadora = $this->operadoras->getOperadora($id_operadora);
        $dados['dados_geral'] = array(
            'dados_operadora' => $dados_operadora,
            'dados_contato' => $dados_contato);
        $info_contato['nome'] = $this->input->post('nome');
        $info_contato['area'] = $this->input->post('area');
        $info_contato['cargo'] = $this->input->post('cargo');
        $info_contato['dtaNascimento'] = $this->input->post('dtaNascimento');
        $info_contato['telFixo'] = $this->input->post('telFixo');
        $info_contato['telCelular'] = $this->input->post('telCelular');
        $info_contato['email'] = $this->input->post('email');
        $info_contato['obs'] = $this->input->post('obs');
        $this->contatos->addContatos($info_contato); //atualiza os contatos
        $this->load->view('includes/heade_adm');
        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('editar_operadora', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function cadastro_de_contatos_cliente() {
        $this->load->model('Model_clientes', 'clientes');
        $this->load->model('Model_contato', 'contatos');

        $id_cliente = $this->input->post('id_clientes');
        $info_contato['id_cliente'] = $this->input->post('id_clientes');

        $dados_contato = $this->contatos->getContatosCliente($id_cliente);
        $dados_cliente = $this->clientes->getcliente($id_cliente);
        $dados['dados_geral'] = array(
            'dados_cliente' => $dados_cliente,
            'dados_contato' => $dados_contato);
        $info_contato['nome'] = $this->input->post('nome');
        $info_contato['area'] = $this->input->post('area');
        $info_contato['cargo'] = $this->input->post('cargo');
        $info_contato['dtaNascimento'] = $this->input->post('dtaNascimento');
        $info_contato['telFixo'] = $this->input->post('telFixo');
        $info_contato['telCelular'] = $this->input->post('telCelular');
        $info_contato['email'] = $this->input->post('email');
        $info_contato['obs'] = $this->input->post('obs');
        $this->contatos->addContatos($info_contato); //atualiza os contatos
        $this->load->view('includes/heade_adm');
        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('editar_cliente', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function contatos_operadora() {
        $this->load->model('Model_operadoras', 'operadoras');
        $this->load->model('Model_contato', 'contatos');
        $id_contato = $this->input->post('id_contato');
        $id_operadora = $this->input->post('id_operadora'); //recebe id da view

        $dados_contato = $this->contatos->getContatos($id_operadora);
        $dados_operadora = $this->operadoras->getOperadora($id_operadora);
        $dados['dados_geral'] = array(
            'dados_operadora' => $dados_operadora,
            'dados_contato' => $dados_contato);
        
        $info_contato['nome'] = $this->input->post('nome');
        $info_contato['area'] = $this->input->post('area');
        $info_contato['cargo'] = $this->input->post('cargo');
        $info_contato['dtaNascimento'] = $this->input->post('dtaNascimento');
        $info_contato['telFixo'] = $this->input->post('telFixo');
        $info_contato['telCelular'] = $this->input->post('telCelular');
        $info_contato['email'] = $this->input->post('email');
        $info_contato['obs'] = $this->input->post('obs_contato');
        // echo $this->input->post('obs');
        //var_dump($info_contato);
        $this->contatos->updateContatos($info_contato, $id_contato); //atualiza os contatos
        $this->load->view('includes/heade_adm');
        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('editar_operadora', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function contatos_cliente() {
        $this->load->model('Model_clientes', 'clientes');
        $this->load->model('Model_contato', 'contatos');
        $id_contato = $this->input->post('id_contato');
        $id_cliente = $this->input->post('id_cliente'); //recebe id da view
        $info_contato['nome'] = $this->input->post('nome');
        $info_contato['area'] = $this->input->post('area');
        $info_contato['cargo'] = $this->input->post('cargo');
        $info_contato['dtaNascimento'] = $this->input->post('dtaNascimento');
        $info_contato['telFixo'] = $this->input->post('telFixo');
        $info_contato['telCelular'] = $this->input->post('telCelular');
        $info_contato['email'] = $this->input->post('email');
        $info_contato['obs'] = $this->input->post('obs');
        $this->contatos->updateContatosCliente($info_contato, $id_contato); //atualiza os contatos

        $dados_cliente = $this->clientes->getcliente($id_cliente);
        $dados_contato = $this->contatos->getContatosCliente($id_cliente);
        $dados['dados_geral'] = array(
            'dados_cliente' => $dados_cliente,
            'dados_contato' => $dados_contato);
        $this->load->view('includes/heade_adm');
        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('editar_cliente', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function anexos_cliente() {
        $this->load->model('Model_clientes', 'clientes');
        $id_anexo = $this->input->post('id_anexo');
        $info_anexo['descricao'] = $this->input->post('descricao_anexo');
        $this->clientes->updateAnexoCliente($info_anexo, $id_anexo); //atualiza os contatos


        $this->load->view('includes/heade_adm');
        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        //$this->load->view('editar_cliente', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function anexos_contrato() {
        $this->load->model('Model_contratos', 'contrato');
        $id_anexo = $this->input->post('id_anexo');
        $id_contrato = $this->input->post('id_contrato');
        $info_anexo['descricao'] = $this->input->post('descricao_anexo');
        $this->contrato->updateAnexoContrato($info_anexo, $id_anexo); //atualiza os contatos


        $this->load->view('includes/heade_adm');
        $base = base_url();
        $url = $base . 'Intranet/edit_contratos?id_contrato=' . $id_contrato;

        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        //$this->load->view('editar_cliente', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function cadastro_de_clientes() {


        $this->load->model('Model_clientes', 'clientes');
        $this->load->model('Model_contato', 'contatos');

        $dados['cep'] = $this->input->post('cep');
        $dados['cidade'] = $this->input->post('cidade');
        $dados['uf'] = $this->input->post('uf');
        $dados['endereco'] = $this->input->post('endereco');
        $dados['numero'] = $this->input->post('numero');
        $dados['bairro'] = $this->input->post('bairro');
        $dados['status'] = $this->input->post('status');

        $dados['obs'] = $this->input->post('obs');



        $id_cliente = $this->input->post('id_clientes');
        $nome_principal = $this->input->post('nome_fantasia');
        $tipo = $this->input->post('tipo');
        $this->load->view('includes/heade_adm');
        $url = $this->input->post('url');
        if ($tipo == 'cnpj') {
            $dados['nome_cliente'] = $this->input->post('nome_fantasia');
            $dados['razao'] = ($this->input->post('razao'));
            $dados['cnpj'] = $this->input->post('cnpj');
        } else if ($tipo == 'cpf') {
            $dados['nome_cliente'] = $this->input->post('nome');
            //$dados['razao'] = ($this->input->post('razao'));
            $dados['cpf'] = $this->input->post('cpf');
            $dados['rg'] = $this->input->post('rg');
        }


        if ($id_cliente != '') {

            $ver_estip = $this->input->post('estipulante');
            if ($ver_estip == 'NÃO') {
                $dados['id_estipulante'] = '';
                $dados['estipulante'] = 'NÃO';
            } else {
                $dados['id_estipulante'] = $this->input->post('id_estipulante');
                $dados['estipulante'] = $this->input->post('estipulante');
            }
            //$dados['nome_cliente'] = $this->input->post('nome_fantasia');
            //$dados['razao'] = $this->input->post('razao');
            $this->clientes->updateClientes($dados, $id_cliente); //adicionando dados
            $msg = 'Operação efetuada com sucesso';
            $dados['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_success', $dados);
        } else {
            if ($tipo == 'cnpj') {
                $cnpj = $this->input->post('cnpj');
                $verificar_duplicidade = $this->clientes->verificar_duplicidade_cnpj($cnpj, $tipo);
                // var_dump($verificar_duplicidade);
            } else if ($tipo == 'cpf') {
                $cpf = $this->input->post('cpf');
                $verificar_duplicidade = $this->clientes->verificar_duplicidade_cpf($cpf, $tipo);
            }
            if ($verificar_duplicidade == null) {
                $dados['id_estipulante'] = $this->input->post('id_estipulante');
                $dados['estipulante'] = $this->input->post('estipulante');
                $dados['tipo'] = $this->input->post('tipo');
                $this->clientes->addClientes($dados); //adicionando dados 
                $msg = 'Operação efetuada com sucesso';
                $dados['info'] = array(
                    'url' => $url,
                    'msg' => $msg);
                $this->load->view('includes/msg_success', $dados);
            } else {
                $msg = 'Cliente ja cadastrado';
                $dados['info'] = array(
                    'url' => $url,
                    'msg' => $msg);
                $this->load->view('includes/msg_error', $dados);
            }
        }

        $dados_cliente = $this->clientes->getcliente($id_cliente);
        $dados_cliente_cadastrados = $this->clientes->getClienteTodos();
        $dados_contato = $this->contatos->getContatosCliente($id_cliente);
        $dados['dados_geral'] = array(
            'dados_cliente' => $dados_cliente,
            'dados_cliente_cadastrados' => $dados_cliente_cadastrados,
            'dados_contato' => $dados_contato);


        $this->load->view('includes/menu');
        // $this->load->view('editar_cliente', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function cadastro_de_beneficiario() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');

        //$dados['id_empresa'] = $this->input->post('id_empresa');
        $dados['nome_ben'] = $this->input->post('nome_ben');
        $dados['cpf'] = $this->input->post('cpf');
        $dados['rg'] = $this->input->post('rg');
        $dados['dtaEmissao'] = $this->input->post('dtaEmissao');
        $dados['orgexp'] = $this->input->post('orgexp');
        $dados['dtaNascimento'] = $this->input->post('dtaNascimento');
        $dados['sexo'] = $this->input->post('sexo');
        $dados['estadocivil'] = $this->input->post('estadocivil');
        $dados['admissao'] = $this->input->post('admissao');
        $dados['nome_mae'] = $this->input->post('nomemae');
        $dados['cep'] = $this->input->post('cep');
        $dados['cidade'] = $this->input->post('cidade');
        $dados['uf'] = $this->input->post('uf');
        $dados['endereco'] = $this->input->post('endereco');
        $dados['numero'] = $this->input->post('numero');
        $dados['bairro'] = $this->input->post('bairro');
        $dados['obs'] = $this->input->post('obs');
        $dados['carteirinha'] = $this->input->post('carteirinha');
        $dados['benef_email'] = $this->input->post('benef_email');
        $dados['telefone'] = $this->input->post('telefone');
        $dados['status'] = $this->input->post('status');

        $id_beneficiario = $this->input->post('id_beneficiario');
        // $verificar_duplicidade = $this->beneficiario->verificar_duplicidade($this->input->post('cpf'));

        $this->load->view('includes/heade_adm');
        if ($id_beneficiario == '' || $id_beneficiario == null) {
            $cpf = $this->input->post('cpf');
            $duplicidade = $this->beneficiario->getBeneficiariosCpf($cpf);
            if ($duplicidade == null) {
                //calculo para idade
                $data_nasc = $this->input->post('dtaNascimento');
                $dataP = explode('/', $data_nasc);
                $dataNoFormatoParaOBranco = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];
                $nascido = $dataNoFormatoParaOBranco . date(" H:i:s");

                $data_hora = date("Y-m-d H:i:s");
                $data1 = new DateTime($data_hora);
                $data2 = new DateTime($nascido);
                //Calcula a diferença
                $intervalo = $data1->diff($data2);
                $anos = ($intervalo->y);
                $meses = ($intervalo->m);
                $dias_d = ($intervalo->d);
                $multiplicames = ($meses * 30);
                $transformandomesemdias = ($multiplicames + $dias_d);
                $tempo_em_aberto = "Dias: $transformandomesemdias / Horas: &nbsp;{$intervalo->h}:{$intervalo->i}:{$intervalo->s}";



                $dados['idade'] = $anos;
                $dados['status'] = $this->input->post('status');
                $dados['id_empresa'] = $this->input->post('id_empresa');
                $ben_inserido = $this->beneficiario->addBeneficiario($dados);
                $id_benefi_do_chamado = $ben_inserido;
                $url = $this->input->post('url');
                $msg = 'Operação efetuada com sucesso';
                $dados['info'] = array(
                    'url' => $url,
                    'msg' => $msg);
                $this->load->view('includes/msg_success', $dados);
            } else {
                $id_benefi_do_chamado = null;
                $url = $this->input->post('url');
                $msg = 'Duplicidade, Beneficiário já possui cadastro';
                $dados['info'] = array(
                    'url' => $url,
                    'msg' => $msg);
                $this->load->view('includes/msg_error', $dados);
            }
        } else {
            $dados['status'] = $this->input->post('status');
            $dados['interacoes'] = $this->input->post('interacoes');
            // $dados['id_empresa'] = $this->input->post('id_empresa');
            $this->beneficiario->updateBeneficiario($dados, $id_beneficiario);
            $id_benefi_do_chamado = $id_beneficiario;
            $url = $this->input->post('url');
            $msg = 'Operação efetuada com sucesso';
            $dados['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_success', $dados);
        }

        //abrirá um chamado caso o fucnionário seja movimentação
        $status = $this->input->post('status');
        $criaratendimento = $this->input->post('criaratendimento');
        if (($status == 'MOVIMENTAÇÃO') && ($criaratendimento == 'SIM')) {
            $dados_atednimento['id_beneficiario'] = $id_benefi_do_chamado;
            $dados_atednimento['nome_atendimento'] = $this->input->post('nome_ben');
            $dados_atednimento['tipo'] = 'DÚVIDAS';
            $dados_atednimento['status'] = 'ABERTO';
            $dados_atednimento['dta_recibo'] = '';
            // $dados['dta_reembolso'] = $this->input->post('data_reembolso');
            $dados_atednimento['ini_pro_operadora'] = '';
            $dados_atednimento['valor_recibo'] = '';
            $dados_atednimento['valor_reembolso'] = '';
            // $dados['prevpagamento'] = $this->input->post('prevpagamento');
            $dados_atednimento['nome_prestador'] = '';
            $dados_atednimento['prev_retorno'] = '';
            $dados_atednimento['data_inicio'] = date('Y/m/d H:i:s');
            $dados_atednimento['categoria'] = 'OUTROS ATENDIMENTOS';
            $dados_atednimento['obs'] = 'ATENDIMENTO REFERENTE AO CADASTRO DO USUÁRIO QUE ESTÁ EM MOVIMENTAÇÃO';
            $dados_atednimento['andamento'] = 'ABERTO';
            $dados_atednimento['movimentacao'] = 'ativa';
            $session_logado = $this->session->userdata('logado');
            $dados_atednimento['criada_por'] = $session_logado[0]->login;
            $Id_solicitacao = $this->atendimento->addAtendimento($dados_atednimento);
        } else {
            $movimentacao = 'ativa';
            $verificasetemchamado = $this->atendimento->verificasetemchamado($id_benefi_do_chamado, $movimentacao);
            if ($verificasetemchamado != null) {
                $dados_at['movimentacao'] = 'inativo';
                $id = $verificasetemchamado[0]->id_atend;
                $atualizaatendimentos = $this->atendimento->UpdateAtendimentoGeral($id, $dados_at);
            }
        }




        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_funcionarios');
        $this->load->view('sair_sistema_modal');
    }

    public function cadastro_de_dependentes() {
        $this->load->model('Model_dependentes', 'dependente');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $data = $this->input->post('dtanasc');
        $dataP = explode('/', $data);
        $dataNoFormatoParaOBranco = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];
        $dataNoFormatoParaOBranco;
        //$dados['id_beneficiario'] = $this->input->post('id_beneficiario');
        $dados['nome'] = $this->input->post('nome');
        $dados['carteirinha'] = $this->input->post('carteirinha');
        $dados['sexo'] = $this->input->post('sexo');
        $dados['estadocivil'] = $this->input->post('estadocivil');
        $dados['dtanasc'] = $dataNoFormatoParaOBranco;
        $dados['cpf'] = $this->input->post('cpf');
        $dados['rg'] = $this->input->post('rg');
        $dados['dtaEmissao'] = $this->input->post('dtaEmissao');
        $dados['orgexp'] = $this->input->post('orgexp');
        $dados['parentesco'] = $this->input->post('parentesco');
        $dados['nomemae'] = $this->input->post('nomemae');
        $dados['idade'] = $this->input->post('idade');
        $dados['obs'] = $this->input->post('obs');
        $dados['status'] = $this->input->post('status');
        $status = $this->input->post('status');
        $criaratendimento = $this->input->post('criaratendimento');


        if ($this->input->post('1_check') != null) {
            $carteirinha_1 = $this->input->post('1_carteirinha');
            $plano1 = $this->input->post('1_check');
            $dados['id_plano1'] = $plano1;
            $dados['cart1'] = $carteirinha_1;
        } else {
            $dados['id_plano1'] = '';
            $dados['cart1'] = '';
        }
        if ($this->input->post('2_check') != null) {
            $carteirinha_2 = $this->input->post('2_carteirinha');
            $plano2 = $this->input->post('2_check');
            $dados['id_plano2'] = $plano2;
            $dados['cart2'] = $carteirinha_2;
        } else {
            $dados['id_plano2'] = '';
            $dados['cart2'] = '';
        }
        if ($this->input->post('3_check') != null) {
            $carteirinha_3 = $this->input->post('3_carteirinha');
            $plano3 = $this->input->post('3_check');
            $dados['id_plano3'] = $plano3;
            $dados['cart3'] = $carteirinha_3;
        } else {
            $dados['id_plano3'] = '';
            $dados['cart3'] = '';
        }
        if ($this->input->post('4_check') != null) {
            $carteirinha_4 = $this->input->post('4_carteirinha');
            $plano4 = $this->input->post('4_check');
            $dados['id_plano4'] = $plano4;
            $dados['cart4'] = $carteirinha_4;
        } else {
            $dados['id_plano4'] = '';
            $dados['cart4'] = '';
        }
        if ($this->input->post('5_check') != null) {
            $carteirinha_5 = $this->input->post('5_carteirinha');
            $plano5 = $this->input->post('5_check');
            $dados['id_plano5'] = $plano5;
            $dados['cart5'] = $carteirinha_5;
        } else {
            $dados['id_plano5'] = '';
            $dados['cart5'] = '';
        }

        $id_beneficiario = $this->input->post('id_beneficiario');
        $id_dependente = $this->input->post('id_dependente');
        if ($id_dependente == null) {
            $dados['id_beneficiario'] = $this->input->post('id_beneficiario');
            $idDepInserido = $this->dependente->addDependente($dados);
            // $id_depend_do_chamado = $idDepInserido;
        } else {
            //$dados['id_empresa'] = $this->input->post('id_empresa');
            $this->dependente->updateDependente($dados, $id_dependente);
            // $id_depend_do_chamado = $id_dependente;
        }

        if (($status == 'MOVIMENTAÇÃO') && ($criaratendimento == 'SIM')) {
            $dados_atednimento['id_beneficiario'] = $id_beneficiario;
            $dados_atednimento['nome_atendimento'] = $this->input->post('nome');
            $dados_atednimento['tipo'] = 'DÚVIDAS';
            $dados_atednimento['status'] = 'ABERTO';
            $dados_atednimento['dta_recibo'] = '';
            // $dados['dta_reembolso'] = $this->input->post('data_reembolso');
            $dados_atednimento['ini_pro_operadora'] = '';
            $dados_atednimento['valor_recibo'] = '';
            $dados_atednimento['valor_reembolso'] = '';
            // $dados['prevpagamento'] = $this->input->post('prevpagamento');
            $dados_atednimento['nome_prestador'] = '';
            $dados_atednimento['prev_retorno'] = '';
            $dados_atednimento['data_inicio'] = date('Y/m/d H:i:s');
            $dados_atednimento['categoria'] = 'OUTROS ATENDIMENTOS';
            $dados_atednimento['obs'] = 'ATENDIMENTO REFERENTE AO CADASTRO DO USUÁRIO QUE ESTÁ EM MOVIMENTAÇÃO';
            $dados_atednimento['andamento'] = 'ABERTO';
            $dados_atednimento['movimentacao'] = 'ativa';
            $session_logado = $this->session->userdata('logado');
            $dados_atednimento['criada_por'] = $session_logado[0]->login;
            $Id_solicitacao = $this->atendimento->addAtendimento($dados_atednimento);
        } else {
            $movimentacao = 'ativa';
            $verificasetemchamado = $this->atendimento->verificasetemchamado($id_beneficiario, $movimentacao);
            if ($verificasetemchamado != null) {
                $dados_at['movimentacao'] = 'inativo';
                $id = $verificasetemchamado[0]->id_atend;
                $atualizaatendimentos = $this->atendimento->UpdateAtendimentoGeral($dados_at, $id);
            }
        }
        $this->load->view('includes/heade_adm');
        $dados_beneficiario = $this->beneficiario->getBeneficiario($id_beneficiario); //benefi..
        $dados_plano_ben = $this->beneficiario->getPlanosBeneficiario($id_beneficiario); //plano
        $dados_depend_ben = $this->beneficiario->getDependenteBeneficiario($id_beneficiario); //depend
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        $dados['dados_geral'] = array(
            'dados_beneficiario' => $dados_beneficiario,
            'planos_sel_beneficiario' => $dados_plano_ben,
            'dados_dependentes' => $dados_depend_ben,
            'dados_empresa' => $dados_empresa);

        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        if ($id_dependente == null) {
            $dados['id_beneficiario'] = $this->input->post('id_beneficiario');
            $this->load->view('editar_beneficiario', $dados);
        }
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }

    public function cadastro_de_planos() {
        $this->load->model('Model_planos', 'planos');
        $dados['id_operadoras'] = $this->input->post('id_operadoras');
        $dados['pl_descricao'] = $this->input->post('pl_descricao');
        $dados['pl_nome'] = $this->input->post('pl_nome');
        //$dados['pl_valor'] = $this->input->post('pl_valor');
        $valor = $this->input->post('pl_valor');
        $tiraponto = str_replace('.', '', $valor);
        $tpontoporvirgula = str_replace(',', '.', $tiraponto);
        $dados['pl_valor'] = $tpontoporvirgula;
        $dados['obs'] = $this->input->post('obs');
        $id_planos = $this->input->post('id_planos');
        if ($id_planos == null) {
            $this->planos->addPlanos($dados);
        } else {
            $this->planos->updatePlanos($dados, $id_planos);
        }

        $dados_plano = $this->planos->getPlanosPorId($id_planos);
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $dados['dados_geral'] = array(
            'dados_planos' => $dados_plano,
            'selectOperadora' => $selectOperadora);
        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_planos', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function cadastro_de_contratos() {
        $this->load->model('Model_contratos', 'contratos');
        $dados['cont_ramo'] = $this->input->post('cont_ramo');
        $dados['cont_operadora'] = $this->input->post('cont_operadora');
        $dados['cont_cliente'] = $this->input->post('cont_cliente');
        $dados['cont_numero'] = $this->input->post('cont_numero');
        $dados['cont_dta_corte'] = $this->input->post('cont_dta_corte');
        $dados['cont_dta_vcto'] = $this->input->post('cont_dta_vcto');
        //$dados['cont_vige_inic'] = date('Y/m/d', strtotime));
        //  $dados['cont_vig_fin'] = date('Y/m/d', strtotime($this->input->post('')));
        $dados['cont_coparti'] = $this->input->post('cont_coparti');
        $dados['cont_contratacao'] = $this->input->post('cont_contratacao');
        $dados['cont_contri'] = $this->input->post('cont_contri');
        $dados['cont_obs'] = $this->input->post('cont_obs');
        $dados['status'] = $this->input->post('status');
        $dados['reajuste'] = $this->input->post('reajuste');
        //formata a data para o banco
        $vig_inicial = $this->input->post('cont_vige_inic');
        $dataP = explode('/', $vig_inicial);
        $data_vig_inicial_formatada = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];
        $dados['cont_vige_inic'] = $data_vig_inicial_formatada;

        $vig_final = $this->input->post('cont_vig_fin');
        $dataP = explode('/', $vig_final);
        $data_vig_final_formatada = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];
        $dados['cont_vig_fin'] = $data_vig_final_formatada;

        $ramo = $this->input->post('cont_ramo'); //vai subtrair as datas
        //if ($ramo == 'VIDA') {
        $vigencia_inicial = $data_vig_inicial_formatada;
        $vigencia_final = $data_vig_final_formatada;

        $data1 = new DateTime($vigencia_final);
        $data2 = new DateTime($vigencia_inicial);
        //Calcula a diferença
        $intervalo = $data1->diff($data2);
        $ano = ($intervalo->y);
        $meses = ($intervalo->m);
        $dias_d = ($intervalo->d);
        $multiplicames = ($meses * 30);
        $transformandomesemdias = ($multiplicames + $dias_d);
        $transformandomesemdias = ($multiplicames + $dias_d);
        $quant_meses = $intervalo->m;

        if ($ano != null) {
            $somaMes = ($ano * 12);
            $geral_meses = ($quant_meses + $somaMes);
        } else {
            $geral_meses = $quant_meses;
        }
        $dados['quant_parcelas'] = $geral_meses;
        //  }
        // $id_contrato = $this->input->post('id_planos');
        //  if ($id_contrato == null) {
        $this->contratos->addContratos($dados);
        // } else {
        // $this->contratos->updatePlanos($dados, $id_contrato);
        //  }
        // $dados_plano = $this->planos->getPlanosPorId($id_contrato);
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $dados['dados_geral'] = array(
            //  'dados_planos' => $dados_plano,
            'selectOperadora' => $selectOperadora);
        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_planos', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function vincular_planos() {
        $this->load->model('Model_planos_escolhidos', 'planos');
        $this->load->model('Model_atendimento', 'atendimento');
        $dados['id_beneficiario'] = $this->input->post('id_beneficiario');
        $dados['nome_plano'] = $this->input->post('nome_plano');
        
        $dados['id_operadora'] = $this->input->post('id_da_op_planos');
        $dados['dtavigencia'] = $this->input->post('dtavigencia');
        $dados['valor'] = $this->input->post('valor');
        $dados['carteirinha'] = $this->input->post('numero_carteir');
        $dados['obs'] = $this->input->post('obs');

        $vinculo = $this->input->post('vinculoe');
        if($vinculo == 'vi2_pessoal'){
        $dados['num_contrato'] = $this->input->post('numero_contrato_alt1');
        }else{
         $dados['num_contrato'] = $this->input->post('numero_contrato_alt');   
        }
        //vincula o plano ao beneficiário
        $this->planos->vincularPlanos($dados);
        $id_beneficiario = $this->input->post('id_beneficiario');
        //altera o cadastro do beneficiário
        $status['status'] = 'ATIVO';
        $this->planos->alteraStatusBeneficiario($status, $id_beneficiario);
        //altera atendimentos  se tiver
        $movimentacao = 'ativa';
        $verificasetemchamado = $this->atendimento->verificasetemchamado($id_beneficiario, $movimentacao);
        if ($verificasetemchamado != null) {
            $dados_at['movimentacao'] = 'inativo';
            $id = $verificasetemchamado[0]->id_atend;
            $atualizaatendimentos = $this->atendimento->UpdateAtendimentoGeral($dados_at, $id);
        }
        $this->load->model('Model_beneficiario', 'beneficiario');
        // $this->load->model('Model_planos', 'plano');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_beneficiario = $this->beneficiario->getBeneficiario($id_beneficiario); //benefi..
        $dados_plano_ben = $this->beneficiario->getPlanosBeneficiario($id_beneficiario); //plano
        $dados_depend_ben = $this->beneficiario->getDependenteBeneficiario($id_beneficiario); //depend
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $dados['dados_geral'] = array(
            'dados_beneficiario' => $dados_beneficiario,
            'planos_sel_beneficiario' => $dados_plano_ben,
            'dados_dependentes' => $dados_depend_ben,
            'dados_empresa' => $dados_empresa,
            'abre_solicitacao' => $abre_solicitacao,
            'selectOperadora' => $selectOperadora);

        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
        // $this->load->view('editar_beneficiario', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }

    public function alterar_planos_vinculados() {
        $this->load->model('Model_planos_escolhidos', 'planos');
        $dados['nome_plano'] = $this->input->post('planos');
        $dados['obs'] = $this->input->post('obs');
        $dados['valor'] = $this->input->post('valor');
        $dados['carteirinha'] = $this->input->post('numero_carteir');

        $id_plano_esc = $this->input->post('id_plano_esc');

        $this->planos->updatePlanosEscolhidos($dados, $id_plano_esc);


        $id_beneficiario = $this->input->post('id_beneficiario');


        $this->load->model('Model_beneficiario', 'beneficiario');
        // $this->load->model('Model_planos', 'plano');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_beneficiario = $this->beneficiario->getBeneficiario($id_beneficiario); //benefi..
        $dados_plano_ben = $this->beneficiario->getPlanosBeneficiario($id_beneficiario); //plano
        $dados_depend_ben = $this->beneficiario->getDependenteBeneficiario($id_beneficiario); //depend
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $dados['dados_geral'] = array(
            'dados_beneficiario' => $dados_beneficiario,
            'planos_sel_beneficiario' => $dados_plano_ben,
            'dados_dependentes' => $dados_depend_ben,
            'dados_empresa' => $dados_empresa,
            'abre_solicitacao' => $abre_solicitacao,
            'selectOperadora' => $selectOperadora);

        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success', $dados);
        $this->load->view('includes/menu');
       // $this->load->view('editar_beneficiario', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }

   public function cadastrar_faturamento() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');

        $this->load->view('includes/heade_adm');
        $url = $this->input->post('url');

        $mes = null;
        $ano = null;
        $mes_fat = date('m');
        $ano_fat = date('Y');
        $status = 'CANCELADO';
        $dados_contratos = $this->faturamento->GetContratosNovos($mes, $ano, $status);
         if($dados_contratos != null){
          foreach ($dados_contratos as $result) {
                $id = $result->cont_id;
                $dados['cont_id'] = $result->cont_id;
                $dados['cont_operadora'] = $result->cont_operadora;
                $dados['cont_operadora'] = $result->cont_operadora;
                $dados['cont_cliente'] = $result->cont_cliente;
                $dados['cont_numero'] = $result->cont_numero;
                $dados['cont_dta_vcto'] = $result->cont_dta_vcto;
                $dados['mes_gerado'] = $mes_fat;
                $dados['ano_gerado'] = $ano_fat;
                $this->faturamento->addFaturamento($dados); //insere os dados no bd 
                $upconts['mes_fat'] = $mes_fat;
                $upconts['ano_fat'] = $ano_fat;
                $this->faturamento->UpdateContratosFat($upconts, $id); 
        }
        $msg = 'Novo faturamento adicionado';
          $dadosmsg['info'] = array(
          'url' => $url,
          'msg' => $msg); 
          $this->load->view('includes/msg_success', $dadosmsg);
}else{
        $msg = 'Não possui novos contratos';
        $dadosmsg['info'] = array(
        'url' => $url,
        'msg' => $msg);
        $this->load->view('includes/msg_error', $dadosmsg);
    
}
        
       
          
        
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao,
            'dados_empresa' => $dados_empresa,
            'dados_faturamento' => null,
            'retorno' => null,
            'selectOperadora' => $selectOperadora);

        $this->load->view('includes/menu');
       // $this->load->view('cadastro_de_faturamento', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }
    public function impressaoRelatorioFaturamento(){
        $this->load->model('Model_faturamento', 'faturamento');
        $mes_post = $this->input->post('mes');
        $ano_post = $this->input->post('ano');
        $indicetabela = $this->input->post('indicetabela');
        $filtrotabela = $this->input->post('filtrotabela');
        
        if($indicetabela == 0){
         $filtro = $this->faturamento->filtroPorDataRelatorio($mes_post, $ano_post, $filtrotabela);
        }else if($indicetabela == 1){
         $filtro = $this->faturamento->filtroPorDataRelatorioContrato($mes_post, $ano_post, $filtrotabela);
        }else if($indicetabela == 2){
         $filtro = $this->faturamento->filtroPorDataRelatorioRamo($mes_post, $ano_post, $filtrotabela);
        }else if($indicetabela == 3){
         $filtro = $this->faturamento->filtroPorDataRelatorioDia($mes_post, $ano_post, $filtrotabela);
        }else{
         $filtro = $this->faturamento->filtroPorData($mes_post, $ano_post);
        }
       
        $dados['dados_geral'] = array(
           // 'maior_vencimento' => $maior_vencimento,
            'dados_faturamento' => $filtro
                 );
         //$this->load->view('includes/heade_adm');
        $this->load->view('cadastro_de_faturamento_relatorio_impressao', $dados);
    }

    public function filtro_faturamento_relatorio() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');
        $mes_post = $this->input->post('mes_filtro');
        $ano_post = $this->input->post('ano_filtro');
        if ($mes_post == null && $ano_post == null) {
            $mes_post = $this->input->get('mes_filtro');
            $ano_post = $this->input->get('ano_filtro');
            //recebe os dados do faturamento
            $retorno['id_do_cliente'] = $this->input->get('id_do_cliente');
            $retorno['id_faturamento'] = $this->input->get('id_faturamento');
            $retorno['mes'] = $mes_post;
            $retorno['ano'] = $ano_post;
            $filtro_tabela = $this->input->get('filtro_tabela');
        } else {
            $retorno = null; //envia os dados para exibir o modal de anexo a faturas
              $filtro_tabela = null;
        }
        $filtro = $this->faturamento->filtroPorData($mes_post, $ano_post);
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


      
        $dados['dados_geral'] = array(
            'maior_vencimento' => $maior_vencimento,
            'dados_faturamento' => $dados_faturamento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'dados_empresa' => $dados_empresa,
            'filtro_tabela' => $filtro_tabela
            );
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


        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_faturamento_relatorio', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }
            public function filtro_faturamentoRelatorio() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');
        $mes_post = $this->input->post('mes_filtro');
        $ano_post = $this->input->post('ano_filtro');
        if ($mes_post == null && $ano_post == null) {
            $mes_post = $this->input->get('mes_filtro');
            $ano_post = $this->input->get('ano_filtro');
            //recebe os dados do faturamento
            $retorno['id_do_cliente'] = $this->input->get('id_do_cliente');
            $retorno['id_faturamento'] = $this->input->get('id_faturamento');
            $retorno['mes'] = $mes_post;
            $retorno['ano'] = $ano_post;
            $filtro_tabela = $this->input->get('filtro_tabela');
        } else {
            $retorno = null; //envia os dados para exibir o modal de anexo a faturas
              $filtro_tabela = null;
        }
        $filtro = $this->faturamento->filtroPorData($mes_post, $ano_post);
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


      
        $dados['dados_geral'] = array(
            'maior_vencimento' => $maior_vencimento,
            'dados_faturamento' => $dados_faturamento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'dados_empresa' => $dados_empresa,
            'filtro_tabela' => $filtro_tabela
            );
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


        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_faturamento_relatorio', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }
        public function filtro_faturamento() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');
        $mes_post = $this->input->post('mes_filtro');
        $ano_post = $this->input->post('ano_filtro');
        if ($mes_post == null && $ano_post == null) {
            $mes_post = $this->input->get('mes_filtro');
            $ano_post = $this->input->get('ano_filtro');
            //recebe os dados do faturamento
            $retorno['id_do_cliente'] = $this->input->get('id_do_cliente');
            $retorno['id_faturamento'] = $this->input->get('id_faturamento');
            $retorno['mes'] = $mes_post;
            $retorno['ano'] = $ano_post;
            $filtro_tabela = $this->input->get('filtro_tabela');
        } else {
            $retorno = null; //envia os dados para exibir o modal de anexo a faturas
              $filtro_tabela = null;
        }
        $filtro = $this->faturamento->filtroPorData($mes_post, $ano_post);
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


      
        $dados['dados_geral'] = array(
            'maior_vencimento' => $maior_vencimento,
            'dados_faturamento' => $dados_faturamento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'dados_empresa' => $dados_empresa,
            'filtro_tabela' => $filtro_tabela
            );
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


        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_faturamento', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }
    
            public function comissoes() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');
        $mes_post = $this->input->post('mes_filtro');
        $ano_post = $this->input->post('ano_filtro');
        if ($mes_post == null && $ano_post == null) {
            $mes_post = $this->input->get('mes_filtro');
            $ano_post = $this->input->get('ano_filtro');
            //recebe os dados do faturamento
            $retorno['id_do_cliente'] = $this->input->get('id_do_cliente');
            $retorno['id_faturamento'] = $this->input->get('id_faturamento');
            $retorno['mes'] = $mes_post;
            $retorno['ano'] = $ano_post;
            $filtro_tabela = $this->input->get('filtro_tabela');
        } else {
            $retorno = null; //envia os dados para exibir o modal de anexo a faturas
              $filtro_tabela = null;
        }
        $filtro = $this->faturamento->filtroPorData($mes_post, $ano_post);
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


      
        $dados['dados_geral'] = array(
            'maior_vencimento' => $maior_vencimento,
            'dados_faturamento' => $dados_faturamento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'dados_empresa' => $dados_empresa,
            'filtro_tabela' => $filtro_tabela
            );
        $this->load->view('includes/heade_adm');
        if ($dados_faturamento != null) {
            
        } else {
            $url = '#';
            $msg = 'Não foi criada a projeção para essa data.';
            $dadosmsg['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_error', $dadosmsg);
        }


        $this->load->view('includes/menu');
        $this->load->view('comissoes', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }
    public function baixar() {
        $desc = $this->input->get("des");
        $arquivo = $_GET["arquivo"];
        if (isset($arquivo) && file_exists($arquivo)) {
            switch (strtolower(substr(strrchr(basename($arquivo), "."), 1))) {
                case "pdf": $tipo = "application/pdf";
                    $ex = ".pdf";
                    break;
                case "exe": $tipo = "application/octet-stream";
                    $ex = ".exe";
                    break;
                case "zip": $tipo = "application/zip";
                    $ex = ".zip";
                    break;
                case "doc": $tipo = "application/msword";
                    $ex = ".doc";
                    break;
                case "xls": $tipo = "application/vnd.ms-excel";
                    $ex = ".xls";
                    break;
                case "ppt": $tipo = "application/vnd.ms-powerpoint";
                    $ex = ".ppt";
                    break;
                case "gif": $tipo = "image/gif";
                    $ex = ".gif";
                    break;
                case "png": $tipo = "image/png";
                    $ex = ".png";
                    break;
                case "jpg": $tipo = "image/jpg";
                    $ex = ".jpg";
                    break;
                case "mp3": $tipo = "audio/mpeg";
                    $ex = ".mp3";
                    break;
                case "php": // deixar vazio por seurança
                case "htm": // deixar vazio por seurança
                case "html": // deixar vazio por seurança
            }
            header("Content-Type: " . $tipo); // informa o tipo do arquivo ao navegador
            //header("Content-Length: " . filesize($arquivo)); // informa o tamanho do arquivo ao navegador
            header("Content-Disposition: attachment; filename=" . basename($desc.$ex)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
            readfile($arquivo); // lê o arquivo
            exit; // aborta pós-ações
        }
//           }else{
//       $this->load->view('includes/heade_adm');
//        $msg = 'Atenção, arquivo não localizado.';
//            $dados['info'] = array(
//                'url' => $url,
//                'msg' => $msg);
//
//            $this->load->view('includes/heade_adm');
//            $this->load->view('includes/msg_error', $dados);
//        }
    }

    public function faturarContratos() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');
        $id_faturamento = $this->input->post('id_faturamento');
        $filtro_tabela = $this->input->post('filtro_tabela');
        
        $url = '#';

        $mes = $this->input->post('mes_regenerado');
        $ano = $this->input->post('ano_regenerado');
        // $dados['dta_envio'] = $this->input->post('dtaenvio');
        $valor = $this->input->post('vlfatura');
        $tiraponto = str_replace('.', '', $valor);
        $tpontoporvirgula = str_replace(',', '.', $tiraponto);

        $dados['vl_fatura'] = $tpontoporvirgula;
        $dados['vencimento'] = $this->input->post('vencimento');

        $this->faturamento->updateFaturamento($dados, $id_faturamento);
//
//        $filtro = $this->faturamento->filtroPorData($mes, $ano);
//        //$dados_faturamento = $this->faturamento->getFaturamento(); 
//        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
//        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
//        $maior_ano_contrato = $this->faturamento->getMaiorDataContrato(); //contratos
//        $ano_bd = $maior_ano_contrato[0]->cont_vig_fin; //recebe o maior ano do contrato
//        $maior_vencimento = substr($ano_bd, 0, 4);
//        $retorno = null;
//        $dados['dados_geral'] = array(
//            'dados_faturamento' => $filtro,
//            'maior_vencimento' => $maior_vencimento,
//            'abre_solicitacao' => $abre_solicitacao,
//            'retorno' => $retorno,
//            'dados_empresa' => $dados_empresa,
//            'filtro_tabela' => $filtro_tabela,
//            );
//
//
//        echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
//                <strong>Informaçao !</strong> ítem aprovado com sucesso.
//                </div>';
//        $this->load->view('includes/heade_adm');
//        // $this->load->view('includes/msg_success', $dadosmsg);
//        $this->load->view('includes/menu');
//        $this->load->view('cadastro_de_faturamento', $dados);
//        $this->load->view('sair_sistema_modal');
//        $this->load->view('abre_chamado_modal');
        
    }
    public function faturarContratosRelatorio() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');
        $id_faturamento = $this->input->post('id_faturamento');
        $filtro_tabela = $this->input->post('filtro_tabela');
        
        $url = '#';

        $mes = $this->input->post('mes_regenerado');
        $ano = $this->input->post('ano_regenerado');
        // $dados['dta_envio'] = $this->input->post('dtaenvio');
        $dados['vl_fatura'] = $this->input->post('vlfatura');
        $dados['vencimento'] = $this->input->post('vencimento');
        $this->faturamento->updateFaturamento($dados, $id_faturamento);

        $filtro = $this->faturamento->filtroPorData($mes, $ano);
        //$dados_faturamento = $this->faturamento->getFaturamento(); 
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        $maior_ano_contrato = $this->faturamento->getMaiorDataContrato(); //contratos
        $ano_bd = $maior_ano_contrato[0]->cont_vig_fin; //recebe o maior ano do contrato
        $maior_vencimento = substr($ano_bd, 0, 4);
        $retorno = null;
        $dados['dados_geral'] = array(
            'dados_faturamento' => $filtro,
            'maior_vencimento' => $maior_vencimento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'dados_empresa' => $dados_empresa,
            'filtro_tabela' => $filtro_tabela,
            );


        echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                <strong>Informaçao !</strong> ítem aprovado com sucesso.
                </div>';
        $this->load->view('includes/heade_adm');
        // $this->load->view('includes/msg_success', $dadosmsg);
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_faturamento_relatorio', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }
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

    public function outros_atendimentos() {
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->model('Model_atendimento', 'atendimento');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $dados['id_beneficiario'] = 0;
        $dados['nome_atendimento'] = $this->input->post('nome_solicitante');
        $dados['tipo'] = $this->input->post('atendimento_tipo');
        $dados['status'] = 'ABERTO';
        $dados['data_inicio'] = date('Y/m/d H:i:s');
        $dados['categoria'] = $this->input->post('tipo_categoria');
        $dados['obs'] = $this->input->post('observacao');
        $dados['andamento'] = 'ABERTO';
        $session_logado = $this->session->userdata('logado');
        $dados['criada_por'] = $session_logado[0]->login;

        $Id_solicitacao = $this->atendimento->addAtendimento($dados);
        $chamados = $this->atendimento->getAtendimentos();
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $msg = 'A solicitação foi gerada com sucesso';
        $url = base_url() . 'Intranet/home';

        $dadosmsg['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $dados['dados_geral'] = array(
            'atendimentos' => $chamados,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success_atendimento', $dadosmsg);
        $this->load->view('includes/menu');
        // $this->load->view('home');
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function criacao_de_atendimento() {
        $arquivo_a_anexar = '';
        date_default_timezone_set('America/Sao_Paulo');

        $this->load->model('Model_atendimento', 'atendimento');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $dados['id_beneficiario'] = $this->input->post('id_beneficiario');
        $dados['nome_atendimento'] = $this->input->post('nome_solicitante');
        $dados['tipo'] = $this->input->post('tipo');
        $dados['status'] = $this->input->post('status');
        $data_recibo = implode("-",array_reverse(explode("/",$this->input->post('data_recibo'))));
        $dados['dta_recibo'] = $data_recibo;
        $data_proc_ini = implode("-",array_reverse(explode("/",$this->input->post('ini_pro_operadora'))));
        $dados['ini_pro_operadora'] = $data_proc_ini;
        $dados['nome_prestador'] = $this->input->post('nome_prestador');
        $dados['prev_retorno'] = $this->input->post('data_prev_ret');
        $dados['data_inicio'] = date('Y/m/d H:i:s');
        $dados['categoria'] = $this->input->post('categoria');
        $dados['obs'] = $this->input->post('observacao');
        $dados['email_opcional'] = $this->input->post('email_opcional');
        $dados['email_beneficiario'] = $this->input->post('emailbeneficiario');
        $dados['plano_nome'] = $this->input->post('plano_nome');  
        $dados['andamento'] = 'ABERTO';
        $varc = $this->input->post('vlrecibo');
        $valor = str_replace(".", "", $varc);
        $valor_reci = str_replace(",", ".", $valor);
        $dados['valor_recibo'] = $valor_reci;
        $data_prev = implode("-",array_reverse(explode("/",$this->input->post('prevpagamento'))));
        $dados['prevpagamento'] = $data_prev;
        
//        $vareec = $this->input->post('vlrembolso');
//        $valor_ee = str_replace(".", "", $vareec);
//        $valor_reemb = str_replace(",", ".", $valor_ee);
//        $dados['valor_reembolso'] = $valor_reemb;
        
        
        
        
        
        $dados['doc'] = $this->input->post('documento');

        //atribuindo posse
        if ($this->input->post('analistas') != null) {
            $dados_res = $this->atendimento->peganomeanalista($this->input->post('analistas'));
            $dados['nome_analista'] = $dados_res[0]->nome;
        }
        $session_logado = $this->session->userdata('logado');
        $dados['criada_por'] = $session_logado[0]->login;
        $dados['atribuido_por'] = $session_logado[0]->nome;
        $dados['analista'] = $this->input->post('analistas');



        $informacoes = $this->input->post('observacao');
        //Upload de imagem da nota
        if (isset($_FILES['thumb'])) {
            $extensao = strtolower(substr($_FILES['thumb']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "anexos/";
            //Copia o arquivo dos temporários para o novo diretorio
            move_uploaded_file($_FILES['thumb']['tmp_name'], $diretorio . $novo_nome);

            if ($extensao == '') {
                $arquivo_a_anexar = '';
            } else {
                $arquivo_a_anexar = $novo_nome;
            }
        } //fim imagem

        $dados['anexo'] = $arquivo_a_anexar;

        $Id_solicitacao = $this->atendimento->addAtendimento($dados);
        //enviando e-mail
        $nome_beneficiario = $this->input->post('nome_solicitante');
        $primeiro_nome = $this->limitChars($nome_beneficiario, 0);
        $status = $this->input->post('status');
        $email_beneficiario = $this->input->post('emailbeneficiario');
        $copia = $this->input->post('email_opcional1');
        $data_re_form = $this->input->post('data_recibo');
        if($data_re_form != null){
        $data_recibo = $data_re_form;
        }else{
        $data_recibo = 'Não informada';    
        }
        $vlrecibo = $this->input->post('vlrecibo');
        $vlrecibo = $this->input->post('vlrecibo');
        $nome_prestador = $this->input->post('nome_prestador');
        $base = base_url();
        $data = date('d/m/Y H:i:s');
        $de = 'contato@newportconsultoria.com.br';       //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail Remetente'
        $para = $email_beneficiario;    //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail de Destino'
        $atendimento_tipo = $this->input->post('atendimento_tipo');
        $tipo = $this->input->post('tipo');
        if ($email_beneficiario == null && $copia != null) {
            $para = $copia;
        } else {
            $para = $email_beneficiario;
        }
        if (($email_beneficiario != null) || ($copia != null)) {
            //verificar se é reembolso ou outros
            if ($this->input->post('categoria') == 'REEMBOLSO') {
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
            <h2>
            Prezado Beneficiário,
            </h2>
    <h4>Recepcionamos os documentos para seu reembolso do seu plano e após a
        conferência daremos entrada na sua operadora.<br /> Assim que o pagemento for efetivado, você receberá um e-mail de confirmação
    </h4>
</div>
<div class='col-md-8'>
    <div class='table-responsive'> 
        <table id='example' class='sortable table table-bordered table-hover table-striped table table-bordered table-hover table-striped' cellspacing='0' width='100%'>
            <thead>
                 <tr>
                    <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i><b> Beneficiário: </b>$nome_beneficiario </td>
                    </tr>
                    <tr>
                    <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i> <b>Data do recibo: </b>$data_recibo</td>
                        </tr>
                    <tr>
                    <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i> <b>Valor R$:</b> $vlrecibo</td>
                        </tr>
                    <tr>
                    <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i> <b>Prestador:</b> $nome_prestador</td>
                        </tr>
                    <tr>
                    <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><i class='fa fa-check-circle'></i><b> Tipo de reembolso:</b> $tipo</td>
                </tr>
            </thead>
            <tbody> 
            </tbody>
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
 </html> ";
            } else {


                $msg = "Olá $primeiro_nome, gostaríamos de informar que sua solicitação de número: $Id_solicitacao, foi criada com sucesso !\n
        Segue a descrição do seu atendimento\n\n
        Informações: $informacoes\n
        Atenciosamente, Newport Consultoria\n
        Telefone: 11 4810-2041\n
        ";
                // Criado em: $data\n
                // status: $status\n\n\n\n
                // Enviado em : $data\n
                // Atenciosamente,\n
                // Newportconsultoria";
            }
            $this->load->library('email');
            $config['mailtype'] = 'html'; //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
            $this->email->initialize($config);
            $this->email->from($de, 'Newport Consultoria');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
            $this->email->to($para);
            $this->email->cc($copia);   //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
            $this->email->bcc('fabio@newportconsultoria.com.br', 'edlaine@newportconsultoria.com.br');
            if ($this->input->post('email_opcional2') != null) {
                $copia2 = $this->input->post('email_opcional2');
                $this->email->cc($copia2);
            }
            if ($this->input->post('email_opcional3') != null) {
                $copia3 = $this->input->post('email_opcional3');
                $this->email->cc($copia3);
            }
            if ($this->input->post('email_opcional4') != null) {
                $copia4 = $this->input->post('email_opcional4');
                $this->email->cc($copia4);
            }
            $this->email->subject('Informações sobre seu atendimento');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->attach($base . "assets/images/logo.JPG");   //anexo
            $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
            echo $this->email->print_debugger();             //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR
            // $this->load->view('enviou');
            //fim e-mail
        }
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $chamados = $this->atendimento->getAtendimentos();

        $msg = 'A solicitação foi gerada com sucesso';
        $session_logado = $this->session->userdata('logado');
        if ($session_logado[0]->tipo_acesso == 'Cliente') {
            $url = base_url() . 'Cliente/historico';
        } else {
            $url = base_url() . 'Intranet/home';
        }
        $dadosmsg['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $dados['dados_geral'] = array(
            'atendimentos' => $chamados,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/msg_success_atendimento', $dadosmsg);
        $this->load->view('includes/menu');
        //$this->load->view('home', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
    }

    public function criacao_de_interacao() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atendimento = $this->input->post('id_chamado');
        $dados['id_chamado'] = $this->input->post('id_chamado');
        $dados['prev_retorno'] = $this->input->post('prev_retorno');
        $dados['data_add'] = date('Y/m/d H:i:s');
        $dados['observacao'] = $this->input->post('observacao');
        $posse = $this->input->post('atender');
        if (($posse == 'posse') && ($this->input->post('analista_posse') == null)) {
            $tomaposse['analista'] = $this->input->post('analistas');
            //pegar o nome do analista
            $peganomeanalista = $this->atendimento->peganomeanalista($this->input->post('analistas'));
            $tomaposse['nome_analista'] = $peganomeanalista[0]->nome;
            $tomaposse['andamento'] = 'EM ATENDIMENTO';
            $session_logado = $this->session->userdata('logado');
            $atribuido_por = $session_logado[0]->nome;
            $tomaposse['atribuido_por'] = $atribuido_por;
            $this->atendimento->posseAoChamado($id_atendimento, $tomaposse);


            $nome = $peganomeanalista[0]->nome;
            $base = base_url();
            $data = date('d/m/Y H:i:s');
            $de = 'contato@newportconsultoria.com.br';
            //enviará e-mali para pessoa que recebeu o chamado
            $para = $peganomeanalista[0]->email;
            $msg = "Olá $nome, um novo chamado foi atribuido em sua posse por: $atribuido_por, número: $id_atendimento\n
                Enviado em : $data\n
                Atenciosamente,\n
                Newportconsultoria";
            $this->load->library('email');                   //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
            $this->email->from($de, 'Newport Consultoria');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
            $this->email->to($para);
            // $this->email->cc($this->input->post('email_opcional'));   //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
            $this->email->subject('Foi atribuido posse em atendimento');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->attach($base . 'assets/images/logo.JPG');   //anexo
            $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
            echo $this->email->print_debugger();
            $url = base_url() . "Intranet/detalhes_do_atendimento?id=$id_atendimento";
            $msg = 'Dados gravado com sucesso';
            $dadosmsg['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_success', $dadosmsg);
        } else if ($this->input->post('dados') != null) {
            $vareec = $this->input->post('vlrembolso');
            $valor_ee = str_replace(".", "", $vareec);
            $valor_reemb = str_replace(",", ".", $valor_ee);
            $dados_chamado['valor_reembolso'] = $valor_reemb;

            $dados_chamado['prevpagamento'] = $this->input->post('prevpagamento');
            $dados_chamado['dta_reembolso'] = $this->input->post('data_reembolso');
            $proc_ini_data = implode("-",array_reverse(explode("/",$this->input->post('ini_pro_operadora'))));
            $dados_chamado['ini_pro_operadora'] = $proc_ini_data;
            $dados_chamado['status'] = $this->input->post('status');
            $dados_chamado['tipo'] = $this->input->post('tipo');
            $dados_chamado['resolucao'] = $this->input->post('resolucao');
            $this->atendimento->UpdateAtendimentoGeral($id_atendimento, $dados_chamado);
            //echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
            //   <strong>Informaçao !</strong> Dados gravado com sucesso.
            //   </div>';
            $url = base_url() . "Intranet/detalhes_do_atendimento?id=$id_atendimento";
            $msg = 'Dados gravado com sucesso';
            $dadosmsg['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_success', $dadosmsg);
        } else {

            // if($this->input->post('prev_retorno') >= $this->input->post('data_abertura')){
            $this->atendimento->addInteracao($dados);
            $url = base_url() . "Intranet/detalhes_do_atendimento?id=$id_atendimento";
            $msg = 'Interação gravada com sucesso';
            $dadosmsg['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_success', $dadosmsg);
            // echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
            //  <strong>Informaçao !</strong> Interação gravada com sucesso.
            //  </div>';
            //  }else{
            //   echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
            //    <strong>Atenção !</strong> O retorno não pode ser menor que a data de abertura do chamado.
            //    </div>'; 
            // }
        }
        $dados_analistas = $this->beneficiario->selectAnalistas();
        $dados_atendimento = $this->atendimento->detalhesAtendimento($id_atendimento);
        $dados_interacoes = $this->atendimento->getInteracoes($id_atendimento);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'dados_interacoes' => $dados_interacoes,
            'dados_beneficiario' => $dados_atendimento,
            'dados_analistas' => $dados_analistas,
            'abre_solicitacao' => $abre_solicitacao);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        //$this->load->view('detalhes_atendimento', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
    }

    public function criacao_de_interacao_outros() {
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atendimento = $this->input->post('id_chamado');
        $dados['id_chamado'] = $this->input->post('id_chamado');
        $dados['prev_retorno'] = $this->input->post('prev_retorno');
        $dados['data_add'] = date('Y/m/d H:i:s');
        $dados['observacao'] = $this->input->post('observacao');
        $posse = $this->input->post('atender');
        if (($posse == 'posse') && ($this->input->post('analista_posse') == null)) {
            $tomaposse['analista'] = $this->input->post('analistas');
            //pegar o nome do analista
            $peganomeanalista = $this->atendimento->peganomeanalista($this->input->post('analistas'));
            $tomaposse['nome_analista'] = $peganomeanalista[0]->nome;
            $tomaposse['andamento'] = 'EM ATENDIMENTO';
            $session_logado = $this->session->userdata('logado');
            $atribuido_por = $session_logado[0]->nome;
            $tomaposse['atribuido_por'] = $atribuido_por;
            $this->atendimento->posseAoChamado($id_atendimento, $tomaposse);


            $nome = $peganomeanalista[0]->nome;
            $base = base_url();
            $data = date('d/m/Y H:i:s');
            $de = 'contato@newportconsultoria.com.br';
            //enviará e-mali para pessoa que recebeu o chamado
            $para = $peganomeanalista[0]->email;
            $msg = "Olá $nome, um novo chamado foi atribuido em sua posse por: $atribuido_por, número: $id_atendimento\n
                Enviado em : $data\n
                Atenciosamente,\n
                Newportconsultoria";
            $this->load->library('email');                   //CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
            $this->email->from($de, 'NEWPORTCONSULTORIA');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
            $this->email->to($para);
            // $this->email->cc($this->input->post('email_opcional'));   //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE 
            $this->email->subject('Foi atribuido posse em atendimento');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->attach($base . 'assets/images/logo.JPG');   //anexo
            $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
            echo $this->email->print_debugger();
        } else if ($this->input->post('dados') != null) {
            $dados_chamado['status'] = $this->input->post('status');
            $dados_chamado['resolucao'] = $this->input->post('resolucao');
            $this->atendimento->UpdateAtendimentoGeral($id_atendimento, $dados_chamado);
            echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                <strong>Informaçao !</strong> Dados gravada com sucesso.
                </div>';
        } else {
            $this->atendimento->addInteracao($dados);
            echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                <strong>Informaçao !</strong> Interação gravada com sucesso.
                </div>';
        }
        $dados_analistas = $this->beneficiario->selectAnalistas();
        $dados_atendimento = $this->atendimento->detalhes_outros_atendimentos($id_atendimento);
        $dados_interacoes = $this->atendimento->getInteracoes($id_atendimento);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'dados_interacoes' => $dados_interacoes,
            'dados_atendimento' => $dados_atendimento,
            'dados_analistas' => $dados_analistas,
            'abre_solicitacao' => $abre_solicitacao);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('detalhes_atendimento_outros', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
    }

    public function encerramentoAtendimento() {
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atendimento = $this->input->post('id_chamado');
        $podeenviaremail = $this->input->post('envia_email');
        //$dados['movimentacao'] = 'inativo';
        $dados['andamento'] = 'FINALIZADO';
        $dados['finalizado'] = date('Y/m/d H:i:s');

        $dados_atendimento = $this->atendimento->updateAtendimento($dados, $id_atendimento);

        $session_logado = $this->session->userdata('logado');
        $id_usuario = $session_logado[0]->id;
        $perm_usuario = $session_logado[0]->permissao;
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        if ($perm_usuario == 'Comum') {
            $chamados = $this->atendimento->getAtendimentos_comum();
        } else {
            $chamados = $this->atendimento->getAtendimentos_adm();
        }
        $getAtendimentos_outros = $this->atendimento->getAtendimentos_outros();
        $atendimentos_separados = $this->atendimento->atendimentos_separados($id_usuario);

        //  if($podeenviaremail == 'Sim'){
        $dados_chamado = $this->atendimento->detalhes_outros_atendimentos($id_atendimento);


        $nome_beneficiario = $dados_chamado->nome_atendimento;

        $primeiro_nome = $this->limitChars($nome_beneficiario, 0);
        /*
          $status = $dados_chamado->status;
          $email_beneficiario = $dados_chamado->email_beneficiario;
          $copia = $dados_chamado->email_opcional;
          $data_recibo = date('d/m/Y', strtotime($dados_chamado->dta_recibo));
          // $data_recibo = date('d/m/Y', strtotime($data_re_form));
          $vlrecibo = $dados_chamado->valor_recibo;
          $nome_prestador = $dados_chamado->nome_prestador;
          $informacoes = $dados_chamado->resolucao;
          $tipo = $dados_chamado->tipo;
          $base = base_url();
          $data = date('d/m/Y H:i:s');
          $de = 'contato@newportconsultoria.com.br';       //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail Remetente'
          $para = $email_beneficiario;    //CAPTURA O VALOR DA CAIXA DE TEXTO 'E-mail de Destino'


          if($dados_chamado->categoria == 'REEMBOLSO'){
          $msg = "<!doctype html>
          <html>
          <head>
          <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
          <meta name='viewport' content='width=device-width'>
          </head>
          <body style='width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: #FFFFFF'>

          <div class='col-md-12'>
          <h4>PREZADO BENEFICIÁRIO, RECEPCIONAMOS OS DOCUMENTOS PARA REEMBOLSO DO SEU PLANO E APÓS A
          CONFERÊNCIA DAREMOS ENTRADA NA SUA OPERADORA. ASSIM QUE O PAGAMENTO FOR EFETIVADO, VOCÊ RECEBERÁ UM E-MAIL DE CONFIRMAÇÃO
          </h4>
          </div>
          <div class='col-md-8'>
          <div class='table-responsive'>
          <table id='example' class='sortable table table-bordered table-hover table-striped table table-bordered table-hover table-striped' cellspacing='0' width='100%'>
          <thead>
          <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          </tr>
          </thead>
          <tbody>
          <tr>
          <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>NOME: $primeiro_nome </td>
          <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>DATA DO RECIBO: $data_recibo</td>
          <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>VALOR DO RECIBO R$: $vlrecibo</td>
          <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>NOME DO MÉDICO: $nome_prestador</td>
          <td style='height: 0px; margin-bottom: 1px; margin-left: 15px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>TIPO: $tipo</td>
          </tr>
          </tbody>
          </table>
          </div>
          </div>
          <div class='col-md-12'>
          <footer>
          <div class='container'>
          <div class='row'>
          <div class='col-lg-12 text-center'>
          <p>ATENCIOSAMENTE,</p>
          <p>© 2018 NEWPORT CONSULTORIA</p>
          <p>(11) 4810-2041</p>
          </div>
          </div>
          </div>
          </footer>
          </div>

          </body>
          </html> ";
          //}else{
          $msg = "OLÁ $primeiro_nome, GOSTARÍAMOS DE INFORMAR QUE SUA SOLICITAÇÃO DE NÚMERO: $id_atendimento FOI ENCERRADA COM SUCESSO !\n
          SEGUE A DESCRIÇÃO DO ATENDIMENTO\n\n
          RESOLUÇÃO: $informacoes\n
          ATENCIOSAMENTE, NEWPORT CONSULTORIA\n
          TELEFONE: 11 4810-2041\n
          ";
          // }


          $this->load->library('email');
          $config['mailtype'] = 'html';//CARREGA A CLASSE EMAIL DENTRO DA LIBRARY DO FRAMEWORK
          $this->email->initialize($config);
          $this->email->from($de, 'NEWPORTCONSULTORIA');                //ESPECIFICA O FROM(REMETENTE) DA MENSAGEM DENTRO DA CLASSE
          $this->email->to($para);
          //  $this->email->cc($copia);   //ESPECIFICA O DESTINATÁRIO DA MENSAGEM DENTRO DA CLASSE
          // if($this->input->post('email_opcional2') != null){
          // $copia2 =   $this->input->post('email_opcional2');
          // $this->email->cc($copia2);
          // }
          $this->email->subject('INFORMAÇÕES SOBRE SEU ATENDIMENTO');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
          $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
          $this->email->attach($base . 'assets/images/logo.JPG');   //anexo
          $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
          echo $this->email->print_debugger();             //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR
         */
// $this->load->view('enviou');
        //fim e-mail
// } //Verifica se pode ou não enviar o e-mail
        $parabenizado = null;
        $esse_mes = date('m');
        $tem_aniversariantes = $this->beneficiario->tem_aniversariantes($esse_mes, $parabenizado);
        $dados['dados_geral'] = array(
            // 'emails_beneficiario' => $emails_beneficiario,
            'aniversariantes' => $tem_aniversariantes,
            'atendimentos_separados' => $atendimentos_separados,
            'atendimentos' => $chamados,
            'abre_solicitacao' => $abre_solicitacao,
            'getAtendimentos_outros' => $getAtendimentos_outros);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('home', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
    }
}
