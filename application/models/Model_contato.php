<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_contato extends CI_Model {
    //insert
     public function addContatos($dados=null){
        if($dados != NULL):
        $this->db->insert('tb_contatos', $dados);
        endif;
    }
    
     //select
    public function getContatosCliente($id) { 
          if ($id != null):
            $this->db->where('id_cliente', $id);
            $query = $this->db->get('tb_contatos');
            return $query->result();
            endif;
    }
    //select
    public function getContatos($id) { 
          if ($id != null):
            $this->db->where('id_operadora', $id);
            $query = $this->db->get('tb_contatos');
            return $query->result();
            endif;
    }
    //Selecionando o plano com base na operadora
   public function listContratos($id_operadora = null, $id_cliente = null) {
        return $this->db    
                        ->where('cont_operadora', $id_operadora)
                        ->where('cont_cliente', $id_cliente)
                        ->get('tb_contratos');
    }

    //monta um select com os contratos
    public function selectContratosOperadoras($id_operadora = null, $id_cliente = null) {
        $contratos = $this->listContratos($id_operadora, $id_cliente);
        $total_planos = $contratos->num_rows();
        $options = "<option value=''>Contrato(s) ({$total_planos})</option>";
        foreach ($contratos->result() as $contrato) {
            $options .= "<option value='{$contrato->cont_numero}'>{$contrato->cont_numero}</option>" . PHP_EOL;
        }
        return $options;
    }
     public function updateContatosCliente($dados=null, $id=null){
        if(($dados && $id) != null):
            $this->db->update('tb_contatos', $dados, array('id_contato'=>$id));
            endif;
        }
     public function updateContatos($dados=null, $id=null){
        if(($dados && $id) != null):
            $this->db->update('tb_contatos', $dados, array('id_contato'=>$id));
            endif;
        }
        public function DeletarFornecedor($id=null){
           if(($id) != null):
            $this->db->delete('tb_fornecedor', array('fn_id'=>$id));
            endif; 
        }

}
