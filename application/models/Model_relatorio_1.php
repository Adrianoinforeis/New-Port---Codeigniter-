<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_relatorio extends CI_Model {

    public function getUsuarios() {
        $query = $this->db->select('*');
        $query = $this->db->get('tb_usuarios');
        return $query->result();
    }
    public function getRequisicao($analista){
        if($analista == 'TODAS'){}else{
         $this->db->where('analista', $analista);   
        }
      $query = $this->db->get('tb_atendimentos');
        return $query->result();  
    }
    public function getRequisicaoSolicitacao($tipo){
    if($tipo == 'TODAS'){
      $query = $this->db->get('tb_atendimentos');
      return $query->result();       
     }else{
      $this->db->where('andamento', $tipo);   
      $query = $this->db->get('tb_atendimentos');
        return $query->result(); 
    }
    }

    public function getClientes(){
       $query = $this->db->get('tb_clientes');
        return $query->result();   
    }
    public function getRequisicaoClientes($id_clientes){
        if ($id_clientes != null):
            $this->db->select('tb_atendimentos.*, 
                    tb_beneficiario.id_beneficiario, 
                    tb_clientes.id_clientes');
            $this->db->join('tb_beneficiario', 'tb_atendimentos.id_beneficiario = tb_beneficiario.id_beneficiario');
            $this->db->join('tb_clientes', 'tb_beneficiario.id_empresa = tb_clientes.id_clientes');
            if($id_clientes == 'TODOS'){
                
            }else{
             $this->db->where('tb_clientes.id_clientes', $id_clientes);
            }
            $query = $this->db->get('tb_atendimentos');
            return $query->result();
        endif;
    }
    public function getRequisicaoCategorias($cat){
      if($cat == 'TODAS'){
      $query = $this->db->get('tb_atendimentos');
      return $query->result();       
     }else{
      $this->db->where('tipo', $cat);   
      $query = $this->db->get('tb_atendimentos');
      return $query->result(); 
    }        
    }
    
    public function getRequisicaoStatus($status){
      if($status == 'TODAS'){
      $query = $this->db->get('tb_atendimentos');
      return $query->result();       
     }else{
      $this->db->where('andamento', $status);   
      $query = $this->db->get('tb_atendimentos');
      return $query->result(); 
    }    
    }



}
