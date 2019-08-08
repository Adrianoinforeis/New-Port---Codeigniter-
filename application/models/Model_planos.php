<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Model_planos extends CI_Model {

    //insert
    public function addPlanos($dados = null) {
        if ($dados != NULL):
            $this->db->insert('tb_planos', $dados);
        endif;
    }

    //select
    public function getPlanosPorId($id) {
        if ($id != null):
            $this->db->select('tb_planos.*, tb_operadoras.id_operadoras, tb_operadoras.nome_op');
            $this->db->join('tb_operadoras', 'tb_planos.id_operadoras = tb_operadoras.id_operadoras');
            $this->db->where('id_planos', $id);
            $query = $this->db->get('tb_planos');
            return $query->row();
        endif;
    }

    //trazendo os socios baseado na letra digitada
    public function listplanos($nome = null) {
        return $this->db
                        ->like('pl_nome', $nome)
                        ->get('tb_planos');
    }

    //monta um select com os produtos selecionados pela categoria
    public function selectPlanosPorNome($nome = null) {
        $planos = $this->listplanos($nome);
        $total_planos = $planos->num_rows();

        $option = "<li><a href='#' class='list-group-item list-group-item-action active'>Foi encontrado: ({$total_planos})</a></li>";
        foreach ($planos->result() as $plano) {
            //<a href="#" class="list-group-item list-group-item-action active">
            $option .= "<li value='{$plano->id_planos}'><a href='filtro_planos?id=$plano->id_planos' class='list-group-item list-group-item-action'>$plano->pl_nome</a></li>" . PHP_EOL;
        }
        return $option;
    }
    public function alteraStatusBeneficiario($id, $dados){
      $this->db->update('tb_beneficiario', $dados, array('id_beneficiario' => $id));  
    }

    public function updatePlanos($dados = null, $id = null) {
        if (($dados && $id) != null):
            $this->db->update('tb_planos', $dados, array('id_planos' => $id));
        endif;
    }

    public function DeletarFornecedor($id = null) {
        if (($id) != null):
            $this->db->delete('tb_fornecedor', array('fn_id' => $id));
        endif;
    }

}
