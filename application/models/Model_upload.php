<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_upload extends CI_Model {

    //insert
    public function AddBeneficiario($dados = null) {
            $this->db->insert('tb_beneficiario', $dados);
            return $this->db->insert_id();
    }
    public function AddPlanos($dados=null){
         $this->db->insert('tb_planos_escolhidos', $dados);
            return $this->db->insert_id();
    }
    public function AddDependente($dados){
        $this->db->insert('tb_dependentes',$dados);
        return $this->db->insert_id();
    }

    //select
    public function SelectCNPJ_Cliente($cnpj) {
        $this->db->where('cnpj', $cnpj);
        $this->db->or_where('cpf', $cnpj);
        $query = $this->db->get('tb_clientes');
        return $query->row();
    }

    public function SelectCNPJ_Operadora($cnpj) {
        $this->db->where('cnpj', $cnpj);
        $query = $this->db->get('tb_operadoras');
        return $query->row();
    }
    public function SelectCpfBeneficiario($cpf){
     $this->db->where('cpf', $cpf);
        $query = $this->db->get('tb_beneficiario');
        return $query->row();   
    }
    public function SelectPlanos($plano){
       $this->db->where('nome_plano', $plano);
        $query = $this->db->get('tb_planos_escolhidos');
        return $query->row();  
    }
    
    public function verificar_sa_ja_tem_dependente($id_beneficiario, $nomedpts){
       $this->db->where('id_beneficiario', $id_beneficiario);
       $this->db->where('nome', $nomedpts);
        $query = $this->db->get('tb_dependentes');
        return $query->row(); 
    }

        public function SelectID_Cliente($cnpj){
        $this->db->where('cnpj', $cnpj);
        $query = $this->db->get('tb_clientes');
        return $query->row();
    }
    public function AddContratos($dados){
        $this->db->insert('tb_contratos', $dados);
            return $this->db->insert_id();
    }
    public function SelectID_Operadora($cnpj){
         $this->db->where('cnpj', $cnpj);
        $query = $this->db->get('tb_operadoras');
        return $query->row();
    }
    public function dados_planos_e_contratos($idbeneficiario, $contrato){
        $this->db->where('id_beneficiario', $idbeneficiario);
        $this->db->where('num_contrato', $contrato);
       // $this->db->select('tb_planos_escolhidos.*'); //*, tb_beneficiario.id_beneficiario, tb_beneficiario.id_empresa,
                       // tb_planos_escolhidos.id_beneficiario, tb_planos_escolhidos.num_contrato,
                       // tb_clientes.id_clientes');
        //tb_contratos.cont_id, tb_contratos.cont_numero, tb_contratos.cont_cliente
            //$this->db->from('tb_contratos');
           // $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
            //$this->db->join('tb_beneficiario', 'tb_clientes.id_clientes = tb_beneficiario.id_empresa');
           // $this->db->join('tb_clientes', 'tb_contratos.cont_cliente = tb_clientes.id_clientes');
           // $this->db->join('tb_planos_escolhidos', 'tb_contratos.num_contrato = tb_planos_escolhidos.num_contrato');
            
            $query = $this->db->get('tb_planos_escolhidos');
            return $query->result();
    }
}
