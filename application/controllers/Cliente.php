<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function atendimento() {
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('home_cliente');
        $this->load->view('sair_sistema_modal');
    }

    public function historico() {
        $this->load->model('Model_atendimento', 'atendimento');
        $session_logado = $this->session->userdata('logado');
        $id = $session_logado[0]->id_beneficiario;
        $chamados = $this->atendimento->getAtendimentosClientes($id);
        
         $dados['dados_geral'] = array(
            'atendimentos' => $chamados
           // 'abre_solicitacao' => $abre_solicitacao
                 );
        $this->load->view('includes/heade_adm');
        $this->load->view('includes/menu');
        $this->load->view('historico_cliente', $dados);
        $this->load->view('sair_sistema_modal');
    }

}
