<script>
    function removeMensagem() {
        setTimeout(function () {
            var msg = document.getElementById("rem");
            msg.parentNode.removeChild(msg);
            // window.location = '<?php // echo $local;                                     ?>';
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

class Intranet extends CI_Controller {

    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('Intranet/index');
        }
    }

    public function index() {
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->view('includes/heade');
        $this->load->view('index');

        //Essa parte enviará um email de relatório caso ainda não tenha sido gerado no dia de hoje
        $this->realtorios90dias();
    }

    public function autentica($indice = null) {
        $this->load->model('Model_autenticacao', 'autenticacao');
        $user = $this->input->post('usuario');
        $pass = ($this->input->post('password'));

        if (($user == '') || ($pass == '')) {
            redirect('Intranet/index');
        } else {
            $autentica = $this->autenticacao->UserAutenticacao($user, $pass);
        }

        if ($autentica == TRUE) {
            $autentica['logado'] = true;
            $this->session->set_userdata('logado', $autentica);
            $session_logado = $this->session->userdata('logado');
            $tipo_usuario = $session_logado[0]->tipo_acesso;
            if ($tipo_usuario == 'Colaborador') {
                $this->load->view('includes/heade_adm');
                $this->load->view('includes/efeito_css');
                //$this->load->view('includes/efeito_java');
                $nome = $session_logado[0]->nome;
                echo "<div id='preloader'>
                <h1 style='margin-top: 25%; margin-left: 40%;'>CARREGANDO...</h1>
                 </div>";
                $url = 'home';
                $dadosmsg['info'] = array(
                    'url' => $url,
                );
                $this->load->view('includes/efeito_java', $dadosmsg);
                // $this->load->view('includes/msg_success_logar', $dadosmsg);
                // redirect('Intranet/home');
            } else {
                $this->load->view('includes/heade_adm');
                $this->load->view('includes/efeito_css');
                echo "<div id='preloader'>
                <h1 style='margin-top: 25%; margin-left: 40%;'>CARREGANDO...</h1>
                 </div>";
                $url = 'home_newport';
                $dadosmsg['info'] = array(
                    'url' => $url,
                );
                $this->load->view('includes/efeito_java', $dadosmsg);
                // redirect('Intranet/home_newport');
            }
        } else {
            $this->load->view('includes/heade');
            echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 1%; margin-left: 1%;">
                <strong>Atenção !</strong> Dados de acesso incorretos.
                </div>';
            $this->load->view('index');
        }
    }

    public function home() { //home funcionários
        date_default_timezone_set('America/Sao_Paulo');
        $this->verificar_sessao();
        $this->realtorios90dias();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $session_logado = $this->session->userdata('logado');
        $id_usuario = $session_logado[0]->id;
        $perm_usuario = $session_logado[0]->permissao;

        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $status = 'ATIVO';
        $parabenizado = null;
        $aniversariantes = $this->beneficiario->aniversariantes($status, $parabenizado);
        // var_dump($aniversariantes);
        if ($aniversariantes != null) {  //calcular a idade
            foreach ($aniversariantes as $value) {
                //$nascido = implode("/", array_reverse(explode("-", $value->dtaNascimento)));
                $separa = explode("/", $value->dtaNascimento);
                $dia = $separa[0];
                $mes = $separa[1];
                $ano = $separa[2];
                if ($dia == date('d') && $mes == date('m')) {
                    //calcula a idade
                    $dade = $this->calcIdade($value->dtaNascimento);
                    $upd['mes_aniversario'] = $mes;
                    $upd['idade'] = $dade;
                    $upd['dia_aniversario'] = $dia;
                    $atualizaIdade = $this->beneficiario->AtualizaIdade($value->id_beneficiario, $upd);
                    $tem_aniversariantes = $value;
                }
            }
        }
        $esse_dia = date('d');
        $tem_aniversariantes = $this->beneficiario->tem_aniversariantes($esse_dia, $parabenizado);
        $chamados = $this->atendimento->getAtendimentos_adm();
        // }
        $getAtendimentos_outros = $this->atendimento->getAtendimentos_outros();
        $atendimentos_separados = $this->atendimento->atendimentos_separados($id_usuario);
        $dados['dados_geral'] = array(
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
        $this->load->view('anexo_cliente_modal');
    }

    public function calcIdade($data_nasc) {
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
        return $anos;
    }

    public function atendimentos_finalizados() { //home funcionários
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $chamados = $this->atendimento->getAtendimentosFinalizados();
        $getAtendimentos_outros = $this->atendimento->getAtendimentos_outros_finalizados();
        $dados['dados_geral'] = array(
            // 'emails_beneficiario' => $emails_beneficiario,
            'atendimentos' => $chamados,
            'getAtendimentos_outros' => $getAtendimentos_outros,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('atendimentos_finalizados', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function home_newport() { //home clientes
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $chamados = $this->atendimento->getAtendimentos();
        $dados['dados_geral'] = array(
            // 'emails_beneficiario' => $emails_beneficiario,
            'atendimentos' => $chamados,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('home_newport', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }
//      $arquivo = $_GET["arquivo"];
//        if (isset($arquivo) && file_exists($arquivo)) {
//            // forçamos o download no browser 
//            // passando como parâmetro o path original do arquivo
//            
//            force_download($arquivo, null);
//        }else{
//       $this->load->view('includes/heade_adm');
//        $msg = 'Atenção, arquivo não localizado.';
//            $dados['info'] = array(
//                'url' => $url,
//                'msg' => $msg);
//
//            $this->load->view('includes/heade_adm');
//            $this->load->view('includes/msg_error', $dados);
//        }
    public function baixar() {
        $this->load->helper('download');
        $local = $this->input->get("url");
        if($local != null){
            $url = $this->input->get("url");
        }else{
        $url = 'http://newportconsultoria.com.br/contato';    
        }
        $desc = $this->input->get("desc");
        $ext = $this->input->get("ex");
          $arquivo = $_GET["arquivo"];
          if (isset($arquivo) && file_exists($arquivo)) {
          switch (strtolower(substr(strrchr(basename($arquivo), "."), 1))) {
          case "pdf": $tipo = "application/pdf";
          break;
          case "exe": $tipo = "application/octet-stream";
          break;
          case "zip": $tipo = "application/zip";
          break;
          case "doc": $tipo = "application/msword";
          break;
          case "xls": $tipo = "application/vnd.ms-excel";
          break;
          case "ppt": $tipo = "application/vnd.ms-powerpoint";
          break;
          case "gif": $tipo = "image/gif";
          break;
          case "png": $tipo = "image/png";
          break;
          case "jpg": $tipo = "image/jpg";
          break;
          case "mp3": $tipo = "audio/mpeg";
          break;
          case "php": // deixar vazio por seurança
          case "htm": // deixar vazio por seurança
          case "html": // deixar vazio por seurança
          }
          header("Content-Type: " . $tipo); // informa o tipo do arquivo ao navegador
         // header("Content-Length: " . filesize($arquivo)); // informa o tamanho do arquivo ao navegador
          header("Content-Disposition: attachment; filename=" . basename($desc.$ext)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
          readfile($arquivo); // lê o arquivo
          exit; // aborta pós-ações
          }else{
       $this->load->view('includes/heade_adm');
        $msg = 'Atenção, arquivo não localizado.';
            $dados['info'] = array(
                'url' => $url,
                'msg' => $msg);

            $this->load->view('includes/heade_adm');
            $this->load->view('includes/msg_error', $dados);
        }
    }

    public function cadastro_de_usuarios() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_clientes', 'clientes');
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
        $this->load->view('anexo_cliente_modal');
    }

    public function usuarios_cadastrados() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $this->load->model('Model_usuario', 'usuarios');
        $dados_user = $this->usuarios->getUsuarios();

        $dados['dados_geral'] = array(
            'dados_usuario' => $dados_user,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('usuarios_cadastrados', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function editar_usuario() {
        $id = $this->input->post('id_editar'); //recebe id da view
        if ($id == NULL) { //verifica se está vazio o id
            redirect('Intranet/usuarios_cadastrados'); //redireciona
        }
        $this->load->model('Model_usuario', 'usuario'); //faz a leitura da model
        $query = $this->usuario->listUsers($id); //atribui o model e function
        if ($query == NULL) {
            redirect('Intranet/usuarios_cadastrados');
        }
        $dados['usuario'] = $query; //dados da consulta na array $dados

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('editar_usuarios', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function editar_perfil() {
        $id = $this->input->get('id'); //recebe id da view
        if ($id == NULL) { //verifica se está vazio o id
            redirect('Intranet/usuarios_cadastrados'); //redireciona
        }
        $this->load->model('Model_usuario', 'usuario'); //faz a leitura da model
        $query = $this->usuario->listUsers($id); //atribui o model e function
        if ($query == NULL) {
            redirect('Intranet/usuarios_cadastrados');
        }
        $dados['usuario'] = $query; //dados da consulta na array $dados

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('editar_usuarios', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function cadastro_de_clientes() {
        $this->verificar_sessao();
        $this->load->model('Model_clientes', 'clientes');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_cliente_cadastrados = $this->clientes->getClienteTodos();

        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao,
            'dados_cliente_cadastrados' => $dados_cliente_cadastrados,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_clientes', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function clientes_cadastrados() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'dados_cliente_cadastrados' => $dados_cliente_cadastrados,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('clientes_cadastrados', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function cadastro_de_funcionarios() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $id_beneficiario = $this->input->get('id'); //recebe id da view
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
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_funcionarios', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function beneficiarios_inativos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $id_beneficiario = $this->input->get('id'); //recebe id da view
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
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('beneficiarios_inativos', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function funcionarios_cadastrados() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('funcionarios_cadastrados', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function cadastro_de_categorias() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_categorias', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function cadastro_de_operadoras() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_operadoras', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function operadoras_cadastradas() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('operadoras_cadastradas', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function detalhes_do_atendimento() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atendimento = $this->input->get('id');

        $verificar_planos = $this->atendimento->detalhesAtendimento($id_atendimento);
        if ($verificar_planos->plano_nome != null) { 
            $dados_atendimento = $this->atendimento->detalhesAtendimento($id_atendimento);
        } else {
            $dados_atendimento = $this->atendimento->detalhesAtendimento_semplano($id_atendimento);
        }
        $dados_interacoes = $this->atendimento->getInteracoes($id_atendimento);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_analistas = $this->beneficiario->selectAnalistas();




        $dados['dados_geral'] = array( 
            'dados_interacoes' => $dados_interacoes,
            'dados_beneficiario' => $dados_atendimento,
            'dados_analistas' => $dados_analistas,
            'ver_planos' => $verificar_planos,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('detalhes_atendimento', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function detalhes_atendimento_finalizado() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atendimento = $this->input->get('id');
        $dados_atendimento = $this->atendimento->detalhesAtendimento($id_atendimento);
        $dados_interacoes = $this->atendimento->getInteracoes($id_atendimento);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'dados_interacoes' => $dados_interacoes,
            'dados_beneficiario' => $dados_atendimento,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('detalhes_atendimento_finalizado', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function detalhes_atendimento_outros() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atendimento = $this->input->get('id');
        $dados_atendimento = $this->atendimento->detalhes_outros_atendimentos($id_atendimento);
        $dados_interacoes = $this->atendimento->getInteracoes($id_atendimento);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_analistas = $this->beneficiario->selectAnalistas();
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
        $this->load->view('anexo_cliente_modal');
    }

    public function detalhes_atendimento_outros_finalizados() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atendimento = $this->input->get('id');
        $dados_atendimento = $this->atendimento->detalhes_outros_atendimentos($id_atendimento);
        $dados_interacoes = $this->atendimento->getInteracoes($id_atendimento);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_analistas = $this->beneficiario->selectAnalistas();
        $dados['dados_geral'] = array(
            'dados_interacoes' => $dados_interacoes,
            'dados_atendimento' => $dados_atendimento,
            'dados_analistas' => $dados_analistas,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('detalhes_atendimento_outros_finalizados', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function reembolso() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('reembolsos', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function atendimento() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $id_beneficiario = $this->input->get('id');
        $tipo_categoria = $this->input->get('cat');
        $nome_solicitacao = $this->input->get('nome');
        $ramo = $this->input->get('ramo');

        $dados_analistas = $this->beneficiario->selectAnalistas();
        $dados_beneficiario = $this->beneficiario->getBeneficiarioSolicitacao($id_beneficiario, $ramo);
       // die($dados_beneficiario);
        
        if ($dados_beneficiario != null) {
            $dados['dados_geral'] = array(
                'dados_beneficiario' => $dados_beneficiario,
                'nome_do_solicitante' => $nome_solicitacao,
                'dados_analistas' => $dados_analistas,
                'categoria' => $tipo_categoria);

            $this->load->view('includes/heade_adm');
            $this->load->view('includes/menu');
            $this->load->view('criar_atendimento', $dados);
            $this->load->view('sair_sistema_modal');
            $this->load->view('abre_chamado_modal');
        } else {
            //não possui planos
            // $this->load->model('Model_planos', 'plano');
            $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
            $id_beneficiario = $this->input->get('id'); //recebe id da view
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

            $url = 'filtro_beneficiario?id=' . $id_beneficiario;
            $msg = 'Atenção vincule um plano ao beneficiário';
            $dados['info'] = array(
                'url' => $url,
                'msg' => $msg);

            $this->load->view('includes/heade_adm');
            $this->load->view('includes/msg_error', $dados);
            $this->load->view('includes/menu');
            //$this->load->view('editar_beneficiario', $dados);
            $this->load->view('sair_sistema_modal');
            $this->load->view('abre_chamado_modal');
            $this->load->view('anexo_cliente_modal');
        }
    }

    public function cadastro_de_planos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $dados['dados_geral'] = array(
            'selectOperadora' => $selectOperadora,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_planos', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function cadastro_de_contratos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_contratos', 'contratos');
        $dados_contrato = $this->contratos->getContratos();
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_empresa = $this->contratos->getClientesEmpresa(); //cliente
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################dados_empresa

        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao,
            'dados_empresa' => $dados_empresa,
            'selectOperadora' => $selectOperadora,
            'dados_contrato' => $dados_contrato);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_contratos', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function cadastro_de_faturamento() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        // $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        // $dados_faturamento = $this->faturamento->getFaturamento(); //cliente
        $mes = '';
        $ano = '';
        $dados_faturamento = $this->faturamento->filtroPorData($mes, $ano);
        $maior_ano_contrato = $this->faturamento->getMaiorDataContrato(); //contratos
        $ano_bd = $maior_ano_contrato[0]->cont_vig_fin; //recebe o maior ano do contrato
        $maior_vencimento = substr($ano_bd, 0, 4);

        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################
        $mes = '';
        $ano = '';
        $filtro = $this->faturamento->filtroPorData($mes, $ano);
        $retorno = null;
        $dados['dados_geral'] = array(
            'dados_faturamento' => $filtro,
            'dados_faturamento' => $dados_faturamento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'maior_vencimento' => $maior_vencimento,
            'selectOperadora' => $selectOperadora);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_faturamento', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function filtro_operadora() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $this->load->model('Model_operadoras', 'operadoras');
        $this->load->model('Model_contato', 'contatos');
        $id_operadora = $this->input->get('id'); //recebe id da view
        $dados_contato = $this->contatos->getContatos($id_operadora);
        $dados_operadora = $this->operadoras->getOperadora($id_operadora);
        $dados['dados_geral'] = array(
            'dados_operadora' => $dados_operadora,
            'abre_solicitacao' => $abre_solicitacao,
            'dados_contato' => $dados_contato);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('editar_operadora', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function filtro_cliente() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_clientes', 'clientes');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $this->load->model('Model_contato', 'contatos');
        $this->load->model('Model_clientes', 'clientes');
        $id_cliente = $this->input->get('id'); //recebe id da view
        $dados_cliente = $this->clientes->getcliente($id_cliente);
        $dados_cliente_cadastrados = $this->clientes->getClienteTodos();
        $dados_contato = $this->contatos->getContatosCliente($id_cliente);
        $dados_contrato = $this->clientes->visualizarContratos($id_cliente);
        $anexos_cliente = $this->clientes->anexos_cliente($id_cliente);
        $dados['dados_geral'] = array(
            'dados_cliente' => $dados_cliente,
            'abre_solicitacao' => $abre_solicitacao,
            'dados_cliente_cadastrados' => $dados_cliente_cadastrados,
            'dados_contrato' => $dados_contrato,
            'anexos_cliente' => $anexos_cliente,
            'dados_contato' => $dados_contato);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('editar_cliente', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function filtro_beneficiario() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        // $this->load->model('Model_planos', 'plano');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $id_beneficiario = $this->input->get('id'); //recebe id da view
        $dados_beneficiario = $this->beneficiario->getBeneficiario($id_beneficiario); //benefi..
        $dados_plano_ben = $this->beneficiario->getPlanosBeneficiario($id_beneficiario); //plano
        // var_dump($dados_plano_ben);
        $dados_depend_ben = $this->beneficiario->getDependenteBeneficiario($id_beneficiario); //depend
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        $atendimentos = $this->beneficiario->getAtendimentosBeneficiario($id_beneficiario);
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $contratos_cliente = $this->beneficiario->contratos_cliente($id_beneficiario);

        $total_planos = $this->beneficiario->QuantidadeDePlanosBeneficiario($id_beneficiario);
        $conta_planos = $total_planos->num_rows();
        $dados['dados_geral'] = array(
            'dados_beneficiario' => $dados_beneficiario,
            'planos_sel_beneficiario' => $dados_plano_ben,
            'total_planos' => $conta_planos,
            'dados_dependentes' => $dados_depend_ben,
            'dados_empresa' => $dados_empresa,
            'abre_solicitacao' => $abre_solicitacao,
            'atendimentos' => $atendimentos,
            'selectOperadora' => $selectOperadora,
            'contratos_cliente' => $contratos_cliente
        );

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('editar_beneficiario', $dados);
        $this->load->view('sair_sistema_modal');
         $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('anexo_cliente_modal');
        
    }

    public function filtro_planos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $this->load->model('Model_planos', 'planos');
        $id_plano = $this->input->get('id'); //recebe id da view
        // $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        $dados_plano = $this->planos->getPlanosPorId($id_plano);
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################

        $dados['dados_geral'] = array(
            'dados_planos' => $dados_plano,
            'abre_solicitacao' => $abre_solicitacao,
            'selectOperadora' => $selectOperadora);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('editar_planos', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function edit_contratos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_contratos', 'contratos');
        $id_editar = $this->input->post('id_editar');
        $id_contrato = $this->input->post('id_contrato');
        if ($id_editar == null) {
            $id_editar = $this->input->get('id_contrato');
        }
        $this->load->view('includes/heade_adm');
        $dados['cont_numero'] = $this->input->post('cont_numero');

        $dados['cont_dta_corte'] = $this->input->post('cont_dta_corte');
        $dados['cont_dta_vcto'] = $this->input->post('cont_dta_vcto');
        // $dados['cont_vige_inic'] = date('Y/m/d', strtotime($this->input->post('')));
        // $dados['cont_vig_fin'] = date('Y/m/d', strtotime($this->input->post('')));
        $dados['cont_coparti'] = $this->input->post('cont_coparti');
        $dados['cont_contratacao'] = $this->input->post('cont_contratacao');
        $dados['cont_contri'] = $this->input->post('cont_contri');
        $dados['status'] = $this->input->post('status');
        $dados['cont_obs'] = $this->input->post('cont_obs');
        $dados['reajuste'] = $this->input->post('reajuste');


        $dados_renovacao_contrato = $this->contratos->dados_renovacao_contrato($id_editar);

        $dados_contrato = $this->contratos->getContratosAlteracao($id_editar);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        $anexos_contrato = $this->contratos->getAnexos($id_editar);
        $dados_beneficiarios = $this->contratos->listandoBeneficiariosContratos($id_editar); //pega os beneficiarios pertencente ao contrato
//        #################################
        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao,
            'dados_empresa' => $dados_empresa,
            'anexos_contrato' => $anexos_contrato,
            'dados_beneficiarios' => $dados_beneficiarios,
            'dados_renovacao_contrato' => $dados_renovacao_contrato,
            'dados_contrato' => $dados_contrato);

        $this->load->view('includes/menu');

        $this->load->view('editar_contratos', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function filtro_contratos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_contratos', 'contratos');
        $id_contrato = $this->input->post('id_contrato');

        $this->load->view('includes/heade_adm');

        $dados['cont_numero'] = $this->input->post('cont_numero');

        $dados['cont_dta_corte'] = $this->input->post('cont_dta_corte');
        $dados['cont_dta_vcto'] = $this->input->post('cont_dta_vcto');
        $dados['cont_coparti'] = $this->input->post('cont_coparti');
        $dados['cont_contratacao'] = $this->input->post('cont_contratacao');
        $dados['cont_contri'] = $this->input->post('cont_contri');
        $dados['status'] = $this->input->post('status');
        $dados['cont_obs'] = $this->input->post('cont_obs');
        $dados['reajuste'] = $this->input->post('reajuste');

        if ($id_contrato != null) {
            $vig_inicial = $this->input->post('cont_vige_inic');
            $dataP = explode('/', $vig_inicial);
            $data_vig_inicial_formatada = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];
            $dados['cont_vige_inic'] = $data_vig_inicial_formatada;

            $vig_final = $this->input->post('cont_vig_fin');
            $dataP = explode('/', $vig_final);
            $data_vig_final_formatada = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];
            $dados['cont_vig_fin'] = $data_vig_final_formatada;

            if ($this->input->post('status') == 'RENOVADO') {
                $dad_contrato = $this->contratos->dados_contrato_simples($id_contrato);
                $renovado['num_contrato'] = $dad_contrato[0]->cont_numero;
                $renovado['id_contrato'] = $id_contrato;
                $renovado['vig_inicial'] = $dad_contrato[0]->cont_vige_inic;
                $renovado['vig_final'] = $dad_contrato[0]->cont_vig_fin;
                $this->contratos->addRenovacao($renovado);
            }
            $this->contratos->updateContratos($dados, $id_contrato);
            
            if($this->input->post('status') == 'CANCELADO'){
            $dad_contrato = $this->contratos->dados_contrato_simples($id_contrato);
            if($dad_contrato <> null){
            foreach ($dad_contrato as $value_cont) {

            $fats['mes_gerado'] = null;
            $fats['ano_gerado'] = null;
            $this->contratos->updateContratosFaturas($fats, $value_cont->cont_id);
            }
            }
            }
            //alterar as faturas
            $faturas_desse_contrato = $this->contratos->dados_contrato_simples($id_contrato);
            if($faturas_desse_contrato <> null){
            foreach ($faturas_desse_contrato as $info) {
            $dados_fat['cont_dta_vcto'] = $this->input->post('cont_dta_vcto');
            //$fats['ano_gerado'] = null;
            $this->contratos->updateContratosFaturas($dados_fat, $info->cont_id);
            }
            }
            $dados_contrato = $this->contratos->getContratosAlteracao($id_contrato);
            $url = $this->input->post('url'); //.'?id_contrato='.$id_contrato;
            $msg = 'Operação efetuada com sucesso';
            $dados['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_success', $dados);
        } else {
            $dados_contrato = $this->contratos->getContratosAlteracao($id_contrato);
        }
        $dados_renovacao_contrato = $this->contratos->dados_renovacao_contrato($id_contrato);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente

        $dados_beneficiarios = $this->contratos->listandoBeneficiariosContratos($id_contrato); //pega os beneficiarios pertencente ao contrato

        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao,
            'dados_empresa' => $dados_empresa,
            'dados_beneficiarios' => $dados_beneficiarios,
            'dados_renovacao_contrato' => $dados_renovacao_contrato,
            'dados_contrato' => $dados_contrato);

        $this->load->view('includes/menu');

        //  $this->load->view('editar_contratos', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function visualizando_contrato() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_contratos', 'contratos');
        $id_editar = $this->input->get('identificacao');
        $id_contrato = $this->input->post('id_contrato');

        // $dados['cont_ramo'] = $this->input->post('cont_ramo');
        //$dados['cont_operadora'] = $this->input->post('cont_operadora');
        //  $dados['cont_cliente'] = $this->input->post('cont_cliente');
        $dados['cont_numero'] = $this->input->post('cont_numero');
        $dados['cont_dta_corte'] = date('Y/m/d', strtotime($this->input->post('cont_dta_corte')));
        $dados['cont_dta_vcto'] = $this->input->post('cont_dta_vcto');
        $dados['cont_vige_inic'] = date('Y/m/d', strtotime($this->input->post('cont_vige_inic')));
        $dados['cont_vig_fin'] = date('Y/m/d', strtotime($this->input->post('cont_vig_fin')));
        $dados['cont_coparti'] = $this->input->post('cont_coparti');
        $dados['cont_contratacao'] = $this->input->post('cont_contratacao');
        $dados['cont_contri'] = $this->input->post('cont_contri');
        $dados['cont_obs'] = $this->input->post('cont_obs');
        if ($id_contrato != null) {
            $this->contratos->updateContratos($dados, $id_contrato);
            $dados_contrato = $this->contratos->getContratosAlteracao($id_contrato);
            echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Informaçao !</strong> dados alterado com sucesso.
          </div>';
        } else {
            $dados_contrato = $this->contratos->getContratosAlteracao($id_editar);
        }
        $dados_renovacao_contrato = $this->contratos->dados_renovacao_contrato($id_editar);
        $anexos_contrato = $this->contratos->getAnexos($id_editar);
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################
        #################################
        $dados_beneficiarios = $this->contratos->listandoBeneficiariosContratos($id_editar); //pega os beneficiarios pertencente ao contrato
        #################################

        $dados['dados_geral'] = array(
            'abre_solicitacao' => $abre_solicitacao,
            'dados_empresa' => $dados_empresa,
            'selectOperadora' => $selectOperadora,
            'dados_beneficiarios' => $dados_beneficiarios,
            'anexos_contrato' => $anexos_contrato,
            'dados_renovacao_contrato' => $dados_renovacao_contrato,
            'dados_contrato' => $dados_contrato);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('editar_contratos', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function beneficiarios_movimentacao() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $status = 'MOVIMENTAÇÃO';
        $dados_beneficiario = $this->beneficiario->getBeneficiariosMovimentacao($status);

        $dados['dados_geral'] = array(
            'dados_beneficiario' => $dados_beneficiario,
                // 'dados_contrato' => $dados_contrato
        );
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('beneficiarios_movimentacao', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function dependente_movimentacao() {
        $this->verificar_sessao();
        $this->load->model('Model_dependentes', 'dependente');
        $status = 'MOVIMENTAÇÃO';
        $dados_beneficiario = $this->dependente->getDependentesMovimentacao($status);

        $dados['dados_geral'] = array(
            'dados_beneficiario' => $dados_beneficiario,
                // 'dados_contrato' => $dados_contrato
        );
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('dependentes_movimentacao', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function uploadArquivos() {
        $this->verificar_sessao();
        $this->load->model('Model_atendimento', 'atendimento');
        $id_chamado = $this->input->post('id_atend');
        $id_beneficiario = $this->input->post('id_beneficiario');
        $descricao = $this->input->post('descricao');
        if (isset($_FILES['arquivo'])) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "anexos/";
            //Copia o arquivo dos temporários para o novo diretorio
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

            if ($extensao == '') {
                $arquivo_a_anexar = '';
            } else {
                $arquivo_a_anexar = $novo_nome;
            }
        } //fim imagem
        $dados['nome_arquivo'] = $arquivo_a_anexar;
        //incluindo os arquivos no banco
        $dados['id_chamado'] = $id_chamado;
        $dados['descricao'] = $descricao;
        $this->atendimento->addArquivos($dados); //adiciona
        echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Informaçao !</strong> arquivos postados com sucesso.
          </div>';
        /* anexa vários arquivos de uma vez
          if (isset($_FILES['arquivo'])) {

          $diretorio = 'anexos';
          // diretório de destino do arquivo
          define('DEST_DIR', $diretorio . '/');

          if (isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['name'])) {
          // se o "name" estiver vazio, é porque nenhum arquivo foi enviado
          // cria uma variável para facilitar
          $arquivos = $_FILES['arquivo'];

          // total de arquivos enviados
          $total = count($arquivos['name']);

          for ($i = 0; $i < $total; $i++) {
          // podemos acessar os dados de cada arquivo desta forma:
          // - $arquivos['name'][$i];
          // - $arquivos['tmp_name'][$i]
          // - $arquivos['size'][$i]
          // - $arquivos['error'][$i]
          // - $arquivos['type'][$i]
          $nome_arquivo = $arquivos['name'][$i];
          //incluindo os arquivos no banco
          $dados['id_chamado'] = $id_chamado;
          $dados['nome_arquivo'] = $nome_arquivo;

          $this->atendimento->addArquivos($dados); //adiciona

          if (!move_uploaded_file($arquivos['tmp_name'][$i], DEST_DIR . '/' . $arquivos['name'][$i])) {
          $aviso = "<div class=\"alert alert-danger\">
          <strong>Atenção </strong> Erro ao enviar o(os) arquivo(s): " . $arquivos['name'][$i] . "</div>";
          echo $aviso;
          // echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../upload_holerites.php";
          //     echo "Erro ao enviar o arquivo: " . $arquivos['name'][$i];
          }
          }

          echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Informaçao !</strong> arquivos postados com sucesso.
          </div>';
          //  echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../upload_holerites.php";
          }
          }
         */

        redirect('Intranet/home');
    }

    public function uploadArquivos_cliente() {
        $this->verificar_sessao();
        $this->load->model('Model_atendimento', 'atendimento');
        $id_cliente = $this->input->post('id_clientes');
        $descricao = $this->input->post('descricao');
        if (isset($_FILES['arquivo'])) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "anexos/";
            //Copia o arquivo dos temporários para o novo diretorio
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

            if ($extensao == '') {
                $arquivo_a_anexar = '';
            } else {
                $arquivo_a_anexar = $novo_nome;
            }
        } //fim imagem
        $dados['nome_arquivo'] = $arquivo_a_anexar;
        $dados['id_cliente_anexos'] = $id_cliente;
        $dados['descricao'] = $descricao;
        $this->atendimento->addArquivos($dados); //adiciona
        /*
          echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Informaçao !</strong> arquivos postados com sucesso.
          </div>'; */
        $url = $this->input->post('url');
        $msg = 'Operação efetuada com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
    }

    public function uploadArquivos_contratos() {
        $this->verificar_sessao();
        $this->load->model('Model_atendimento', 'atendimento');
        $id_contrato = $this->input->post('id_contrato');
        $descricao = $this->input->post('descricao');
        if (isset($_FILES['arquivo'])) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "anexos/";
            //Copia o arquivo dos temporários para o novo diretorio
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

            if ($extensao == '') {
                $arquivo_a_anexar = '';
            } else {
                $arquivo_a_anexar = $novo_nome;
            }
        } //fim imagem
        $dados['nome_arquivo'] = $arquivo_a_anexar;
        $dados['id_contratos_anexos'] = $id_contrato;
        $dados['descricao'] = $descricao;
        $this->atendimento->addArquivos_contrato($dados); //adiciona
        /*
          echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Informaçao !</strong> arquivos postados com sucesso.
          </div>'; */
        $base = base_url();
        $url = $base . 'Intranet/edit_contratos?id_contrato=' . $id_contrato; //$this->input->post('url');
        $msg = 'Anexo postado com sucesso';
        $dados['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dados);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
    }

    public function uploadArquivosFaturamentoRelatorio() {
        $this->verificar_sessao();
        $this->load->model('Model_faturamento', 'faturamento');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $id_do_cliente = $this->input->post('id_do_cliente');
        $id_fatura = $this->input->post('id_fatura');
        $mes = $this->input->post('mes');
        $ano = $this->input->post('ano');
        $descricao_fat = $this->input->post('descricao');
        $filtro_tabela = $this->input->post('filtro_tabela');
        

        $dadosidanexos = $this->faturamento->pegaultimoid(); //pega o último id

        $descricao = $descricao_fat . '_' . ($dadosidanexos[0]->id_anexo + 1); //$this->input->post('descricao');
        if (isset($_FILES['arquivo'])) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "anexos/";
            //Copia o arquivo dos temporários para o novo diretorio
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

            if ($extensao == '') {
                $arquivo_a_anexar = '';
            } else {
                $arquivo_a_anexar = $novo_nome;
            }
        } //fim imagem
        $dados['nome_arquivo'] = $arquivo_a_anexar;
        //incluindo os arquivos no banco
        $dados['id_do_cliente'] = $id_do_cliente;
        $dados['id_faturamento'] = $id_fatura;
        $dados['descricao'] = $descricao;
        $dados['mes'] = $this->input->post('mes');
        $dados['ano'] = $this->input->post('ano');
        $this->faturamento->addArquivos($dados); //adiciona

        $anex_fat['id_da_fatura'] = $id_fatura;
        $anex_fat['id_do_anexo'] = $id_anexado;
        $this->faturamento->tb_anexos_fatura($anex_fat);
        
        $url = base_url() . "Cadastrar/filtro_faturamentoRelatorio?mes_filtro=$mes&ano_filtro=$ano&id_do_cliente=$id_do_cliente&id_faturamento=$id_fatura&filtro_tabela=$filtro_tabela";
        $msg = 'Fatura postada com sucesso';
        $dadosmsg['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dadosmsg);


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

        // $retorno os dados para o modal anexo
        $retorno = null;
        $dados['dados_geral'] = array(
            'maior_vencimento' => $maior_vencimento,
            'dados_faturamento' => $dados_faturamento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'dados_empresa' => $dados_empresa,
            'filtro_tabela' => $filtro_tabela,
            );
        $this->load->view('includes/heade_adm');
        if ($dados_faturamento != null) {
            $url = base_url() . "Cadastrar/filtro_faturamento";
        } else {
            $url = base_url() . "Cadastrar/filtro_faturamento";
            $msg = 'Não possui fatura na data informada';
            $dadosmsg['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_error', $dadosmsg);
        }


        $this->load->view('includes/menu');
        //  $this->load->view('cadastro_de_faturamento', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }
        public function uploadArquivosFaturamento() {
        $this->verificar_sessao();
        $this->load->model('Model_faturamento', 'faturamento');
        $this->load->model('Model_beneficiario', 'beneficiario');
        $id_do_cliente = $this->input->post('id_do_cliente');
        $id_fatura = $this->input->post('id_fatura');
        $mes = $this->input->post('mes');
        $ano = $this->input->post('ano');
        $descricao_fat = $this->input->post('descricao');
        $filtro_tabela = $this->input->post('filtro_tabela');
        

        $dadosidanexos = $this->faturamento->pegaultimoid(); //pega o último id

        $descricao = $descricao_fat . '_' . ($dadosidanexos[0]->id_anexo + 1); //$this->input->post('descricao');
        if (isset($_FILES['arquivo'])) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "anexos/";
            //Copia o arquivo dos temporários para o novo diretorio
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

            if ($extensao == '') {
                $arquivo_a_anexar = '';
            } else {
                $arquivo_a_anexar = $novo_nome;
            }
        } //fim imagem
        $dados['nome_arquivo'] = $arquivo_a_anexar;
        //incluindo os arquivos no banco
        $dados['id_do_cliente'] = $id_do_cliente;
        $dados['id_faturamento'] = $id_fatura;
        $dados['descricao'] = $descricao;
        $dados['mes'] = $this->input->post('mes');
        $dados['ano'] = $this->input->post('ano');
        $id_anexado = $this->faturamento->addArquivos($dados); //adiciona
        
        $anex_fat['id_da_fatura'] = $id_fatura;
        $anex_fat['id_do_anexo'] = $id_anexado;
        $this->faturamento->tb_anexos_fatura($anex_fat);
        
        $url = base_url() . "Cadastrar/filtro_faturamento?mes_filtro=$mes&ano_filtro=$ano&id_do_cliente=$id_do_cliente&id_faturamento=$id_fatura&filtro_tabela=$filtro_tabela&insert_id=$id_anexado";
        $msg = 'Fatura postada com sucesso';
        $dadosmsg['info'] = array(
            'url' => $url,
            'msg' => $msg);
        $this->load->view('includes/msg_success', $dadosmsg);


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

        // $retorno os dados para o modal anexo
        $retorno = null;
        $dados['dados_geral'] = array(
            'maior_vencimento' => $maior_vencimento,
            'dados_faturamento' => $dados_faturamento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'dados_empresa' => $dados_empresa,
            'filtro_tabela' => $filtro_tabela,
            );
        $this->load->view('includes/heade_adm');
        if ($dados_faturamento != null) {
            $url = base_url() . "Cadastrar/filtro_faturamento";
        } else {
            $url = base_url() . "Cadastrar/filtro_faturamento";
            $msg = 'Não possui fatura na data informada';
            $dadosmsg['info'] = array(
                'url' => $url,
                'msg' => $msg);
            $this->load->view('includes/msg_error', $dadosmsg);
        }


        $this->load->view('includes/menu');
        //  $this->load->view('cadastro_de_faturamento', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
    }

    public function upload_de_beneficiarios() {
        $fezupload = 0;
        $this->load->model('Model_upload', 'upload');
        $this->load->model('Model_atendimento', 'atendimento');
        if (isset($_POST["Import"])) {
            $filename = $_FILES["file"]["tmp_name"];
            $extensao = strtolower(substr($_FILES['file']['name'], -4));
            if ($extensao == '.csv') {
                if ($_FILES["file"]["size"] > 0) {
                    // Abre o Arquvio no Modo r (para leitura)
                    $file = fopen($filename, "r");
                    // Lê o conteúdo do arquivo
                    $dados_cliente = 0;
                    $cnpj = 0;
                    $cpf = 0;
                    $id_cliente = 0;
                    $Id_do_beneficiario = 0;
                    while (!feof($file)) {

                        // Pega os dados da linha
                        $linha = fgets($file);
                        // Divide as Informações das celular para poder salvar
                        $data = explode(';', $linha);
                        //var_dump($data);
                        //var_dump($data[19]);
                        if ($data[0] != 'CNPJ_OU_CPF - Cliente' && !empty($linha)) {
                            $cpf_do_beneficiario_up = $this->upload->SelectCpfBeneficiario($data[2]);
                            if ((empty($cpf_do_beneficiario_up) || ($data[5] != 'TITULAR') || ($data[5] != 'Titular') || ($data[5] != 'titular'))) {
                                //if (empty($cpf_do_beneficiario_up)) {

                                if ($data[0] != 'CNPJ_OU_CPF - Cliente' && !empty($linha)) { //verifica se não está vazia
                                    $cnpj_cliente = $data[0];
                                    $cnpj_operadora = $data[19];
                                    $dados_cliente = $this->upload->SelectCNPJ_Cliente($cnpj_cliente);
                                    if (!empty($dados_cliente)) {
                                        $id_cliente = $dados_cliente->id_clientes;
                                    }
                                    $dados_Operadora = $this->upload->SelectCNPJ_Operadora($cnpj_operadora);
                                    if (!empty($dados_Operadora)) {
                                        $id_operadora = $dados_Operadora->id_operadoras;
                                    }



                                    if (($data[4] == 'M') || ($data[4] == 'm') || ($data[4] == 'Masculino') || ($data[4] == 'masculino')) {
                                        $sexo = 'MASCULINO';
                                    } else {
                                        $sexo = 'FEMININO';
                                    }

                                    $dados_titular = array(//dados beneficiario
                                        'id_empresa' => $id_cliente,
                                        'nome_ben' => $data[1],
                                        'cpf' => $data[2],
                                        'carteirinha' => $data[3],
                                        'sexo' => $sexo,
                                        'dtaNascimento' => $data[6],
                                        'idade' => $data[7],
                                        'estadocivil' => $data[8],
                                        'nome_mae' => $data[9],
                                        'endereco' => $data[10],
                                        'numero' => $data[11],
                                        'complemento' => $data[12],
                                        'bairro' => $data[13],
                                        'cidade' => $data[14],
                                        'uf' => $data[15],
                                        'cep' => $data[16],
                                        'telefone' => $data[17],
                                        'rg' => $data[24],
                                        'status' => $data[25],
                                        'data_importacao' => date('Y/m/d H:i:s'),
                                    );
                                    $cpf_do_beneficiario = $this->upload->SelectCpfBeneficiario($data[2]);
                                    if (!empty($cpf_do_beneficiario)) {
                                        $cpf = $cpf_do_beneficiario->cpf;
                                        $id_benefici_ja_cadastrado = $cpf_do_beneficiario->id_beneficiario;
                                    }
                                    if ($data[2] == $cpf) {
                                        //cpf já cadastrado não cadastra o beneficiario
                                    } elseif (($data[5] == 'TITULAR') || ($data[5] == 'Titular') || ($data[5] == 'titular')) { //caso não tenha será cadastrado
                                        $Id_do_beneficiario = $this->upload->AddBeneficiario($dados_titular); //grava beneficiario
                                        if ($Id_do_beneficiario != null) {
                                            if (($data[25] != 'Ativo') || ($data[25] != 'ATIVO') || ($data[25] != 'ativo')) {
                                                $dados_atednimento = array(
                                                    'id_beneficiario' => $Id_do_beneficiario,
                                                    'nome_atendimento' => $data[1],
                                                    'tipo' => 'DÚVIDAS',
                                                    'status' => 'ABERTO',
                                                    'dta_recibo' => '',
                                                    'ini_pro_operadora' => '',
                                                    'valor_recibo' => '',
                                                    'valor_reembolso' => '',
                                                    'nome_prestador' => '',
                                                    'prev_retorno' => '',
                                                    'data_inicio' => date('Y/m/d H:i:s'),
                                                    'categoria' => 'OUTROS ATENDIMENTOS',
                                                    'obs' => 'ATENDIMENTO REFERENTE AO CADASTRO DO USUÁRIO QUE ESTÁ EM MOVIMENTAÇÃO',
                                                    'andamento' => 'ABERTO',
                                                    'movimentacao' => 'ativa',
                                                );
                                                $Id_solicitacao = $this->atendimento->addAtendimento($dados_atednimento);
                                            }
                                        }
                                        $dados_plano = array(//dados plano
                                            'id_beneficiario' => $Id_do_beneficiario,
                                            'num_contrato' => $data[20],
                                            'nome_plano' => $data[22],
                                            'id_operadora' => $id_operadora,
                                            'valor' => $data[23],
                                            'carteirinha' => $data[3],
                                        );
                                        $nome_do_plano = $this->upload->SelectPlanos($data[11]);
                                        if (!empty($nome_do_plano)) {
                                            $plano = $nome_do_plano->nome_plano;
                                        } else {
                                            $plano = '';
                                        }
                                        // if ($data[12] == $plano) {
                                        //não grava planos
                                        // } else {
                                        $Id_do_plano = $this->upload->AddPlanos($dados_plano); //grava planos
                                        // }
                                    } // verificou que já tem um cpf cadastrado
                                    if (($data[5] == 'TITULAR') || ($data[5] == 'Titular') || ($data[5] == 'titular')) {
                                        //não gra pois é a msma pessoa (titular) 
                                    } else if ($data[2] = $data[2]) {
                                        if ($Id_do_beneficiario == 0) {
                                            $id_a_inserir = $id_benefici_ja_cadastrado;
                                        } else {
                                            $id_a_inserir = $Id_do_beneficiario;
                                        }
                                        if (($data[4] == 'M') || ($data[4] == 'm')) {
                                            $sexo = 'MASCULINO';
                                        } else {
                                            $sexo = 'FEMININO';
                                        }
                                        //vai verifica se tem dependente com o mesmo nome pertencido ao beneficiário
                                        $verificar_sa_ja_tem_dependente = $this->upload->verificar_sa_ja_tem_dependente($id_a_inserir, $data[1]);
                                        if ($verificar_sa_ja_tem_dependente == null) {
                                            $data_hoje = $data[6];
                                            $dataP = explode('/', $data_hoje);
                                            $dataNoFormatoParaOBranco = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];
                                            $dataNoFormatoParaOBranco;
                                            $dados_dependente = array(//dados dependente
                                                'id_beneficiario' => $id_a_inserir,
                                                'nome' => $data[1],
                                                'cart1' => $data[3],
                                                'parentesco' => $data[5],
                                                'idade' => $data[7],
                                                'estadocivil' => $data[8],
                                                'nomemae' => $data[9],
                                                'sexo' => $sexo,
                                                'dtanasc' => $dataNoFormatoParaOBranco,
                                                'cpf' => $data[18],
                                                'rg' => $data[24],
                                                'id_plano1' => $data[22],
                                            );
                                            // fslts  o metodo
                                            $dependente = $this->upload->AddDependente($dados_dependente);  // grava dependente
                                        }
                                    }//titular
                                } //grava dados no beneficiario
                                //grava tudo em uma tabela temporario
                                // $temporario = $this->upload->temporarios($dados);
                                $fezupload = 1;
                                if ($cpf_do_beneficiario_up == NULL) {
                                    $dados_planos_e_contratos = $this->upload->dados_planos_e_contratos($Id_do_beneficiario, $data[20]);
                                } else {
                                    $dados_planos_e_contratos = $this->upload->dados_planos_e_contratos($cpf_do_beneficiario_up->id_beneficiario, $data[20]);
                                }
                                if ($dados_planos_e_contratos == null) {
                                    $dados_novo_plano = array(//dados plano
                                        'id_beneficiario' => $id_benefici_ja_cadastrado,
                                        'num_contrato' => $data[20],
                                        'nome_plano' => $data[22],
                                        'id_operadora' => $id_operadora,
                                        'valor' => $data[23],
                                        'carteirinha' => $data[23],
                                    );
                                    $Id_do_plano = $this->upload->AddPlanos($dados_novo_plano);
                                }
                            } else if ($cpf_do_beneficiario_up != '') {
                                $cnpj_cliente = $data[0];
                                $cnpj_operadora = $data[19];
                                $dados_Operadora = $this->upload->SelectCNPJ_Operadora($cnpj_operadora);
                                if (!empty($dados_Operadora)) {
                                    $id_operadora = $dados_Operadora->id_operadoras;
                                }
                                //ja enontrou um cpf cadastrado
                                $dados_planos_e_contratos = $this->upload->dados_planos_e_contratos($cpf_do_beneficiario_up->id_beneficiario, $data[20]);
                                //caso tenha um beneficiário cadastrado ele retornara o número do contrato
                                //que ele está vinculado.
                                if ($dados_planos_e_contratos != null) {
                                    //  já está cadastrado e vinculado ao plano informado
                                    echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                           <strong>ATENÇÃO !</strong> BENEFICIÁRIO JÁ CADASTRADOS E VINCULADO AO PLANO INFORMADO NA PLANILHA: Nome: ' . $data[1] . '; CPF: ' . $data[2] . '
                         </div>';
                                } else {
                                    $fezupload = 2;
                                    $dados_novo_plano = array(//dados plano
                                        'id_beneficiario' => $cpf_do_beneficiario_up->id_beneficiario,
                                        'num_contrato' => $data[20],
                                        'nome_plano' => $data[22],
                                        'id_operadora' => $id_operadora,
                                        'valor' => $data[23],
                                        'carteirinha' => $data[3],
                                    );
                                    $Id_do_plano = $this->upload->AddPlanos($dados_novo_plano); //grava planos 
                                    //$Id_do_plano = $this->upload->AddPlanos($dados_plano); //grava planos
                                    // echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
                                    //   <strong>ATENÇÃO !</strong> DADOS JÁ CADASTRADOS: Nome: '.$data[1].'; CPF: '.$data[2].'
                                    //  </div>';
                                }
                            }
                        }
                    } //verifica se tem itens nas linhas do excel
                    //colocar aqui a mensagem se já existir cpf cadastrado      
                    if ($fezupload == 1) {
                        echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Informaçao !</strong> upload efetuado com sucesso.
          </div>';
                    }
                    if ($fezupload == 2) {
                        echo '<div class="alert alert-success rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Informaçao !</strong> Novo plano vinculado com sucesso.
          </div>';
                    }
                }
                fclose($file);
                //redirect('welcome/index');
            } else {
                echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Atenção !</strong> Formato do arquivo incorreto: ' . $extensao . ', o mesmo deverá ser .csv
          </div>';
            }
        }
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('beneficiarios_upload');
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function upload_contratos() {
        $this->load->model('Model_upload', 'upload');
        if (isset($_POST["Import"])) {
            $filename = $_FILES["file"]["tmp_name"];
            $extensao = strtolower(substr($_FILES['file']['name'], -4));
            if ($extensao == '.csv') {
                if ($_FILES["file"]["size"] > 0) {
                    // Abre o Arquvio no Modo r (para leitura)
                    $file = fopen($filename, "r");
                    // Lê o conteúdo do arquivo
                    $dados_cliente = 0;
                    // $cnpj = 0;
                    $cpf = 0;
                    $id_cliente = 0;
                    $Id_do_beneficiario = 0;
                    $id_op = 0;
                    while (!feof($file)) {

                        // Pega os dados da linha
                        $linha = fgets($file);
                        // Divide as Informações das celular para poder salvar
                        $data = explode(';', $linha);
                        // var_dump($emapData);
                        if (($data[0] != 'INICIO VIGENCIA') && (!empty($linha))) { //verifica se não está vazia
                            $cnpj = $data[3];
                            $cnpj_operadora = $data[7];
                            $dados_cliente = $this->upload->SelectID_Cliente($cnpj);
                            if (!empty($dados_cliente)) {
                                $id_cliente = $dados_cliente->id_clientes;
                            }

                            $dados_op = $this->upload->SelectID_Operadora($cnpj_operadora);
                            if (!empty($dados_op)) {
                                $id_op = $dados_op->id_operadoras;
                            }
                            //   echo $id_cliente.'<br >';
                            $dados_contrato = array(//dados beneficiario
                                'cont_ramo' => $data[5],
                                'cont_operadora' => $id_op,
                                'cont_cliente' => $id_cliente,
                                'cont_numero' => $data[4],
                                // 'cont_dta_corte' => $data[2],
                                'cont_vige_inic' => date('Y-d-m', strtotime($data[0])),
                                'cont_vig_fin' => date('Y-d-m', strtotime($data[1])),
                                'quant_parcelas' => $data[8],
                                'status' => $data[9],
                                'cont_dta_vcto' => $data[10],
                                'cont_dta_corte' => $data[11],
                            );
                            //  var_dump($dados_titular);
                            $Id_do_beneficiario = $this->upload->AddContratos($dados_contrato); //grava beneficiario
                            // print_r($data[3]);
                        }
                    }
                }
                fclose($file);
                //redirect('welcome/index');
            }
        }

        $this->load->view('includes/heade_adm');
        //  $this->load->view('includes/menu');
        $this->load->view('upload_contratos');
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function relatorio_reembolso() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $chamados = $this->atendimento->getRelatorioReembolsos();
        $dados['dados_geral'] = array(
            // 'emails_beneficiario' => $emails_beneficiario,
            'atendimentos' => $chamados,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_reembolso', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }
    public function relatorio_faturamentos(){
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_faturamento', 'faturamento');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        // $dados_empresa = $this->beneficiario->getClientesEmpresa(); //cliente
        // $dados_faturamento = $this->faturamento->getFaturamento(); //cliente
        $mes = '';
        $ano = '';
        $dados_faturamento = $this->faturamento->filtroPorData($mes, $ano);
        $maior_ano_contrato = $this->faturamento->getMaiorDataContrato(); //contratos
        $ano_bd = $maior_ano_contrato[0]->cont_vig_fin; //recebe o maior ano do contrato
        $maior_vencimento = substr($ano_bd, 0, 4);

        #################################
        $this->load->model('Model_operadoras');
        $selectOperadora = $this->Model_operadoras->selectOperadorasPlanos();
        #################################
        $mes = '';
        $ano = '';
        $filtro = $this->faturamento->filtroPorData($mes, $ano);
        $retorno = null;
        $dados['dados_geral'] = array(
            'dados_faturamento' => $filtro,
            'dados_faturamento' => $dados_faturamento,
            'abre_solicitacao' => $abre_solicitacao,
            'retorno' => $retorno,
            'maior_vencimento' => $maior_vencimento,
            'selectOperadora' => $selectOperadora);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_de_faturamento_relatorio', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('abre_chamado_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function relatorio_reembolso_detalhado() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        //$chamados = $this->atendimento->getRelatorioReembolsosDetalhados();
        $dados['dados_geral'] = array(
            'seleciona' => $seleciona = null,
            'atendimentos' => $chamados = null,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_reembolso_detalhado', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
        $this->load->view('includes/recolhe_menu');
    }

    public function relatorio_outros_atendimentos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $chamados = $this->atendimento->getRelatorioOutrosAtendimentos();
        $dados['dados_geral'] = array(
            // 'emails_beneficiario' => $emails_beneficiario,
            'atendimentos' => $chamados,
            'abre_solicitacao' => $abre_solicitacao);
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_outros_atendimentos', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function relatorio_atendimentos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_relatorio', 'relatorio');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();

        $usuarios = $this->relatorio->getUsuarios();
        //$requisicao = $this->relatorio->getRequisicao();
        $clientes = $this->relatorio->getClientes();
        $dados_analista = null;
        $dados_solicitacao = null;
        $dados_clientes = null;
        $dados_categorias = null;
        $dados_status = null;
        $dados['dados_geral'] = array(
            'usuarios' => $usuarios,
            'clientes' => $clientes,
            'dados_analista' => $dados_analista,
            'dados_solicitacao' => $dados_solicitacao,
            'dados_clientes' => $dados_clientes,
            'dados_categorias' => $dados_categorias,
            'dados_status' => $dados_status,
            'abre_solicitacao' => $abre_solicitacao);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_atendimentos', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function relatorio_atendimentos_filtro() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_relatorio', 'relatorio');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $usuarios = $this->relatorio->getUsuarios();
        //$requisicao = $this->relatorio->getRequisicao();
        $clientes = $this->relatorio->getClientes();
        $dados_analista = null;
        $dados_solicitacao = null;
        $dados_clientes = null;
        $title = null;
        $dados_categorias = null;
        $dados_status = null;
        $msg = null;

        $analistas = $this->input->post('usuarios');
        $tipo_solicitacao = $this->input->post('tipo_solicitacao');
        $clientes_filtro = $this->input->post('id_clientes');
        $categorias = $this->input->post('categorias');
        $status = $this->input->post('status');
        if ($analistas != '') {
            $dados_analista = $this->relatorio->getRequisicao($analistas);
            if ($dados_analista != null) {
                $msg = 1;
            }
            if ($analistas == 'TODAS') {
                $title = 'TODOS';
            } else {
                $title = 'RELATÓRIO POR USUÁRIOS DO SISTEMA';
            }
        } else if ($tipo_solicitacao != '') {
            $dados_solicitacao = $this->relatorio->getRequisicaoSolicitacao($tipo_solicitacao);
            if ($dados_solicitacao != null) {
                $msg = 1;
            }
            $title = 'RELATÓRIO POR TIPO DE ATENDIMENTOS';
        } else if ($clientes_filtro != '') {
            $dados_clientes = $this->relatorio->getRequisicaoClientes($clientes_filtro);
            if ($dados_clientes != null) {
                $msg = 1;
            }
            $title = 'RELATÓRIO POR CLIENTESS';
        } else if ($categorias != '') {
            $dados_categorias = $this->relatorio->getRequisicaoCategorias($categorias);
            if ($dados_categorias != null) {
                $msg = 1;
            }
            $title = 'RELATÓRIO POR CATEGORIAS';
        } else if ($status != '') {
            $dados_status = $this->relatorio->getRequisicaoStatus($status);
            if ($dados_status != null) {
                $msg = 1;
            }
            $title = 'RELATÓRIO POR STATUS';
        }
        if ($msg == null) {
            echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Atenção !</strong> Dados não localizados
          </div>';
        }
        $dados['dados_geral'] = array(
            'usuarios' => $usuarios,
            'clientes' => $clientes,
            'dados_analista' => $dados_analista,
            'dados_solicitacao' => $dados_solicitacao,
            'dados_clientes' => $dados_clientes,
            'dados_categorias' => $dados_categorias,
            'dados_status' => $dados_status,
            'title' => $title,
            'abre_solicitacao' => $abre_solicitacao);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_atendimentos', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function filtro_relatorio() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');

        $dta_br_inicio = $this->input->post('dta_inicio');
        $dta_br_fim = $this->input->post('dta_fim');

        $dta_inicio = implode("-", array_reverse(explode("/", $dta_br_inicio)));
        $dta_fim = implode("-", array_reverse(explode("/", $dta_br_fim)));

        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $chamados = $this->atendimento->getRelatorioReembolsos();
        if ($dta_inicio != null && $dta_fim != null) {
            $inicial = $dta_inicio . date(' 08:00:00');
            $final = $dta_fim . date(' 22:00:00');
            $dados_filtro = $this->beneficiario->dados_filtro($inicial, $final);
            if ($dados_filtro != null) {
                $dados['dados_geral'] = array(
                    'atendimentos' => $dados_filtro,
                    // 'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
            } else {
                $dados['dados_geral'] = array(
                    // 'atendimentos' => $dados_filtro,
                    'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
                echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Atenção !</strong> Não foi localizado dados na data informada.
          </div>';
            }
        } else {
            $dados['dados_geral'] = array(
                // 'atendimentos' => $dados_filtro,
                'atendimentos' => $chamados,
                'abre_solicitacao' => $abre_solicitacao);
        }


        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_reembolso', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function filtro_relatorio_detalhado() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');

        $beneficiario = $this->input->post('beneficiario');
        $cliente = $this->input->post('cliente');
        $tipo_atendimento = $this->input->post('tipo_atendimento');
        $check_tipo_atendimento = $this->input->post('tipoatendimento');
        $status_pagamento = $this->input->post('status_pagamento');
        $check_status_pagamento = $this->input->post('statuspagamento');
        $dta_reembolso = $this->input->post('dta_reembolso');
        $check_dta_reembolso = $this->input->post('reembolso');
        $prestador = $this->input->post('prestador');
        $check_prestador = $this->input->post('nomeprestador');
        $analista = $this->input->post('analista');
        $check_nomeanalista = $this->input->post('nomeanalista');


        $dta_br_inicio = $this->input->post('dta_inicio');
        $dta_br_fim = $this->input->post('dta_fim');
        $categoria = $this->input->post('categoria');
        $status = $this->input->post('status');
        $andamento = $this->input->post('andamento');
        $numero = $this->input->post('numero');
        $seleciona['analista'] = $analista;
        $seleciona['dta_reembolso'] = $dta_reembolso;
        $seleciona['prestador'] = $prestador;
        $seleciona['status_pagamento'] = $status_pagamento;
        $seleciona['tipo_atendimento'] = $tipo_atendimento;
        $seleciona['cliente'] = $cliente;
        $seleciona['beneficiario'] = $beneficiario;
        $seleciona['categoria'] = $categoria;
        $seleciona['categoria'] = $categoria;
        $seleciona['status'] = $status;
        $seleciona['andamento'] = $andamento;
        $seleciona['inicio'] = $dta_br_inicio;
        $seleciona['fim'] = $dta_br_fim;
        $seleciona['numero'] = $numero;

        $seleciona['check_tipo_atendimento'] = $check_tipo_atendimento;
        $seleciona['check_status_pagamento'] = $check_status_pagamento;
        $seleciona['check_dta_reembolso'] = $check_dta_reembolso;
        $seleciona['check_prestador'] = $check_prestador;
        $seleciona['check_nomeanalista'] = $check_nomeanalista;


        $dta_inicio = implode("-", array_reverse(explode("/", $dta_br_inicio)));
        $dta_fim = implode("-", array_reverse(explode("/", $dta_br_fim)));

        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();

//
//        if ($dta_inicio != null && $dta_fim != null) {
//            $inicial = $dta_inicio . date(' 08:00:00');
//            $final = $dta_fim . date(' 22:00:00');
//
//            $dados_filtro = $this->beneficiario->dados_filtro($inicial, $final);
//
//            $dados_filtro = $this->beneficiario->dados_filtro($inicial, $final);
//            if ($dados_filtro != null) {
//
//                $dados['dados_geral'] = array(
//                    'atendimentos' => $dados_filtro,
//                    'seleciona' => $seleciona,
//                    //'atendimentos' => $chamados,
//                    'abre_solicitacao' => $abre_solicitacao);
//            } else {
//                $chamados = null;
//                $dados['dados_geral'] = array(
//                    'seleciona' => $seleciona,
//                    'atendimentos' => $chamados,
//                    'abre_solicitacao' => $abre_solicitacao);
//                echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
//          <strong>Atenção !</strong> Não foi localizado dados na data informada.
//          </div>';
//            }
//        } else {

            if ($beneficiario == null && $cliente == null && $tipo_atendimento == null && $status_pagamento == null && $dta_reembolso == null && $prestador == null && $analista == null && $dta_fim == null && $dta_inicio == null && $status == null) {
                $chamados = $this->atendimento->getRelatorioReembolsos();
            } else if ($cliente != null && $beneficiario != null) {
                $chamados = $this->atendimento->getRelatorioReembolsosClientesBeneficiario($cliente, $beneficiario);
            } else if ($beneficiario != null && $dta_inicio == null && $dta_fim == null) {
                $chamados = $this->atendimento->getRelatorioReembolsosBeneficiarios($beneficiario);
            } else if ($cliente != null && $dta_inicio == null && $dta_fim == null) {
                $chamados = $this->atendimento->getRelatorioReembolsosClientes($cliente);
            } else if ($tipo_atendimento != null) {
                $chamados = $this->atendimento->getRelatorioReembolsoBenCliTipAte($tipo_atendimento);
            } else if ($status_pagamento != null && $dta_inicio == null && $dta_fim == null) {
                $chamados = $this->atendimento->getRelatorioReembolsoBenStatusPag($status_pagamento);
            } else if ($status_pagamento != null && $beneficiario != null && $dta_inicio == null && $dta_fim == null) {
                $chamados = $this->atendimento->getRelatorioReembolsoBenStatusPagBenef($status_pagamento, $beneficiario);
            } else if ($status_pagamento != null && $cliente != null) {
                $chamados = $this->atendimento->getRelatorioReembolsoBenStatusPagClie($status_pagamento, $cliente);
            } else if ($status_pagamento != null && $cliente != null && $beneficiario != null) {
                $chamados = $this->atendimento->getRelatorioReembolsoBenStatusPagClieBenef($status_pagamento, $cliente, $beneficiario);
            } else if ($cliente != null && $beneficiario != null && $tipo_atendimento != null) {
               $chamados = $this->atendimento->getRelatorioReembolsosClientesBeneficiarioTipoAt($cliente, $beneficiario, $tipo_atendimento);
            } else if ($tipo_atendimento != null && $cliente != null && $status_pagamento != null || $tipo_atendimento != null && $beneficiario != null && $status_pagamento != null) {
                $chamados = $this->atendimento->getRelatorioReembolsosClientesBeneficiarioTipoAt($cliente, $beneficiario, $tipo_atendimento, $status_pagamento);
            } else if ($dta_reembolso != null) {
                $chamados = $this->atendimento->getRelatorioReembolsosDtaReemb($dta_reembolso);
            } else if ($prestador != null) {
                $chamados = $this->atendimento->getRelatorioReembolsosPrestador($prestador);
            } else if ($analista != null) {
               $chamados = $this->atendimento->getRelatorioReembolsosAnalista($analista);
            } else if ($analista != null && $cliente != null) {
                $chamados = $this->atendimento->getRelatorioReembolsosAnalistaCliente($analista, $cliente);
            }else if ($beneficiario != null && $dta_inicio != null && $dta_fim != null && $status_pagamento == null) {
               $chamados = $this->atendimento->getRelatorioReembolsosBeneficiarioDtaInicioDtaFim($beneficiario, $dta_inicio, $dta_fim);
            }else if ($status_pagamento != null && $beneficiario != null && $dta_inicio != null && $dta_fim != null) {
               $chamados = $this->atendimento->getRelatorioReembolsosStatusBeneficiarioDtaInicioDtaFim($status_pagamento, $beneficiario, $dta_inicio, $dta_fim);
            }else if($status_pagamento != null && $dta_inicio != null && $dta_fim != null) {
               $chamados = $this->atendimento->getRelatorioReembolsosStatusDtaInicioDtaFim($status_pagamento, $dta_inicio, $dta_fim);  
            }else if ($cliente != null && $beneficiario != null && $dta_inicio != null && $dta_fim != null) {
                $chamados = $this->atendimento->getRelatorioReembolsosClienteBeneficiarioDtaInicioDtaFim($cliente, $beneficiario, $dta_inicio, $dta_fim);
            }else if ($dta_inicio != null && $dta_fim != null && $beneficiario == null) {
                $chamados = $this->atendimento->getRelatorioReembolsosDtaInicioDtaFim($dta_inicio, $dta_fim);
            }else{
                $chamados = null;
            }


            $dados['dados_geral'] = array(
                'seleciona' => $seleciona,
                'atendimentos' => $chamados,
                'abre_solicitacao' => $abre_solicitacao);
        //}
        if ($chamados == null) {
            echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Atenção !</strong> Não foi localizado dados na sua pesquisa.
          </div>';
        }

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_reembolso_detalhado', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
        $this->load->view('includes/recolhe_menu');
    }

    public function filtro_relatorio_outros_atendimentos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_atendimento', 'atendimento');

        $cliente = $this->input->post('cliente');
        $beneficiario = $this->input->post('beneficiario');
        $andamento = $this->input->post('andamento');

        $dta_br_inicio = $this->input->post('dta_inicio');
        $dta_br_fim = $this->input->post('dta_fim');

        $dta_inicio = implode("-", array_reverse(explode("/", $dta_br_inicio)));
        $dta_fim = implode("-", array_reverse(explode("/", $dta_br_fim)));

        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $chamados = $this->atendimento->getRelatorioOutrosAtendimentos();
        if ($dta_inicio != null && $dta_fim != null) {
            $inicial = $dta_inicio . date(' 08:00:00');
            $final = $dta_fim . date(' 22:00:00');
            $dados_filtro = $this->beneficiario->dados_filtro_outros($inicial, $final);
            if ($dados_filtro != null) {
                $dados['dados_geral'] = array(
                    'atendimentos' => $dados_filtro,
                    // 'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
            } else {
                $dados['dados_geral'] = array(
                    // 'atendimentos' => $dados_filtro,
                    'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
                echo '<div class="alert alert-danger rem" id="rem" style="margin-top: 3%; margin-left: 18%;">
          <strong>Atenção !</strong> Não foi localizado dados na data informada.
          </div>';
            }
        } else {
            if ($cliente != null) {
                $dados_filtro = $this->beneficiario->dados_filtro_outro_cliente($cliente);
                $dados['dados_geral'] = array(
                    'atendimentos' => $dados_filtro,
                    // 'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
            } else if ($beneficiario != null) {
                $dados_filtro = $this->beneficiario->dados_filtro_outro_beneficiario($beneficiario);
                $dados['dados_geral'] = array(
                    'atendimentos' => $dados_filtro,
                    // 'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
            } else if ($andamento != null) {
                $dados_filtro = $this->beneficiario->dados_filtro_outro_andamento($andamento);
                $dados['dados_geral'] = array(
                    'atendimentos' => $dados_filtro,
                    // 'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
            } else if ($andamento != null && $cliente != null) {
                $dados_filtro = $this->beneficiario->dados_filtro_outro_andamento_cli($andamento, $cliente);
                $dados['dados_geral'] = array(
                    'atendimentos' => $dados_filtro,
                    // 'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
            } else if ($andamento != null && $beneficiario != null) {
                $dados_filtro = $this->beneficiario->dados_filtro_outro_andamento_ben($andamento, $beneficiario);
                $dados['dados_geral'] = array(
                    'atendimentos' => $dados_filtro,
                    // 'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
            } else {
                $dados['dados_geral'] = array(
                    // 'atendimentos' => $dados_filtro,
                    'atendimentos' => $chamados,
                    'abre_solicitacao' => $abre_solicitacao);
            }
        }

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_outros_atendimentos', $dados);
        $this->load->view('abre_chamado_modal', $dados);
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function relatorio_contratos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_contratos', 'contratos');

        $meio_busca = $this->input->post('tipo');
        $dta_inicio = $this->input->post('dta_inicio');
        $dta_fim = $this->input->post('dta_fim');

        $dataBrancofim = implode("-", array_reverse(explode("/", $dta_fim)));
        // $data_filtro = $dta_fim;
        // $dataP = explode('/', $data_filtro);
        // $dataBrancofim = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];

        $dataBrancoinicio = implode("-", array_reverse(explode("/", $dta_inicio)));
        //$data_filtro = $dta_inicio;
        // $dataP = explode('/', $data_filtro);
        // $dataBrancoinicio = $dataP[2] . '-' . $dataP[1] . '-' . $dataP[0];

        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $contratos = $this->contratos->getRelatorioContratos();

        // $dados_filtro = $this->contratos->dados_filtro($dataNoFormatoParaOBranco);
        if ($meio_busca == 'inicial') {
            $dados_filtro = $this->contratos->dados_inicio($dataBrancoinicio, $dataBrancofim);
        } else if ($meio_busca == 'final') {
            $dados_filtro = $this->contratos->dados_final($dataBrancoinicio, $dataBrancofim);
        } else {
            $dados_filtro = null;
        }
        $naomsg = null;
        $filtro['inicio'] = $dta_inicio;
        $filtro['fim'] = $dta_fim;
        $filtro['tipo'] = $meio_busca;
        if ($dados_filtro != null) {
            $dados['dados_geral'] = array(
                'contratos' => $dados_filtro,
                'dados_pesquisa' => $filtro,
                'abre_solicitacao' => $abre_solicitacao);
            echo '<div class="alert alert-success rem nao-imprime" id="" style="margin-top: 3%; margin-left: 18%;">
          <strong>Informação !</strong> Sua pesquisa retornou os seguintes resultados !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            $naomsg = 1;
        } else if ($dados_filtro == null && $naomsg == null && $meio_busca != null) {
            $dados['dados_geral'] = array(
                'dados_pesquisa' => $filtro = null,
                'contratos' => $contratos = null,
                'abre_solicitacao' => $abre_solicitacao);
            echo '<div class="alert alert-danger rem" id="" style="margin-top: 3%; margin-left: 18%;">
          <strong>Atenção !</strong> Não foi localizado dados na data informada.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {

            $dados['dados_geral'] = array(
                'contratos' => $contratos = null,
                'dados_pesquisa' => $filtro = null,
                'abre_solicitacao' => $abre_solicitacao);
        }
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_contratos', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function relatorio_contratos_todos() {
        $this->verificar_sessao();
        $this->load->model('Model_beneficiario', 'beneficiario');
        $this->load->model('Model_contratos', 'contratos');

        $dta_inicio = $this->input->post('dta_inicio');
        $dta_fim = $this->input->post('dta_fim');
        $abre_solicitacao = $this->beneficiario->selectBeneficiariosPorNome();
        $contratos = $this->contratos->getRelatorioContratos_todos();
        $dados['dados_geral'] = array(
            'dados_pesquisa' => $filtro = null,
            'contratos' => $contratos,
            'abre_solicitacao' => $abre_solicitacao);

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('relatorio_contratos', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }
    public function gerar_protocolos(){
     $this->load->model('Model_atendimento', 'atendimento');
       $data = $this->input->post('dta_atendimento');
        
        $pesquisaAtendimentos = null;
        $data_informada = null;
        if($data != null){
        $data_mod = implode("-",array_reverse(explode("/",$data)));
        $pesquisaAtendimentos = $this->atendimento->GerarProtocolosPesquisaData($data_mod);
        $data_informada = $data;
        }
         $dados['dados_geral'] = array(
             'dados_foreach_protocolo' => $pesquisaAtendimentos,
             'data_informada' => $data_informada
        );
        
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('gerar_protocolo', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');   
    }

    public function protocolo_reembolso() {
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atnd = $this->input->get('id');
        $result = $this->atendimento->getProtocolo($id_atnd);
        
        $todosatd = null;
        foreach ($result as $value) {
        $beneficiario = $value->id_beneficiario;
        //$todosatd = $this->atendimento->GetProtocolosGerais($beneficiario);
        }
        
         $dados['dados_geral'] = array(
            'dados_protocolo' => $result,
             'dados_foreach' => $todosatd
        );
        
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('protocolo_reembolso', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }
    
        public function protocolo_reembolso_filtro() {
        $this->load->model('Model_atendimento', 'atendimento');
        $id_atnd = $this->input->get('id_prot');
        $id_beneficiario = $this->input->get('id_ben');
        $dta_atendimento = $this->input->get('dta_at');
        $data = implode("-",array_reverse(explode("/",$dta_atendimento)));
        
        $result = $this->atendimento->getProtocolo($id_atnd);
        $todosatd = 0;
        foreach ($result as $value) {

        $todosatd = $this->atendimento->GetProtocolosGerais($id_beneficiario, $data);
        }
       if($todosatd == null){
       $todosatd = 0;    
       }
         $dados['dados_geral'] = array(
            'dados_protocolo' => $result,
             'dados_foreach' => $todosatd
        );
        
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('protocolo_reembolso', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function protocolo_reembolso_reemitir() {
        $this->load->model('Model_atendimento', 'atendimento');
        $id_beneficiario = $this->input->get('id');
        $dta_atendimento = $this->input->get('data');
        $data = implode("-",array_reverse(explode("/",$dta_atendimento)));
        $result = $this->atendimento->getProtocolo($id_beneficiario, $data);


       // foreach ($result as $value) {
       // $beneficiario = $value->id_beneficiario;
       // $todosatd = $this->atendimento->GetProtocolosGeraisInverso($beneficiario);
       // }
       // $todosatd = 0;
         $dados['dados_geral'] = array(
            'dados_protocolo' => $result,
             'dados_foreach' => $result
        );
        
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('protocolo_reembolso', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }
    public function protocolo_reembolso_gravado() {
        $this->load->model('Model_atendimento', 'atendimento');
        $prot['operadora'] = $this->input->post('operadora');
        $prot['ac'] = $this->input->post('ac');
        $prot['endereco'] = $this->input->post('endereco');
        $prot['cliente'] = $this->input->post('cliente');
        $prot['paciente'] = $this->input->post('paciente');
        $prot['titular'] = $this->input->post('titular');
        $prot['cpf'] = $this->input->post('cpf');
        $prot['contrato'] = $this->input->post('contrato');
        $prot['id_atend'] = $this->input->post('id_atend');
        
        $id_beneficiario = $this->input->post('id_beneficiario');
        
        
        //$id_recente = $this->input->post('id_recente');
        
        $id_prot = $this->atendimento->addProtocolo($prot); //adiciona protocolo
       
        $id_atnd = $this->input->post('id_atend');
        $dados_recente = $this->atendimento->GetProtocoloAdicionado($id_prot);
        $prot_chamado['protocolo'] = 1;
        $categoria = 'REEMBOLSO';
         $dta_atendimento = $this->input->post('dta_atendimento');
        $data = implode("-",array_reverse(explode("/",$dta_atendimento)));
        $this->atendimento->UpdateAtendimentosProtocolo($prot_chamado, $id_beneficiario, $categoria, $data); //atualiza chamados

        $todosatd = $this->atendimento->GetProtocolosGeraisInverso($id_beneficiario, $data);

        $dados['dados_geral'] = array(
            'dados_protocolo' => $todosatd,
            'dados_recente' => $dados_recente
        );

        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('protocolo_reembolso_gravado', $dados);
        $this->load->view('abre_chamado_modal');
        $this->load->view('sair_sistema_modal');
        $this->load->view('anexo_cliente_modal');
    }

    public function logoff() {
        $this->verificar_sessao();
        $this->session->sess_destroy();
        $this->load->view('includes/heade');
        $this->load->view('index');
    }
    public function teste() {
        $this->load->view('teste');
        // redirect(base_url());
    }

    public function realtorios90dias() {
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->model('Model_contratos', 'contratos');
        $contratos = $this->contratos->getRelatorioContratos_relatorio90();
        //echo $contratos[0]->nome_cliente;
        $hoje = date('Y-m-d');
        $verificar_se_gerou_relatorio = $this->contratos->verificar_se_gerou_relatorio($hoje);
        if ($verificar_se_gerou_relatorio != null) {
            //faz nada 
        } else if ($verificar_se_gerou_relatorio == null || $verificar_se_gerou_relatorio == '') {
            // echo $contratos[0]->nome_cliente;

            $base = base_url();
            $data = date('d/m/Y H:i:s');
            $de = 'contato@newportconsultoria.com.br';
            $para = 'celio@newportconsultoria.com.br';    //celio@newportconsultoria.com.br
            $msg = "<!doctype html>
        <html>
            <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                <meta name='viewport' content='width=device-width'>
            </head>
                <body style='width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: #FFFFFF'>

        <div class='col-md-12'>
            <h4>COM BASE NOS CONTRATOS CADASTRADOS ESSES SÃO OS CONTRATOS QUE IRÃO VENCER EM 90 DIAS.
            </h4>
        </div>
        <br />
        <br />
        <br />
        <div class='col-md-12'>
            <div class='table-responsive'>
                <table border='1px' id='example' class='sortable table table-bordered table-hover table-striped table table-bordered table-hover table-striped' cellspacing='0' width='100%'>
                    <thead>
                        <tr role='row' class='odd'>
                            <th style='font-size: 12px;' bgcolor='#CCC'>NOME DOS CLIENTES</th>
                            <th style='font-size: 12px;' bgcolor='#CCC'>CONTRATO</th>
                            <th style='font-size: 12px;' bgcolor='#CCC'>RAMO</th>
                            <th style='font-size: 12px;' bgcolor='#CCC'>VIGÊNCIA INICIAL</th>
                            <th style='font-size: 12px;' bgcolor='#CCC'>VIGÊNCIA FINAL</th>
                            <th style='font-size: 12px;' bgcolor='#CCC'>STATUS</th>

                        </tr>
                    </thead>
                    <tbody> 
                    ";
            foreach ($contratos as $result) {
                $msg .= "<tr style='align-content: center;'>
                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'><b>$result->nome_cliente</b></td>
                                    <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>$result->cont_numero</td>
                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>$result->cont_ramo</td>
                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>" . date('d/m/Y', strtotime($result->cont_vige_inic)) . "</td>
                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>" . date('d/m/Y', strtotime($result->cont_vig_fin)) . "</td>
                                <td style='height: 0px; margin-bottom: 1px; margin-top: 1px; padding-bottom: 1px; padding-top: 3px; font-size: 11px;'>$result->status</td>
                            </tr>";
            }
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
            $this->email->bcc('fabio@newportconsultoria.com.br', 'edlaine@newportconsultoria.com.br');
            $this->email->subject('Relatório de contratos a vencer em 90 dias.');         //ESPECIFICA O ASSUNTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->message($msg);                  //ESPECIFICA O TEXTO DA MENSAGEM DENTRO DA CLASSE
            $this->email->attach($base . "assets/images/logo.JPG");   //anexo
            $this->email->send();                            //AÇÃO QUE ENVIA O E-MAIL COM OS PARÂMETROS DEFINIDOS ANTERIORMENTE
            echo $this->email->print_debugger();

            $dados_insert['data_gerado'] = $hoje;
            $this->contratos->gerouRelatorios90dias($dados_insert);
        }
    }

    public function teste_for_excel() {
        $this->load->model('Model_contratos', 'contratos');
        $arquivo = 'contratos_gerais.xls';
        $tabela = '<table border="1">';
        $tabela .= '<tr>';
        $tabela .= '<td colspan="2">TODOS OS CONTRATOS NEWPORT</tr>';
        $tabela .= '</tr>';
        $tabela .= '<tr>';
        $tabela .= '<td><b>Contrato</b></td>';
        $tabela .= '<td><b>Operadora</b></td>';
        $tabela .= '<td><b>Cliente</b></td>';
        $tabela .= '<td><b>Status</b></td>';
        $tabela .= '<td><b>Data de Corte</b></td>';
        $tabela .= '<td><b>Data de Vencimento</b></td>';
        $tabela .= '<td><b>Vig inicial</b></td>';
        $tabela .= '<td><b>Vig Final</b></td>';
        $tabela .= '</tr>';
//
// // Puxando dados do Banco de dados
        $dados_contrato = $this->contratos->getContratos();
//
        foreach ($dados_contrato as $value) {

            $tabela .= '<tr>';
            $tabela .= '<td>' . $value->cont_numero . '</td>';
            $tabela .= '<td>' . $value->nome_op . '</td>';
            $tabela .= '<td>' . $value->nome_cliente . '</td>';
            $tabela .= '<td>' . $value->status . '</td>';
            $tabela .= '<td>' . $value->cont_dta_corte . '</td>';
            $tabela .= '<td>' . $value->cont_dta_vcto . '</td>';
            $tabela .= '<td>' . $value->cont_vige_inic . '</td>';
            $tabela .= '<td>' . $value->cont_vig_fin . '</td>';
            $tabela .= '</tr>';
        }
//
        $tabela .= '</table>';
//
// // Força o Download do Arquivo Gerado
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Content-Type: application/x-msexcel');
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        echo $tabela;
    }
    public function u(){
     $this->load->model('Model_faturamento', 'faturamento');
     $dados = $this->faturamento->u();
     foreach ($dados as $value) {
     $id_anexo = $value->id_anexo; 
     $id_faturamento= $value->id_faturamento;
     $anex_fat['id_da_fatura'] = $id_faturamento;
        $anex_fat['id_do_anexo'] = $id_anexo;
        $this->faturamento->tb_anexos_fatura($anex_fat);
     }
    }
    public function table(){
        
        $this->load->view('table');
    }
    public function recibo(){
       $ret = $this->db->get('tb_atendimentos'); 
       $array = $ret->result();
       
    
        foreach ($array as $value) {
        $id = $value->id_atend;   
       
         $data_proc_ini = implode("-",array_reverse(explode("/",$value->dta_recibo)));
         $dados['apaga'] = $data_proc_ini;
         $this->db->update('tb_atendimentos', $dados, array('id_atend' => $id));
        }
    }
     public function Dados_teste() {

        $query = $this->db->get('tb_contatos');
        $result1 =  $query->result();
        
        $result = null;
        foreach ($result1 as $value) {
         
        $this->db->where('id_clientes', $value->id_cliente);
        $query = $this->db->get('tb_clientes');
        $result =  $query->result();   
//        echo '<pre>';
//        print_r($result);   
//        echo '</pre>';
        }
        
        
        
             $dados['dados_geral'] = array(
            'teste' => $result,
);

        $this->load->view('table', $dados);
        
    }

}
