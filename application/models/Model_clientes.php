<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_clientes extends CI_Model {

    //insert
    public function addClientes($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_clientes', $dados);
        endif;
    }

    //select
    public function getcliente($id) {
        if ($id != null):
            $this->db->where('id_clientes', $id);
            $this->db->limit(1);
            $query = $this->db->get('tb_clientes');
            return $query->row();
        endif;
    }
    
    //pega os contratos de cada cliente selecionados
    public function visualizarContratos($idcliente){
        $this->db->where('cont_cliente', $idcliente);
        $dados = $this->db->get('tb_contratos');
        return $dados->result();
    }
    
     public function anexos_cliente($idcliente){
        $this->db->where('id_cliente_anexos', $idcliente); 
        $dados = $this->db->get('tb_anexos');
        return $dados->result();
    }
    public function verificar_duplicidade_cnpj($cnpj, $tipo){
        $this->db->where('cnpj', $cnpj);
        $this->db->where('tipo', $tipo);
        $dados = $this->db->get('tb_clientes');
        return $dados->result();
    }
    public function verificar_duplicidade_cpf($cpf, $tipo){
        $this->db->where('cpf', $cpf);
        $this->db->where('tipo', $tipo);
        $dados = $this->db->get('tb_clientes');
        return $dados->result();
    }
    public function getclienteParausuariosSistema() {
            $this->db->where('status', 'ATIVO');
            $query = $this->db->get('tb_clientes');
            return $query->result();
    }
    //select
    public function getClienteTodos() {
        $estipulante = 'NÃO';
        $this->db->where('estipulante', $estipulante);
        $query = $this->db->get('tb_clientes');
        $this->db->order_by("nome_cliente");
        return $query->result();
    }
    //trazendo os socios baseado na letra digitada
    public function listClientes($nome = null) {
        return $this->db
                        ->like('nome_cliente', $nome)
                        ->or_like('razao', $nome)
                        //->order_by('nome_op')
                        ->get('tb_clientes');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectClientesPorNome($nome = null) {
        $operadoras = $this->listClientes($nome);
        $total_operadoras = $operadoras->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_operadoras})</a></li>";
        foreach ($operadoras->result() as $visitante) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$visitante->id_clientes}'><a href='filtro_cliente?id=$visitante->id_clientes' class='list-group-item list-group-item-action'>$visitante->nome_cliente - ".substr($visitante->razao, 0, 20)."... </a></li>" . PHP_EOL;
        }
        return $option; 
    }
    public function updateAnexoCliente($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_anexos', $dados, array('id_anexo' => $id));
        endif;
    }

    public function updateClientes($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_clientes', $dados, array('id_clientes' => $id));
        endif;
    }

    public function DeletarFornecedor($id = null) {
        if (($id) != null):
            $this->db->delete('tb_fornecedor', array('fn_id' => $id));
        endif;
    }
     public function DeletarAnexoCliente($id = null) {
        if (($id) != null):
            $this->db->delete('tb_anexos', array('id_anexo' => $id));
        endif;
    }

}
